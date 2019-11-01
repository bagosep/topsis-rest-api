<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topsis
{
	public $topKriteria, $topAlternatif, $topSample, $kriteria, $bobot, $alternatif, $sample,
	$matriksKeputusanX, $pembagi, $matriksNormalisasiR, $matriksNormalisasiTerbobotY, $aMin, 
	$aMax, $dPlus, $dMin, $nilaiPrefensiV, $hasilRangking;
	

	public function setNilaiTopKriteria($topKriteria)
	{
		$this->topKriteria = $topKriteria;

		return $this->topKriteria;
	}

	public function setNilaiTopAlternatif($topAlternatif)
	{
		$this->topAlternatif = $topAlternatif;

		return $this->topAlternatif;
	}

	public function setNilaiTopSample($topSample)
	{
		$this->topSample = $topSample;

		return $this->topSample;
	}

	public function getNilaiTopKriteria()
	{
		$this->kriteria = array();
		$this->bobot = array();

		//melakukan iterasi pengisian array untuk tiap record data yang didapat
		foreach ($this->topKriteria as $row) {
		    $this->kriteria[$row['id_kriteria']] = array($row['kriteria'],$row['tipe']);
		    $this->bobot[$row['id_kriteria']] = $row['bobot']/100;
		}

	}

	public function getNilaiTopAlternatif()
	{
		$this->alternatif = array();

		//melakukan iterasi pengisian array untuk tiap record data yang didapat
		foreach ($this->topAlternatif as $row) {
		    $this->alternatif[$row['id_alternatif']] = array(
				"alternatif" => $row['alternatif'],
				"gambar" => $row['gambar'],
				"deskripsi" =>$row['deskripsi']
			);
		}
	}

	public function getNilaiTopSample()
	{
		$this->sample = array();

		//melakukan iterasi pengisian array untuk tiap record data yang didapat
		foreach ($this->topSample as $row) {
		    $this->sample[$row['id_alternatif']][$row['id_kriteria']] = $row['nilai'];
		}
		//hasil dari foreach top sample ini menghasilkan matriks keputusan
	}

	//Let's The Battle
	public function getMatriksKeputusan()
	{
		//Menjadikan hasil data $sample sebagai matriks keputusan X.
		$this->getNilaiTopSample();
		$this->matriksKeputusanX = $this->sample;


		//melakukan iterasi utk setiap alternatif
		foreach ($this->matriksKeputusanX as $id_alternatif => $a_kriteria) {
		    //melakukan iterasi utk setiap kriteria
		    foreach($a_kriteria as $id_kriteria => $nilai){
		       // echo $nilai;
		    }
		}
	}

	public function getMatriksNormalisasi()
	{
		$this->pembagi = array();
		$this->getNilaiTopKriteria();
		$this->getNilaiTopAlternatif();
		$this->getMatriksKeputusan();
		//melakukan iterasi utk setiap kriteria
		foreach($this->kriteria as $id_kriteria => $value){
		    $this->pembagi[$id_kriteria] = 0;
		    //melakukan iterasi utk setiap alternatif
		    foreach($this->alternatif as $id_alternatif => $a_value){
		        $this->pembagi[$id_kriteria] = 
		        pow($this->matriksKeputusanX[$id_alternatif][$id_kriteria],2);
		    }
		}

		$this->matriksNormalisasiR = array();
		//melakukan iterasi utk setiap alternatif
		foreach($this->matriksKeputusanX as $id_alternatif => $a_kriteria) {
		    $this->matriksNormalisasiR[$id_alternatif] = array();
		    //melakukan iterasi utk setiap kriteria
		    foreach($a_kriteria as $id_kriteria => $nilai){
		        $this->matriksNormalisasiR[$id_alternatif][$id_kriteria] = $nilai/sqrt($this->pembagi[$id_kriteria]);
		    }
		}    
	}

	public function getMatriksNormalisasiTerbobot()
	{
		//Dari matrik normalisasi R, nilai-nilai itemnya dikalikan dengan bobotnya masing-sing sesuai kriteria-nya sehingga diperoleh matrik normalisasi terbobot Y
		$this->matriksNormalisasiTerbobotY = array();
		$this->getNilaiTopKriteria();
		$this->getMatriksNormalisasi();
		//melakukan iterasi utk setiap alternatif
		foreach($this->matriksNormalisasiR as $id_alternatif => $a_kriteria) {
		    $this->matriksNormalisasiTerbobotY[$id_alternatif] = array();
		    //melakukan iterasi utk setiap kriteria
		    foreach($a_kriteria as $id_kriteria => $nilai){
		        $this->matriksNormalisasiTerbobotY[$id_alternatif][$id_kriteria] =
		         $nilai * $this->bobot[$id_kriteria];
		    }
		}    
	}

	public function getSolusiIdeal()
	{
		//Solusi Ideal A yang merupakan nilai optimum dari matrik normalisasi terbobot Y, di sini dicari masing-masing nilai Solusi Ideal positif A+ dan nilai Solusi Ideal negatif A- untuk tiap-tiap kriteria
		$this->aMax = $this->aMin = array();
		$this->getNilaiTopKriteria();
		$this->getNilaiTopAlternatif();
		$this->getMatriksNormalisasiTerbobot();
		//melakukan iterasi utk setiap kriteria
		foreach($this->kriteria as $id_kriteria => $a_kriteria) {
		    $this->aMax[$id_kriteria] = 0;
		    $this->aMin[$id_kriteria] = 100;
		    //melakukan iterasi utk setiap alternatif
		    foreach($this->alternatif as $id_alternatif => $nilai){
		        if($this->aMax[$id_kriteria] < $this->matriksNormalisasiTerbobotY[$id_alternatif][$id_kriteria]){
		            $this->aMax[$id_kriteria] = $this->matriksNormalisasiTerbobotY[$id_alternatif][$id_kriteria];
		        }
		        if($this->aMin[$id_kriteria] > $this->matriksNormalisasiTerbobotY[$id_alternatif][$id_kriteria]){
		            $this->aMin[$id_kriteria] = $this->matriksNormalisasiTerbobotY[$id_alternatif][$id_kriteria];
		        }
		    }
		}    
	}

	public function getJarakSolusiIdeal()
	{
		//Untuk menghtiung Jarak Solusi Ideal (D), sebelumnya perlu di hitung terlebih dahulu masing-masing Jarak Solusi Ideal Positif (D+) dan Jarak Solusi Ideal Negatif (D-)
		$this->dPlus = $this->dMin = array();
		$this->getMatriksNormalisasiTerbobot();
		$this->getSolusiIdeal();
		//melakukan iterasi utk setiap alternatif
		foreach($this->matriksNormalisasiTerbobotY as $id_alternatif => $nilai){
		    $this->dPlus[$id_alternatif] = 0;
		    $this->dMin[$id_alternatif] = 0;
		    //melakukan iterasi utk setiap kriteria
		    foreach($nilai as $id_kriteria => $y){
		        $this->dPlus[$id_alternatif] += pow($y-$this->aMax[$id_kriteria],2);
		        $this->dMin[$id_alternatif] += pow($y-$this->aMin[$id_kriteria],2);
		    }
		    $this->dPlus[$id_alternatif] = sqrt($this->dPlus[$id_alternatif]);
		    $this->dMin[$id_alternatif] = sqrt($this->dMin[$id_alternatif]);
		}
	}

	public function getNilaiPrefensi()
	{
		$this->nilaiPrefensiV = array();
		$this->getJarakSolusiIdeal();
		//melakukan iterasi utk setiap alternatif
		foreach($this->dMin as $id_alternatif => $nilai){
		    //perhitungan nilai Preferensi V dari nilai jarak solusi ideal D
		    $this->nilaiPrefensiV[$id_alternatif] = $nilai / ($nilai + $this->dPlus[$id_alternatif]);
		}
	}

	public function getRangking()
	{
		$this->getNilaiPrefensi();
		$this->getNilaiTopAlternatif();
		$this->hasilRangking = array();
		$tempRangking = array();
		//mengurutkan data secara descending dengan tetap mempertahankan key/index array-nya
		arsort($this->nilaiPrefensiV);

		foreach ($this->nilaiPrefensiV as $key => $value) {
			$this->hasilRangking[] = array(
				"kategori" => $this->alternatif[$key],
				"prefensi" => $this->nilaiPrefensiV[$key]
			);
		}

		return $this->hasilRangking;
		
	}

}