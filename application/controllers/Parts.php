<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parts extends Application 
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
		
		$source = $this->part->all();
		$parts_list = array();
		
		foreach ($source as $record)
		{
			$partCode = $record['partCode'];
			$modelType = '';
			$partType = '';
			
			if (ord(substr($partCode, 0, 1)) >= ord('a') && ord(substr($partCode, 0, 1)) < ord('l'))
			{
				$modelType = 'Household';
			}
			elseif (ord(substr($partCode, 0, 1)) < ord('v'))
			{
				$modelType = 'Butler';
			}
			elseif (ord(substr($partCode, 0, 1)) < ord('z'))
			{
				$modelType = 'Companion';
			}
			
			switch (substr($partCode, 1, 1))
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
			
			$parts_list[] = array('id' => $record['id'], 'partCode' => $partCode, 'partType' => $partType, 'modelType' => $modelType);
		}
		$this->data['parts'] = $parts_list;
		
		$this->render();
	}
	
	public function details($id)
	{
		$this->data['pagetitle'] = 'Part Details';
		$this->data['pagebody'] = 'partsDetails';
		
		$source = $this->part->get($id);
		
		$this->data['id'] = $source['id'];
		$this->data['partCode'] = $source['partCode'];
		$this->data['CA'] = $source['CA'];
		$this->data['location'] = $source['buildLocation'];
		$this->data['date'] = $source['dateTime'];
		
		$this->render();
	}
}
