<?php
/**
 * This is a "CMS" model for previous history, but with bogus hard-coded data,
 * so that we don't have to worry about any database setup.
 * This is a mock database model.
 *
 * @author Ntori
 */
class Histories extends CI_Model {
    var $data = array(
        array('id' => '1', 'historyType' => 'Purchase', 'dateTime' => '02-01-2017 10:54', 'cost' => '50', 'revenue' => 100),
        array('id' => '2', 'historyType' => 'Assembly', 'dateTime' => '02-01-2017 04:40', 'cost' => '50', 'revenue' => 100),
        array('id' => '3', 'historyType' => 'Shipment', 'dateTime' => '02-01-2017 10:30', 'cost' => '50', 'revenue' => 100),
        array('id' => '4', 'historyType' => 'Assembly', 'dateTime' => '02-02-2017 18:50', 'cost' => '50', 'revenue' => 100),
        array('id' => '5', 'historyType' => 'Purchase', 'dateTime' => '02-02-2017 21:45', 'cost' => '50', 'revenue' => 100),
        array('id' => '6', 'historyType' => 'Assembly', 'dateTime' => '02-02-2017 09:30', 'cost' => '50', 'revenue' => 100),
        array('id' => '7', 'historyType' => 'Shipment', 'dateTime' => '02-03-2017 18:50', 'cost' => '50', 'revenue' => 100),
        array('id' => '8', 'historyType' => 'Purchase', 'dateTime' => '02-03-2017 21:45', 'cost' => '50', 'revenue' => 100),
        array('id' => '9', 'historyType' => 'Assembly', 'dateTime' => '02-03-2017 09:30', 'cost' => '50', 'revenue' => 100),
        array('id' => '10', 'historyType' => 'Shipment', 'dateTime' => '02-04-2017 18:50', 'cost' => '50', 'revenue' => 100),
        array('id' => '11', 'historyType' => 'Assembly', 'dateTime' => '02-04-2017 21:45', 'cost' => '50', 'revenue' => 100),
        array('id' => '12', 'historyType' => 'Purchase', 'dateTime' => '02-04-2017 09:30', 'cost' => '50', 'revenue' => 100),
        array('id' => '13', 'historyType' => 'Shipment', 'dateTime' => '02-05-2017 18:50', 'cost' => '50', 'revenue' => 100),
        array('id' => '14', 'historyType' => 'Purchase', 'dateTime' => '02-05-2017 21:45', 'cost' => '50', 'revenue' => 100),
        array('id' => '15', 'historyType' => 'Assembly', 'dateTime' => '02-05-2017 09:30', 'cost' => '50', 'revenue' => 100),
        array('id' => '16', 'historyType' => 'Shipment', 'dateTime' => '02-06-2017 18:50', 'cost' => '50', 'revenue' => 100),
        array('id' => '17', 'historyType' => 'Assembly', 'dateTime' => '02-06-2017 21:45', 'cost' => '50', 'revenue' => 100),
        array('id' => '18', 'historyType' => 'Purchase', 'dateTime' => '02-06-2017 09:30', 'cost' => '50', 'revenue' => 100)
    );
    // Constructor
    public function __construct()
    {
        parent::__construct();
    }
    // retrieve a single quote
    public function get($which)
    {
        // iterate over the data until we find the one we want
        foreach ($this->data as $record)
            if ($record['id'] == $which)
                return $record;
        return null;
    }
    // retrieve all of the quotes
    public function all()
    {
        return $this->data;
    }
}
