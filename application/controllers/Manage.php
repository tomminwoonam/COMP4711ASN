<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends Application 
{
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/Manage.php
	 *	- or -
	 * 		http://example.com/Manage/index
	 */
	public function index()
	{

		$this->data['pagetitle'] = 'Manage';
		$this->data['pagebody'] = 'manage';
        
        //Check form data
		$results = array();
		if(isset($_POST['action'])) 
		{
			switch ($_POST['submit'])
			{
				case "Sell Robot":
					$results = $this->sellRobot();
					break;
				case "Register";
					$results = $this->registerMe();
					break;
				case "Reboot Me":
					$results = $this->rebootMe();
					break;
				default;
					$results[] = array('output' => "WTF happend?");
			}
		}
		$this->data['results'] = $results;
        
        //Get Settings Info
        $this->loadSettings();
        
        //Get Robots
        $this->loadBots();
            
		$this->data['ptitle'] = "Manage<span class=\"glyphicon glyphicon-tag\"></span>";
        $this->render();
    }
    
    /**
	 * function that sells a bot (in accordance to parts) sent by POST.
	 */
    function sellRobot()
    {
		$results[] = array('output' => "Robot sold:");
        if(!empty($_POST['botInfo']))
        {
            //Get API key
            $secrets = array();
            foreach($this->secrets->all() as $secret)
            {
                $secrets[] = array('type' => $secret->type, 'value' => $secret->value);
                break;
            }
            $apiKey = $secrets[0]['value'];

            //Find what the bots parts are
            if(count($_POST['botInfo']) == 1)
            {
                $bot = explode(" ", $_POST['botInfo'][0]);
                $results[] = array('output' => 
                                   "id: ".$bot[0].", botCode: ".$bot[1].
                                   ", topCode: ".$bot[2]. ", torsoCode: ".$bot[3].
                                   ", bottomCode: ".$bot[4]);

                //Ship the robot to Umbrella Corp
                $reply = file_get_contents('https://umbrella.jlparry.com/work/buymybot/'.
                                           $bot[2].'/'.
                                           $bot[3].'/'.
                                           $bot[4].'?key='.
                                           $apiKey);
                $amount = explode(" ", $reply);

                $results[] = array('output' => "sold ".$bot[1]." for $".$amount[1].".");

                //Remove parts from robot from parts list
                $threeIsDone = 0;
                foreach ($this->parts->all() as $part)
                {
                    if ($part->caCode == $bot[2] || $part->caCode == $bot[3] || $part->caCode == $bot[4])
                    {
                        $threeIsDone++;
                        $this->parts->delete($part->id);
                        if($threeIsDone >= 3)
                            break;
                    }
                }

                //Remove robot from robot list
                $this->robots->delete($bot[0]);

                //Record the shipment in history
                $newHistory = $this->histories->create();

                $newHistory->id = $this->histories->size();
                $newHistory->transactionType = "Shipped Robot ".$bot[1];
                $newHistory->value = $amount[1];
                $newHistory->dateTime = $date = date('Y-m-d');

                $this->histories->add($newHistory);
                
            }
            else
            {
                $results[] = array('output' => "Only ONE robot should be chosen at a time!");
            }
        }
        else
        {
            $results[] = array('output' => "No robot picked!");
        }
        
        return $results;
    }
    
    /**
	 * function that establishes a new session (api key) on PRC.
	 */
    function registerMe()
    {
        //Get the token
        $secrets = $this->secrets->get(3);
        $type[] = $secrets->type;
        $token = $secrets->value;
        
        //Check inputed token
        if($_POST['registerTokenCheck'] == $token)
        {
            $reply = file_get_contents('https://umbrella.jlparry.com/work/registerme/mango/'.
                                       $token);
            $response = explode(" ", $reply);

            if($response[0] == "Ok")
            {
                //Change stored api value
                $secretApi = $this->secrets->get(0);
                $secretApi->value = $response[1];
                $this->secrets->update($secretApi);
                $results[] = array('output' => "Used ".$type[0].$token." and changed the ".$secretApi->type." to: ".$response[1]);
            }
            else
            {
                $results[] = array('output' => "Request failed!");
                $results[] = array('output' => implode(" ",$response));
            }
        }
        else
        {
            $results[] = array('output' => "Incorrect token!");
        }
        
        return $results;
    }
    
    /**
	 * function that resets (reboots) all information of the factory on the PRC.
	 */
    function rebootMe()
    {
        //Get the token
        $secrets = $this->secrets->get(3);
        $type[] = $secrets->type;
        $token = $secrets->value;
        
        //Check inputed token
        if($_POST['rebootTokenCheck'] == $token)
        {
            //Get apiKey
            $secretApi = $this->secrets->get(0);
            $apiKey = $secretApi->value;
            
            $reply = file_get_contents('https://umbrella.jlparry.com/work/rebootme?key='.
                                       $apiKey);
            $response = explode(" ", $reply);

            if($response[0] == "Ok"  && $response != null)
            {
                //Change stored api value
                $secretApi = $this->secrets->get(0);
                $secretApi->value = $response[1];
                $this->secrets->update($secretApi);
                $results[] = array('output' => "Used ".$type[0].$token." and changed the ".$secretApi->type." to: ".$response[1]);
            }
            else
            {
                $results[] = array('output' => "Request failed!");
                $results[] = array('output' => implode(" ",$response));
            }
        }
        else
        {
            $results[] = array('output' => "Incorrect token!");
        }
        
        return $results;
    }
    
    /**
	 * function that loads list of info the BOSS uses.
	 */
    function loadSettings()
    {
        $type = array();
        
        //Connect to database
        $secrets = array();
        foreach($this->secrets->all() as $secret)
        {
            $secrets[] = array('type' => $secret->type, 'value' => $secret->value);
        }
        
        //Get API key
        $type[] = $secrets[0]['type'];
        $apiKey = $secrets[0]['value'];
        
        //Get number of parts processed
        $type[] = $secrets[1]['type'];
        $partsId = intval($secrets[1]['value']); //use strval() to inverse
        
        //Get number of robots made
        $type[] = $secrets[2]['type'];
        $robotsId = intval($secrets[2]['value']); //use strval() to inverse
        
        //Get token
        $type[] = $secrets[3]['type'];
        $token = $secrets[3]['value'];
        
        $this->data['type'] = $type;
        $this->data['token'] = $token;
        $this->data['apiKey'] = $apiKey;  
        $this->data['partsId'] = $partsId;  
        $this->data['robotsId'] = $robotsId;
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
