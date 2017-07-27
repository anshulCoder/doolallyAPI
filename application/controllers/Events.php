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
        $this->apiserver->require_scope('events');
    }

    public function index()
    {
        echo 'Nothing Here!';
    }

    //First End Point
    public function getDailyEventsCount()
    {
        $data= array();
        $post = $this->input->post();
        if(isset($post['locId']))
        {
            $events = $this->events_model->getTodayEventsByLoc($post['locId']);
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
        }
        else
        {
            $data['status'] = false;
            $data['message'] = 'Please Provide the Location Id!';
        }

        echo json_encode($data);
    }

    //Second End Point
    public function getDailyEventsInfo()
    {
        $data = array();
        $post = $this->input->post();

        if(isset($post['locId']))
        {
            $eventD = $this->events_model->getTodayEventsDetails($post['locId']);
            if(isset($eventD) && myIsArray($eventD))
            {
                $data['status'] = true;
                $data['eventDetails'] = $eventD;
            }
            else
            {
                $data['status'] = false;
                $data['error'] = 'No Events Found!';
            }
        }
        else
        {
            $data['status'] = false;
            $data['message'] = 'Please Provide the Location Id!';
        }

        echo json_encode($data);
    }

    public function getAllTaprooms()
    {
        $data = array();

        $allLocs = $this->events_model->getAllLocs();

        if(isset($allLocs) && myIsArray($allLocs))
        {
            $data['status'] = true;
            $data['locations'] = $allLocs;
        }
        else
        {
            $data['status'] = false;
            $data['error'] = 'No Taprooms Found!';
        }

        echo  json_encode($data);
    }

    //Third End Point
    public function eventsByTimeSpan()
    {
        $post = $this->input->post();
        $data = array();

        if(isset($post['startDate']) && isset($post['endDate']))
        {
            if(isset($post['locId']))
            {
                $eventData = $this->events_model->getEventsByTime($post['startDate'],$post['endDate'],$post['locId']);
                if(isset($eventData) && myIsArray($eventData))
                {
                    $data['status'] = true;
                    $data['eventDate'] = $eventData;
                }
                else
                {
                    $data['status'] = false;
                    $data['error'] = 'No Scheduled Events!';
                }
            }
            else
            {
                $data['status'] = false;
                $data['error'] = 'Please Provide the Location Id!';
            }
        }
        else
        {
            $data['status'] = false;
            $data['error'] = 'Start or End Date not set!';
        }

        echo  json_encode($data);
    }

}
