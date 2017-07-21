<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Home
 * @property generalfunction_library $generalfunction_library
 * @property Home_model $home_model
 */

class Home extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
    }

    public function getAccessToken()
    {
        $this->apiServer->client_credentials();
    }
    public function index()
	{
        $data = array();
        $data['globalStyle'] = $this->dataformatinghtml_library->getGlobalStyleHtml($data);
        $data['globalJs'] = $this->dataformatinghtml_library->getGlobalJsHtml($data);
        $data['headerView'] = $this->dataformatinghtml_library->getHeaderHtml($data);

        $this->load->view('HomeView', $data);
	}

    public function saveErrorLog()
    {
        $post = $this->input->post();

        if(isset($post['errorTxt']))
        {
            if(isset($_SERVER['HTTP_REFERER']))
            {
                $post['refUrl'] = $_SERVER['HTTP_REFERER'];
            }
            $this->home_model->saveErrorLog($post);
        }
        return true;
    }

    public function createClientApp()
    {
        $userName = 'Cynapse';
        $appName = 'Cynapse';
        $grantType = 'client_credentials';
        $scope = 'events';
        $redirectUri = 'https://cynapse.com';

        $clientId = hash_hmac('sha1',$appName,$userName);
        $clientSecret = bin2hex(openssl_random_pseudo_bytes(16));

        $appData = array(
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'redirect_uri' => $redirectUri,
            'grant_types' => $grantType,
            'scope' => $scope,
            'user_id' => $userName
        );

        $this->home_model->saveClientApp($appData);

    }

}
