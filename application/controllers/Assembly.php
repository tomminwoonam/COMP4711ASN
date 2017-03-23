<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assembly extends Application 
{
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/Assembly.php
	 *	- or -
	 * 		http://example.com/Assembly/index
	 */
	public function index()
	{
        $this->load->model('robots');

		$this->data['pagetitle'] = 'Assembly';
		$this->data['pagebody'] = 'assembly';

        /**
         * Get Parts
         */
		$source = $this->part->all();
		$torso_parts = array();
		$top_parts = array();
		$bottom_parts = array();

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
                    $top_parts[] = array('id' => $record['id'], 'partCode' => $partCode, 'partType' => $partType, 'modelType' => $modelType);
					break;
				case 2:
					$partType = 'Torso';
                    $torso_parts[] = array('id' => $record['id'], 'partCode' => $partCode, 'partType' => $partType, 'modelType' => $modelType);
					break;
				case 3:
					$partType = 'Bottom';
                    $bottom_parts[] = array('id' => $record['id'], 'partCode' => $partCode, 'partType' => $partType, 'modelType' => $modelType);
					break;
				default:
					break;
			}
		}
		$this->data['torso'] = $torso_parts;
        $this->data['top'] = $top_parts;
        $this->data['bottom'] = $bottom_parts;

        /**
         * End get parts
         */

        /**
         * get robots
         */

        $source = $this->robots->all();
        $robots = array();
        foreach($source as $record){
            $robots[] = array('id' => $record['id'], 'topId' => $record['topId'], 'bottomId' => $record['bottomId'], 'torsoId' => $record['torsoId']);
        }
        $this->data['robots'] = $robots;

        /**
         * End get robots
         */
		$this->data['ptitle'] = "<span class=\"glyphicon glyphicon-wrench\"></span>Assembly";
		$this->render();
	}
}
