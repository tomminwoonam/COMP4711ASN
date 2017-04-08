<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This is the controller for the Assembly page.
 * This uses the Parts, Robots models to populate page data,
 * uses Secrets model to connect to the PCR to return parts,
 * and uses Histories model to add robot builds.
 *
 * @author Matt
 */
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
		$this->data['pagetitle'] = 'Assembly';
		$this->data['pagebody'] = 'assembly';
		
		//Get form data
		$results = array();
		if(isset($_POST['action'])) 
		{
			switch ($_POST['submit'])
			{
				case "Build Bot":
					$results = $this->buildBot();
					break;
				case "Return to Head Office";
					$results = $this->returnPart();
					break;
				case "Ship to Head Office":
					$results = $this->shipRobot();
					break;
				default;
					$results[] = array('output' => "WTF happend?");
			}
		}
		$this->data['results'] = $results;
		
        //Get Parts
		$this->loadParts();
		
        //Get Robots
		$this->loadBots();
		
		$this->data['ptitle'] = "<span class=\"glyphicon glyphicon-wrench\"></span>Assembly";
        
		$this->render();
	}
    
	/**
	 * function that build a bot out of parts sent by POST.
	 */
	function buildBot()
	{
		$results[] = array('output' => "Built Bot with parts:");
		
		//Check if part selected properly
		if(empty($_POST['topSelected']) || empty($_POST['torsoSelected']) || empty($_POST['bottomSelected']))
		{
			$results[] = array('output' => "You must select one of each part section!");
			return $results;
		}
		if(count($_POST['topSelected']) > 1)
		{
			$results[] = array('output' => "Too many top parts (Please only select one!)");
			return $results;
		}
		if(count($_POST['torsoSelected']) > 1)
		{
			$results[] = array('output' => "Too many torso parts (Please only select one!)");
			return $results;
		}
		if(count($_POST['bottomSelected']) > 1)
		{
			$results[] = array('output' => "Too many bottom parts (Please only select one!)");
			return $results;
		}
		
		//Get the parts selected and display result
		$topPart = $_POST['topSelected'][0];
		$top = explode(" ", $topPart);
		$results[] = array('output' => "TOP: id: ".$top[0].", partCode: ".$top[1].", caCode: ".$top[2]);
		$torsoPart = $_POST['torsoSelected'][0];
		$torso = explode(" ", $torsoPart);
		$results[] = array('output' => "TORSO: id: ".$torso[0].", partCode: ".$torso[1].", caCode: ".$torso[2]);
		$bottomPart = $_POST['bottomSelected'][0];
		$bottom = explode(" ", $bottomPart);
		$results[] = array('output' => "BOTTOM: id: ".$bottom[0].", partCode: ".$bottom[1].", caCode: ".$bottom[2]);
		
		//Set the parts used to make the bot as used
		$topPartToUpdate = $this->parts->get($top[0]);
		$topPartToUpdate->used = 1;
		$this->parts->update($topPartToUpdate);
		$torsoPartToUpdate = $this->parts->get($torso[0]);
		$torsoPartToUpdate->used = 1;
		$this->parts->update($torsoPartToUpdate);
		$bottomPartToUpdate = $this->parts->get($bottom[0]);
		$bottomPartToUpdate->used = 1;
		$this->parts->update($bottomPartToUpdate);
		
		//Build a bot with selected parts
		$newBot = $this->robots->create();
		$botSecret = $this->secrets->get(2);
        $botCount = intval($botSecret->value);
        $botSecret->value = strval(intval($botSecret->value)+1);
        $this->secrets->update($botSecret);
        $plantSecret = $this->secrets->get(4);
        $plantName = $plantSecret->value;
		
		$newBot->botCode = $plantName.$botCount;
		$newBot->topCode = $top[2];
		$newBot->torsoCode = $torso[2];
		$newBot->bottomCode = $bottom[2];
		$newBot->topId = $top[1];
		$newBot->torsoId = $torso[1];
		$newBot->bottomId = $bottom[1];

		$this->robots->add($newBot);
		
		//Record the building of a bot in history
		$newHistory = $this->histories->create();

		$newHistory->transactionType = "Built Robot ".$newBot->botCode;
		$newHistory->value = 0;
		$newHistory->dateTime = $date = date('Y-m-d');

		$this->histories->add($newHistory);
		
		return $results;
	}
	
	/**
	 * function that returns list of parts sent by POST.
	 */
	function returnPart()
	{
		$results[] = array('output' => "Returned parts:");
		
		//Check if any parts were selected
		if(empty($_POST['topSelected']) && empty($_POST['torsoSelected']) && empty($_POST['bottomSelected']))
		{
			$results[] = array('output' => "No parts selected for return.");
			return $results;
		}
		
		//Get the parts selected and display result
		$partToReturn = array();
		if(!empty($_POST['topSelected']))
		{
			foreach($_POST['topSelected'] as $topPart)
			{
				$part = explode(" ", $topPart);
				$results[] = array('output' => "TOP: id: ".$part[0].", partCode: ".$part[1].", caCode: ".$part[2]);
				$partToReturn[] = array('id' => $part[0], 'caCode' => $part[2]);
			}
		}
		if(!empty($_POST['torsoSelected']))
		{
			foreach($_POST['torsoSelected'] as $torsoPart)
			{
				$part = explode(" ", $torsoPart);
				$results[] = array('output' => "TORSO: id: ".$part[0].", partCode: ".$part[1].", caCode: ".$part[2]);
				$partToReturn[] = array('id' => $part[0], 'caCode' => $part[2]);
			}
		}
		if(!empty($_POST['bottomSelected']))
		{
			foreach($_POST['bottomSelected'] as $bottomPart)
			{
				$part = explode(" ", $bottomPart);
				$results[] = array('output' => "BOTTOM: id: ".$part[0].", partCode: ".$part[1].", caCode: ".$part[2]);
				$partToReturn[] = array('id' => $part[0], 'caCode' => $part[2]);
			}
		}
		
        //Get apiKey
        $secretApi = $this->secrets->get(0);
        $apiKey = $secretApi->value;
        
		//Return parts selected
		for($i = 0; $i < count($partToReturn); $i++)
		{
			$reply = file_get_contents('https://umbrella.jlparry.com/work/recycle/'.
                                       $partToReturn[$i]['caCode'].
                                       '?key='.$apiKey);
			$amount = explode(" ", $reply);
			
			//Remove part form parts list
			$this->parts->delete($partToReturn[$i]['id']);
	
			//Record the return of parts in history
			$newHistory = $this->histories->create();

			$newHistory->transactionType = "Returned Part ".$partToReturn[$i]['caCode'];
			$newHistory->value = $amount[1];
			$newHistory->dateTime = $date = date('Y-m-d');

			$this->histories->add($newHistory);
		}
		
		return $results;
	}
	
    
	/**
	 * function that loads list of parts that can be used to make a bot.
	 */
	function loadParts()
	{
		$torso_parts = array();
		$top_parts = array();
		$bottom_parts = array();

		foreach ($this->parts->all() as $part)
		{
            if($part->used == 0)
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
						$top_parts[] = array('id' => $part->id, 'partCode' => $modelPart, 
											 'partType' => $partType, 'modelType' => $modelType,
											 'caCode' => $part->caCode);
						break;
					case 2:
						$partType = 'Torso';
						$torso_parts[] = array('id' => $part->id, 'partCode' => $modelPart, 
											   'partType' => $partType, 'modelType' => $modelType,
											   'caCode' => $part->caCode);
						break;
					case 3:
						$partType = 'Bottom';
						$bottom_parts[] = array('id' => $part->id, 'partCode' => $modelPart, 
												'partType' => $partType, 'modelType' => $modelType,
												'caCode' => $part->caCode);
						break;
					default:
						break;
				}
			}
		}
        $this->data['top'] = $top_parts;
		$this->data['torso'] = $torso_parts;
        $this->data['bottom'] = $bottom_parts;
		
	}
    
	/**
	 * function that loads list of bots that are currently held.
	 */
	function loadBots()
	{
        $robots = array();
        foreach($this->robots->all() as $bot){
            $robots[] = array('id' => $bot->id, 'botCode' => $bot->botCode,
							  'topId' => $bot->topId, 'topCode' => $bot->topCode, 
							  'torsoId' => $bot->torsoId, 'torsoCode' => $bot->torsoCode, 
							  'bottomId' => $bot->bottomId, 'bottomCode' => $bot->bottomCode);
        }
        $this->data['robots'] = $robots;
        
	}
}
