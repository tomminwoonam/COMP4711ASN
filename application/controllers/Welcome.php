<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This is the controller for the Assembly page.
 * This uses the Secrets, Robots models to populate page data,
 * uses Secrets model to connect to the PCR to sell robots,
 * and uses Histories model to add robot sales.
 *
 * @author Tom
 */
class Welcome extends Application 
{
	function __construct()
	{
		parent::__construct();
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {
		$this->data['pagetitle'] = 'Homepage';
		$this->data['pagebody'] = 'homepage';
        
		//Initialize variables to store needed info
		$partsOnHand = 0;
        $totBotsBuilt = 0;
        $earnings = 0;
        $expenses = 0;
		
		//Get the needed database data
		$partsCount = $this->parts->size();
		$partsOnHand = $partsCount;
		
		$curBotNumber = $this->secrets->get(2);
		$totBotsBuilt = $curBotNumber->value;
		
        foreach ($this->histories->all() as $record)
        {
            if ($record->value > 0)
			{
				$earnings += $record->value;
			}
			else if ($record->value < 0)
			{
				$expenses -= $record->value;
			}
        }
		
		//Load data to the view
        $this->data['totparts'] = $partsOnHand;
        $this->data['totbots'] = $totBotsBuilt;
        $this->data['earnings'] = $earnings;
        $this->data['expenses'] = $expenses;
        
        $this->data['ptitle'] = "<span class=\"plantname\">Mango Plant</span> Dashboard <span class=\"glyphicon glyphicon-dashboard\"></span>";
		$this->render();
	}
}
