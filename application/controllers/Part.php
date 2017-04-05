<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Part extends Application 
{
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/Parts.php
	 *	- or -
	 * 		http://example.com/Parts/index
	 */
	public function index()
	{
		$this->data['pagetitle'] = 'Parts';
		$this->data['pagebody'] = 'parts';
        
        $source[] = array();
        $val = 0;
        
        foreach($this->parts->all() as $part)
        {
            if($part->used == 0)
            {
                $source[$val] = $part;
                $val++;
            }
        }
        
		$parts_list = array();
        
		if($source[0] != null)
		{
			foreach ($source as $part)
			{
				$modelCode = $part->model;
				$modelType = '';
				$partCode = $part->piece;
				$partType = '';
				$modelPart = $modelCode.$partCode;

				if (ord($modelCode) >= ord('a') && ord($modelCode) < ord('l'))
				{
					$modelType = 'Household';
				}
				elseif (ord($modelCode) < ord('v'))
				{
					$modelType = 'Butler';
				}
				elseif (ord($modelCode) < ord('z'))
				{
					$modelType = 'Companion';
				}

				switch ($partCode)
				{
					case 1:
						$partType = 'Top';
						break;
					case 2:
						$partType = 'Torso';
						break;
					case 3:
						$partType = 'Bottom';
						break;
					default:
						break;
				}

				$parts_list[] = array('id' => $part->id, 'partCode' => $modelPart, 
									  'partType' => $partType, 'caCode' => $part->caCode, 
									  'modelType' => $modelType);
			}
		}
		$this->data['parts'] = $parts_list;
		$this->data['ptitle'] = "Parts<span class=\"glyphicon glyphicon-tag\"></span>";
		$this->render();
	}
	
	public function details($id)
	{
		$this->data['pagetitle'] = 'Part Details';
		$this->data['pagebody'] = 'partsDetails';
        
        foreach ($this->parts->all() as $part)
        {
            if ($part->id == $id)
            {
                $var = ''.$part->model.$part->piece;
                $this->data['id'] = $part->id;
                $this->data['partCode'] = $var;
                $this->data['CA'] = $part->caCode;
                $this->data['location'] = $part->plant;
                $this->data['date'] = $part->dateTime;
            }
        }
		
        $this->data['ptitle'] = " <span class=\"glyphicon glyphicon-paperclip\"></span> Part Detail";
		$this->render();
	}
    
    public function buildParts()
    {
        $parts = file_get_contents('https://umbrella.jlparry.com/work/mybuilds?key=4621cf');
        $parts = json_decode($parts, true);

        foreach ($parts as $part) {
            $newPart = $this->parts->create();

            $newPart->id = $this->parts->size();
            $newPart->caCode = $part['id'];
            $newPart->model = $part['model'];
            $newPart->piece = $part['piece'];
            $newPart->plant = $part['plant'];
            $newPart->dateTime = $part['stamp'];
            $newPart->used = 0;

            $this->parts->add($newPart);
            
            $newHistory = $this->histories->create();

            $newHistory->id = $this->histories->size();
            $newHistory->transactionType = "Built Part ".$newPart->caCode;
            $newHistory->value = 0;
            $newHistory->dateTime = $date = date('Y-m-d');

            $this->histories->add($newHistory);
        }
        redirect('/part');
    }
    
    public function buyBox()
    {
        $parts = file_get_contents('https://umbrella.jlparry.com/work/buybox?key=4621cf');
        $parts = json_decode($parts, true);

        $newHistory = $this->histories->create();

        $newHistory->id = $this->histories->size();
        $newHistory->transactionType = "Buy Box";
        $newHistory->value = -100;
        $newHistory->dateTime = $parts[0]['stamp'];

        $this->histories->add($newHistory);

        foreach ($parts as $part) {
            $newPart = $this->parts->create();

            $newPart->id = $this->parts->size();
            $newPart->caCode = $part['id'];
            $newPart->model = $part['model'];
            $newPart->piece = $part['piece'];
            $newPart->plant = $part['plant'];
            $newPart->dateTime = $date = date('Y-m-d');
            $newPart->used = 0;

            $this->parts->add($newPart);
        }
        redirect('/part');
    }
}
