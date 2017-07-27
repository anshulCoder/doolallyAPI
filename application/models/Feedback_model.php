<?php

/**
 * Class Feedback_Model
 * @property Mydatafetch_library $mydatafetch_library
 * @property Generalfunction_library $generalfunction_library
 */
class Feedback_Model extends CI_Model
{
	function __construct()
	{
		parent::__construct();

        $this->load->library('mydatafetch_library');
	}


    function getNpsByLocTime($startDate, $endDate, $locId)
    {
        $query = "SELECT DISTINCT (SELECT COUNT(overallRating) FROM usersfeedbackmaster 
                 WHERE feedbackLoc = ".$locId." AND (DATE(insertedDateTime) >= '".$startDate."' AND DATE(insertedDateTime) <= '".$endDate."')) as 'total_forms',
                 (SELECT COUNT(overallRating) FROM usersfeedbackmaster 
                 WHERE feedbackLoc = ".$locId." AND overallRating >= 9 AND (DATE(insertedDateTime) >= '".$startDate."' AND DATE(insertedDateTime) <= '".$endDate."')) as 'promoters',
                 (SELECT COUNT(overallRating) FROM usersfeedbackmaster 
                 WHERE feedbackLoc = ".$locId." AND overallRating < 7 AND (DATE(insertedDateTime) >= '".$startDate."' AND DATE(insertedDateTime) <= '".$endDate."')) as 'detractors', 
                 locName FROM locationmaster WHERE id = ".$locId;

        $result = $this->db->query($query)->row_array();
        return $result;
    }

    function getAllLocs()
    {
        $query = "SELECT id,locName FROM locationmaster WHERE ifActive = ".ACTIVE;

        $result = $this->db->query($query)->result_array();

        return $result;

    }
}

