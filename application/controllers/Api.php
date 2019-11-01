<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use Restserver\Libraries\REST_Controller;


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

class Api extends REST_Controller 
{
    public function __construct() 
    {
        parent::__construct();
        
        // Load these helper to create JWT tokens
        $this->load->helper(['jwt', 'authorization']); 
        $this->load->model('SiswaModel');
        $this->load->library('session');
    }

    public function hello_get()
    {
        $tokenData = 'Hello World!';
        
        // Create a token
        $token = AUTHORIZATION::generateToken($tokenData);
        // Set HTTP status code
        $status = parent::HTTP_OK;
        // Prepare the response
        $response = ['status' => $status, 'token' => $token];
        // REST_Controller provide this method to send responses
        $this->response($response, $status);
    }

    public function upload()
    {
        if($response['errorCode'] == 200){
        $params = json_decode(file_get_contents('php://input'), TRUE);
        $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 100;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;

        $this->load->library('upload', $config);

        $encrypted_gambar = md5($params['orig_filename']);
        $params['orig_filename'] = $params['orig_filename'];
        $params['filename'] = $encrypted_gambar;
        $params['urlgambar']="./upload/".$encrypted_gambar;
        $resp = $this->m_gambar_produk->create_data($params);

            if ($resp['errorCode'] == 200) {
            $stat = "SUCCESS";
            }else{
            $stat = "ERROR";
            }

        $count = array($resp);
        $jsonAr = array(
        "_meta" => array('status' => $stat,'count' => count($count)),
        "result" => $resp
        );
        json_output($resp['errorCode'],$jsonAr);
        }else{
        $respStatus = 201;
        $jsonAr = array(
        "_meta" => array('Status' => 'ERROR','count' => 1),
        "result" => array('errorCode' => 201,'userMessage' => 'Title & Author can\'t empty')
        );
        $resp = $jsonAr;
        json_output($respStatus,$resp);
    }


    public function login_post()
 	{
        // Have dummy user details to check user credentials
        // send via postman
        $dummy_user = [
            'username' => 'Eko',
            'password' => 'test'
        ];
        // Extract user data from POST request
        $siswa = $this->SiswaModel->getSiswa();
        $username = $this->post('username');
        $password = $this->post('password');
        // Check if valid user
        if ($username === $dummy_user['username'] && $password === $dummy_user['password']) {
            
            // Create a token from the user data and send it as reponse
            $token = AUTHORIZATION::generateToken(['username' => $dummy_user['username'], 'isi' => $siswa]);
            // Prepare the response
            $status = parent::HTTP_OK;
            $response = ['status' => $status, 'token' => $token];
       		$Sender = array("data" => $response);
          //  $this->response($response, $status);
         //   redirect('Post/view', $response);

            $this->load->view('tampil', $Sender);
        }
        else {
        	$this->session->set_flashdata('msg','Error');
            redirect('Post/');  
            // $this->response(['msg' => 'Invalid username or password!'], parent::HTTP_NOT_FOUND);
        }
 	}

 	private function verify_request()
	{
	    // Get all the headers
	    $headers = $this->input->request_headers();
	    // Extract the token
	    $token = $headers['Authorization'];
	    // Use try-catch
	    // JWT library throws exception if the token is not valid
	    try {
	        // Validate the token
	        // Successfull validation will return the decoded user data else returns false
	        $data = AUTHORIZATION::validateToken($token);
	        if ($data === false) {
	            $status = parent::HTTP_UNAUTHORIZED;
	            $response = ['status' => $status, 'msg' => 'Unauthorized Access!'];
	            $this->response($response, $status);
	            exit();
	        } else {
	            return $data;
	        }
	    } catch (Exception $e) {
	        // Token is invalid
	        // Send the unathorized access message
	        $status = parent::HTTP_UNAUTHORIZED;
	        $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
	        $this->response($response, $status);
	    }
	}

	public function get_me_data_post()
	{
	    // Call the verification method and store the return value in the variable
	    $data = $this->verify_request();
	    // Send the return data as reponse
	    $status = parent::HTTP_OK;
	    $response = ['status' => $status, 'data' => $data];
	    $this->response($response, $status);
	}
}