<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class TopsisLaptop extends REST_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('TopsisModel');
		$this->load->library('topsis');

	}

	public function index_get()
	{
		$this->topsis->setNilaiTopKriteria($this->TopsisModel->getDataTopKriteriaLaptop());
		$this->topsis->setNilaiTopAlternatif($this->TopsisModel->getDataTopAlternatifLaptop());
		$this->topsis->setNilaiTopSample($this->TopsisModel->getDataTopSampleLaptop());

		$this->topsis->getRangking();

		if ($this->topsis->hasilRangking) {
			$this->response($this->topsis->hasilRangking, REST_Controller::HTTP_OK);
		}
		else{
			$this->response([
	                'status' => false,
	                'message' => 'Error!'
	            ], REST_Controller::HTTP_NOT_FOUND);
		}
	}
}