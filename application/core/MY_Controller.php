<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property Mydatafetch_library $mydatafetch_library
 * @property Generalfunction_library $generalfunction_library
 * @property Dataformatinghtml_library $dataformatinghtml_library
 * @property Sendemail_library $sendemail_library
 * @property curl_library $curl_library
 * @property Mobile_Detect $mobile_detect
 * @property ApiServer $apiServer
 * @property CI_User_agent $agent
 * @property CI_Session $session
 * @property CI_Config $config
 * @property CI_Loader $load
 * @property CI_Input $input
 */
class MY_Controller extends CI_Controller
{
	public $pageUrl = '';

	public $isUserSession = '';
	public $userType = '';
	public $userId = '';
	public $userName = '';
    public $userFirstName = '';
	public $userEmail = '';
	public $currentLocation = '';

	public $currentUrl = '';

    public $instaMojoStatus = '';
    public $instaEventId = '';


	function __construct()
	{
		parent::__construct();

        $this->load->library('mydatafetch_library');
        $this->load->library('generalfunction_library');
		$this->load->library('dataformatinghtml_library');
        $this->load->library('user_agent');
		$this->load->library('sendemail_library');
		$this->load->library('Mobile_Detect');
		$this->load->library('curl_library');
		$this->load->library('ApiServer');

		//
		if($this->agent->is_referral() == false)
		{
			$this->pageUrl = str_replace('/index.php', '', $this->agent->referrer());
		}
		else
		{
			$this->pageUrl = base_url();
		}


		if (isSession($this->session->username) !== false)
		{
			$this->userName = $this->session->username;
		}

		//
		$this->currentUrl = str_replace('/index.php', '', current_url());
	}
}
