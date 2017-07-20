<?php

/**
 * Class Dashboard_Model
 * @property Mydatafetch_library $mydatafetch_library
 * @property Generalfunction_library $generalfunction_library
 */
class Home_Model extends CI_Model
{
	function __construct()
	{
		parent::__construct();

        $this->load->library('mydatafetch_library');
	}

    public function saveErrorLog($details)
    {
        $details['insertedDateTime'] = date('Y-m-d H:i:s');
        $details['fromWhere'] = 'Beer Olympics';
        $this->db->insert('errorlogger', $details);
        return true;
    }

}

