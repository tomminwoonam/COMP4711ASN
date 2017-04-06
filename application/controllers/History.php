<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This is the controller for the History page.
 * This uses Histories model to populate page data.
 *
 * @author Amir
 */
class History extends Application
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/History.php
     *	- or -
     * 		http://example.com/History/index
     */
    public function index()
    {
        $this->data['pagetitle'] = 'History';
        $this->data['pagebody'] = 'history';

        //$this->load->model('histories');
        //$source = $this->histories->all();

        $history_list = array();

        foreach ($this->histories->all() as $record)
        {
            $history_list[] = array('id' => $record->id, 'historyType' => $record->transactionType, 
                                    'dateTime' => $record->dateTime,'value' => $record->value);
        }

        $this->data['history'] = $history_list;
        $this->data['ptitle'] = "<span glyphicon class=\"glyphicon glyphicon-calendar\"></span>History";
        $this->render();
    }
}
