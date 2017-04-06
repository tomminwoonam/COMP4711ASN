<?php

/**
 * This is a "CMS" model for robots, using MY_Model for connectivity with our sql database.
 *
 * @author Matt
 */
class Robots extends MY_Model {
	// Constructor
	public function __construct()
	{
		parent::__construct('robots','id');
	}
}
?>