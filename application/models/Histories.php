<?php

/**
 * This is a "CMS" model for previous history, using MY_Model for connectivity with our sql database.
 *
 * @author Ntori
 */
class Histories extends MY_Model {
    // Constructor
    public function __construct()
    {
        parent::__construct('histories', 'id');
    }
}
?>