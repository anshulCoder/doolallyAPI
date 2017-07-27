<?php

/**
 * Class Events_Model
 * @property Mydatafetch_library $mydatafetch_library
 * @property Generalfunction_library $generalfunction_library
 */
class Events_Model extends CI_Model
{
	function __construct()
	{
		parent::__construct();

        $this->load->library('mydatafetch_library');
	}

	public function getTodayEventsByLoc($locId)
    {
        $query = "select l.locName, count(em.eventId) as 'totalEvents' FROM locationmaster l
                  LEFT JOIN eventmaster em ON em.eventPlace = l.id
                  WHERE em.eventDate = CURRENT_DATE() AND em.isEventCancel = 0 AND em.ifActive = ".ACTIVE." AND em.ifApproved = ".EVENT_APPROVED." AND 
                  em.isEventEverywhere = 2 AND l.id = ".$locId;

        $result = $this->db->query($query)->result_array();
        return $result;
    }

    function getTodayEventsDetails($locId)
    {
        $query = "SELECT l.locName, em.eventName, em.eventDescription, em.eventDate, em.startTime, em.endTime,
                  (SELECT SUM(quantity) FROM eventregistermaster WHERE isUserCancel = 0 AND eventId = em.eventId) as 'totalAttendees'
                  FROM eventmaster em
                  LEFT JOIN locationmaster l ON em.eventPlace = l.id 
                  WHERE em.eventDate = CURRENT_DATE() AND 
                  em.isEventCancel = 0 AND em.ifActive = ".ACTIVE." AND em.ifApproved = ".EVENT_APPROVED." AND 
                  em.isEventEverywhere = 2 AND em.eventPlace = ".$locId;

        $result = $this->db->query($query)->result_array();

        return $result;
    }

    function getEventsByTime($startDate,$endDate,$locId)
    {
        $query = "SELECT l.locName, em.eventName, em.eventDate, em.startTime, em.endTime
                    FROM eventmaster em 
                    LEFT JOIN locationmaster l ON em.eventPlace = l.id
                    WHERE em.isEventCancel = 0 AND em.ifActive = ".ACTIVE." AND em.ifApproved = ".EVENT_APPROVED." AND 
                    em.isEventEverywhere = 2 AND em.eventDate >= '".$startDate."' AND em.eventDate <= '".$endDate."' 
                    AND l.id = ".$locId." 
                    ORDER BY em.eventDate ASC";
        $result = $this->db->query($query)->result_array();

        return $result;
    }

    function getAllLocs()
    {
        $query = "SELECT id,locName FROM locationmaster WHERE ifActive = ".ACTIVE;

        $result = $this->db->query($query)->result_array();

        return $result;

    }
    public function saveClientApp($details)
    {
        $details['insertedDT'] = date('Y-m-d H:i:s');
        $this->db->insert('oauth_clients',$details);
        return true;
    }
}

