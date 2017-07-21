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

	public function getTodayEventsByLoc()
    {
        $query = "select l.locName, count(em.eventId) as 'totalEvents' FROM locationmaster l
                  LEFT JOIN eventmaster em ON em.eventPlace = l.id
                  WHERE em.eventDate = CURRENT_DATE()
                  GROUP BY l.locName";

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

