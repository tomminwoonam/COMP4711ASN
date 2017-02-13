<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
        
        
        $this->load->model('histories');
        
		$sourceone = $this->part->all();
        $sourcetwo = $this->histories->all();
        
		$countparts = 0;
        $countbots = 0;
        $countexpence = 0;
        $countrevenue = 0;
        
		foreach ($sourceone as $parts) {
            $countparts++;
        }
        
        foreach ($sourcetwo as $record)
        {
            $countexpence += $record['cost'];
            $countrevenue += $record['revenue'];
            $countbots++;
        }
        
        $dashboard = array(
            'totparts' => $countparts,
            'totbots' => $countbots,
            'earnings' => $countexpence,
            'expenses' => $countrevenue,
        );
        
        $this->data['totbots'] = $countbots;
        $this->data['totparts'] = $countparts;
        $this->data['earnings'] = $countrevenue;
        $this->data['expenses'] = $countexpence;
        
        $this->data['ptitle'] = "Summary";
		$this->render();
	}
}
