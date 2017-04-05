<?php
/**
 * This is a "CMS" model for robot parts, but with bogus hard-coded data,
 * so that we don't have to worry about any database setup.
 * This is a mock database model.
 *London Burnaby Toronto New York Hong Kong
 * @author Tom
 */
class Parts extends MY_Model {
	// Constructor
	public function __construct()
	{
		parent::__construct('parts', 'id');
	}
}
?>