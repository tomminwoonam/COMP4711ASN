<?php
/**
 * This is a "CMS" model for robot parts, but with bogus hard-coded data,
 * so that we don't have to worry about any database setup.
 * This is a mock database model.
 *London Burnaby Toronto New York Hong Kong
 * @author Tom
 */
class Part extends CI_Model {
	var $data = array(
		array('id' => '1', 'partCode' => 'a1', 'buildLocation' => 'Vancouver', 
		'dateTime' => '02-01-2017 10:54', 'CA' => '000000'),
		array('id' => '2', 'partCode' => 'a2', 'buildLocation' => 'Vancouver', 
		'dateTime' => '02-01-2017 04:40', 'CA' => '000001'),
		array('id' => '3', 'partCode' => 'a3', 'buildLocation' => 'Vancouver', 
		'dateTime' => '02-01-2017 10:30', 'CA' => '000002'),
		array('id' => '4', 'partCode' => 'b1', 'buildLocation' => 'London', 
		'dateTime' => '02-02-2017 18:50', 'CA' => '000003'),
		array('id' => '5', 'partCode' => 'b2', 'buildLocation' => 'London', 
		'dateTime' => '02-02-2017 21:45', 'CA' => '000004'),
		array('id' => '6', 'partCode' => 'b3', 'buildLocation' => 'London', 
		'dateTime' => '02-02-2017 09:30', 'CA' => '000005'),
		array('id' => '7', 'partCode' => 'c1', 'buildLocation' => 'Burnaby', 
		'dateTime' => '02-03-2017 18:50', 'CA' => '000006'),
		array('id' => '8', 'partCode' => 'c2', 'buildLocation' => 'Burnaby', 
		'dateTime' => '02-03-2017 21:45', 'CA' => '000007'),
		array('id' => '9', 'partCode' => 'c3', 'buildLocation' => 'Burnaby', 
		'dateTime' => '02-03-2017 09:30', 'CA' => '000008'),
		array('id' => '10', 'partCode' => 'm1', 'buildLocation' => 'Toronto', 
		'dateTime' => '02-04-2017 18:50', 'CA' => '000009'),
		array('id' => '11', 'partCode' => 'm2', 'buildLocation' => 'Toronto', 
		'dateTime' => '02-04-2017 21:45', 'CA' => '00000A'),
		array('id' => '12', 'partCode' => 'm3', 'buildLocation' => 'Toronto', 
		'dateTime' => '02-04-2017 09:30', 'CA' => '00000B'),
		array('id' => '13', 'partCode' => 'r1', 'buildLocation' => 'New York', 
		'dateTime' => '02-05-2017 18:50', 'CA' => '00000C'),
		array('id' => '14', 'partCode' => 'r2', 'buildLocation' => 'New York', 
		'dateTime' => '02-05-2017 21:45', 'CA' => '00000D'),
		array('id' => '15', 'partCode' => 'r3', 'buildLocation' => 'New York', 
		'dateTime' => '02-05-2017 09:30', 'CA' => '00000E'),
		array('id' => '16', 'partCode' => 'w1', 'buildLocation' => 'Hong Kong', 
		'dateTime' => '02-06-2017 18:50', 'CA' => '00000F'),
		array('id' => '17', 'partCode' => 'w2', 'buildLocation' => 'Hong Kong', 
		'dateTime' => '02-06-2017 21:45', 'CA' => '000011'),
		array('id' => '18', 'partCode' => 'w3', 'buildLocation' => 'Hong Kong', 
		'dateTime' => '02-06-2017 09:30', 'CA' => '000012')
	);
	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
	// retrieve a single part
	public function get($which)
	{
		// iterate over the data until we find the one we want
		foreach ($this->data as $record)
			if ($record['id'] == $which)
				return $record;
		return null;
	}

	// retrieve all of the parts
	public function all()
	{
		return $this->data;
	}
}