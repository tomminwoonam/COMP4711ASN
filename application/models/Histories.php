<?php
/**
 * This is a "CMS" model for previous history, but with bogus hard-coded data,
 * so that we don't have to worry about any database setup.
 * This is a mock database model.
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