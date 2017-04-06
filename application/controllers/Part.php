<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This is the controller for the Part page.
 * This uses the Parts model to populate page data,
 * uses Secrets model to connect to the PCR to build/ buy parts,
 * and uses Histories model to add the parts built/ boxes bought.
 *
 * @author Matt
 */
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
	 * 		http://example.com/Part.php
	 *	- or -
	 * 		http://example.com/Part/index
	 */
	public function index($result = null)
	{
		$this->data['pagetitle'] = 'Parts';
		$this->data['pagebody'] = 'parts';
        
        $source = array();
        $val = 0;
        
        //Get list of parts and populate table
        foreach($this->parts->all() as $part)
        {
            if($part->used == 0)
            {
                $source[$val] = $part;
                $val++;
            }
        }
        
		$parts_list = array();
        
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
        
        $results = array();
        if($result != null)
        {
            $results[] = $result;
        }
        
        $this->data['results'] = $results;
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
        //Get API key
        $secretApi = $this->secrets->get(0);
        $apiKey = $secretApi->value;
        
        //Request the new parts
        $parts = file_get_contents('https://umbrella.jlparry.com/work/mybuilds?key='.
                                   $apiKey);
        $parts = json_decode($parts, true);

        $numBuilt = 0;
        $modelPiece = "??";
        foreach ($parts as $part) {
            $newPart = $this->parts->create();

            $newPart->caCode = $part['id'];
            $newPart->model = $part['model'];
            $newPart->piece = $part['piece'];
            $newPart->plant = $part['plant'];
            $newPart->dateTime = $part['stamp'];
            $newPart->used = 0;

            $this->parts->add($newPart);
            
            $newHistory = $this->histories->create();

            $newHistory->transactionType = "Built Part ".$newPart->caCode;
            $newHistory->value = 0;
            $newHistory->dateTime = $date = date('Y-m-d');

            $this->histories->add($newHistory);
            
            if($numBuilt == 0)
            {
                $modelPiece = $newPart->model.$newPart->piece;
            }
            $numBuilt++;
        }
        
        if($numBuilt > 0)
            $results = array('output' => "Built ".$numBuilt." ".$modelPiece." parts.");
        else
            $results = array('output' => "Built ".$numBuilt." parts.");
        
        $this->index($results);
    }
    
    public function buyBox()
    {
        //Get API key
        $secretApi = $this->secrets->get(0);
        $apiKey = $secretApi->value;
        
        //Request the new parts
        $parts = file_get_contents('https://umbrella.jlparry.com/work/buybox?key='.
                                   $apiKey);
        if($parts == "Oops: you can't afford that!")
        {
            $results = array('output' => "Could not buy a box.");
            $this->index($results);
        }
        $parts = json_decode($parts, true);

        $newHistory = $this->histories->create();

        $newHistory->transactionType = "Buy Box";
        $newHistory->value = -100;
        $newHistory->dateTime = $date = date('Y-m-d');

        $this->histories->add($newHistory);

        foreach ($parts as $part) {
            $newPart = $this->parts->create();

            $newPart->caCode = $part['id'];
            $newPart->model = $part['model'];
            $newPart->piece = $part['piece'];
            $newPart->plant = $part['plant'];
            $newPart->dateTime = $date = date('Y-m-d');
            $newPart->used = 0;

            $this->parts->add($newPart);
        }
        
        $results = array('output' => "Bought a box.");
        
        $this->index($results);
    }
}
