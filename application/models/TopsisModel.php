<?php

class TopsisModel extends CI_Model
{
	
	public function getDataTopKriteria()
	{
		return $this->db->get('top_kriteria_makanan')->result_array();
		
	}

	public function getDataTopAlternatif()
	{
		return $this->db->get('top_alternatif_makanan')->result_array();
	}

	public function getDataTopSample()
	{
		return $this->db->get('top_sample_makanan')->result_array();
	}

	public function getDataTopKriteriaHandphone()
	{
		return $this->db->get('top_kriteria_handphone')->result_array();
		
	}

	public function getDataTopAlternatifHandphone()
	{
		return $this->db->get('top_alternatif_handphone')->result_array();
	}

	public function getDataTopSampleHandphone()
	{
		return $this->db->get('top_sample_handphone')->result_array();
	}
}