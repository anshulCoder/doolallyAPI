<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Events
 * @property generalfunction_library $generalfunction_library
 * @property Events_model $events_model
 */

class Events extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('events_model');
        $this->apiServer->require_scope('events');
    }

    public function getDailyEvents()
    {
        $data= array();
        $events = $this->events_model->getTodayEventsByLoc();
        if(isset($events) && myIsArray($events))
        {
            $data['status'] = true;
            $data['eventData'] = $events;
        }
        else
        {
            $data['status'] = false;
            $data['message'] = 'No Events Scheduled!';
        }
        echo json_encode($data);
    }

    public function index()
	{
        $data = array();
        $data['globalStyle'] = $this->dataformatinghtml_library->getGlobalStyleHtml($data);
        $data['globalJs'] = $this->dataformatinghtml_library->getGlobalJsHtml($data);
        $data['headerView'] = $this->dataformatinghtml_library->getHeaderHtml($data);

        $this->load->view('HomeView', $data);
	}


}
