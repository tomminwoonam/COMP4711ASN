<?php
/**
 * This is a "CMS" model for robots, but with bogus hard-coded data,
 * so that we don't have to worry about any database setup.
 * This is a mock database model.
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