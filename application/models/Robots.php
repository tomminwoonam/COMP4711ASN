<?php
/**
 * This is a "CMS" model for robots, but with bogus hard-coded data,
 * so that we don't have to worry about any database setup.
 * This is a mock database model.
 * @author Matt
 */
class Robots extends CI_Model {
	var $data = array(
		array('id' => '1', 'topId' => 'a1', 'bottomId' => 'a2',
		'torsoId' => 'a3'),
        array('id' => '2', 'topId' => 'b1', 'bottomId' => 'b2',
            'torsoId' => 'b3'),
        array('id' => '3', 'topId' => 'c1', 'bottomId' => 'c2',
            'torsoId' => 'c3'),
        array('id' => '4', 'topId' => 'm1', 'bottomId' => 'm2',
            'torsoId' => 'm3'),
        array('id' => '5', 'topId' => 'r1', 'bottomId' => 'r2',
            'torsoId' => 'r3'),
        array('id' => '6', 'topId' => 'w1', 'bottomId' => 'w2',
            'torsoId' => 'w3')
	);
	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
	// retrieve a single robot
	public function get($which)
	{
		// iterate over the data until we find the one we want
		foreach ($this->data as $record)
			if ($record['id'] == $which)
				return $record;
		return null;
	}

	// retrieve all of the robots
	public function all()
	{
		return $this->data;
	}
}
?>