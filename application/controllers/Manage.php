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
        
		$this->data['ptitle'] = "Manage<span class=\"glyphicon glyphicon-tag\"></span>";
        $this->render();
    }
}
