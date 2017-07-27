<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Feedback
 * @property generalfunction_library $generalfunction_library
 * @property Feedback_model $feedback_model
 */

class Feedback extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('feedback_model');
        $this->apiserver->require_scope('feedback');
    }

    public function index()
    {
        echo 'Nothing Here!';
    }

    public function NPSByLocation()
    {
        $post = $this->input->post();
        $data = array();
        if(isset($post['startDate']) && isset($post['endDate']) && isset($post['locId']))
        {
            $npsData = $this->feedback_model->getNpsByLocTime($post['startDate'],$post['endDate'],$post['locId']);
            if(isset($npsData) && myIsArray($npsData))
            {
                $data['status'] = true;
                $data['npsData'] = $npsData;
            }
            else
            {
                $data['status'] = false;
                $data['error'] = 'No NPS Data Found!';
            }
        }
        else
        {
            $data['status'] = false;
            $data['error'] = 'Time Span and Location required!';
        }

        echo json_encode($data);
    }

    public function NPSByAllLocations()
    {
        $post = $this->input->post();
        $data = array();
        if(isset($post['startDate']) && isset($post['endDate']))
        {
            $locs = $this->feedback_model->getAllLocs();
            if(isset($locs) && myIsArray($locs))
            {
                foreach($locs as $key => $row)
                {
                    $npsData = $this->feedback_model->getNpsByLocTime($post['startDate'],$post['endDate'],$row['id']);
                    if(isset($npsData) && myIsArray($npsData))
                    {
                        $data['npsData'][$row['id']] = $npsData;
                    }
                }
                $data['status'] = true;
            }
            else
            {
                $data['status'] = false;
                $data['error'] = 'Location Search Error!';
            }
        }
        else
        {
            $data['status'] = false;
            $data['error'] = 'Time Span is required!';
        }

        echo json_encode($data);
    }

}
