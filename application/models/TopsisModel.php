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

	public function getDataTopKriteriaMinuman()
	{
		return $this->db->get('top_kriteria_minuman')->result_array();
		
	}

	public function getDataTopAlternatifMinuman()
	{
		return $this->db->get('top_alternatif_minuman')->result_array();
	}

	public function getDataTopSampleMinuman()
	{
		return $this->db->get('top_sample_minuman')->result_array();
	}

	public function getDataTopKriteriaJajanan()
	{
		return $this->db->get('top_kriteria_jajanan')->result_array();
		
	}

	public function getDataTopAlternatifJajanan()
	{
		return $this->db->get('top_alternatif_jajanan')->result_array();
	}

	public function getDataTopSampleJajanan()
	{
		return $this->db->get('top_sample_jajanan')->result_array();
	}

	public function getDataTopKriteriaCafe()
	{
		return $this->db->get('top_kriteria_cafe')->result_array();
		
	}

	public function getDataTopAlternatifCafe()
	{
		return $this->db->get('top_alternatif_cafe')->result_array();
	}

	public function getDataTopSampleCafe()
	{
		return $this->db->get('top_sample_cafe')->result_array();
	}

	public function getDataTopKriteriaLaptop()
	{
		return $this->db->get('top_kriteria_laptop')->result_array();
		
	}

	public function getDataTopAlternatifLaptop()
	{
		return $this->db->get('top_alternatif_laptop')->result_array();
	}

	public function getDataTopSampleLaptop()
	{
		return $this->db->get('top_sample_laptop')->result_array();
	}
}