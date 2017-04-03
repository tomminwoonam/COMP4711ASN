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
        
		foreach ($source as $part)
		{
            $modelCode = $part->model;
            $modelType = '';
            $partCode = $part->piece;
            $partType = '';

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

            $parts_list[] = array('id' => $part->id, 'partCode' => ''.$modelCode.$partCode, 'partType' => $partType, 'modelType' => $modelType);
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
}
