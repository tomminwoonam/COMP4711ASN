<?php

/**
 * This is a "CMS" model for robot parts, using MY_Model for connectivity with our sql database.
 *
 * @author Matt
 */
class Parts extends MY_Model {
	// Constructor
	public function __construct()
	{
		parent::__construct('parts', 'id');
	}
}
?>