<?php
/**
 * This is a "CMS" model for secret values, using MY_Model for connectivity with our sql database.
 *
 * @author Tom
 */
class Secrets extends MY_Model {
	// Constructor
	public function __construct()
	{
		parent::__construct('secrets', 'id');
	}
}
?>