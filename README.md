# Topsis Rest API
Sistem Pendukung Keputusan Menggunakan Metode TOPSIS (Technique For Others Reference by Similarity to Ideal Solution).
Dikembangkan dengan Codeigniter 3.10 untuk framework dan Codeigniter REST SERVER untuk rest api.

# Data Tersedia
1. Rekomendasi Makanan
2. Rekomendasi Handphone

# Dokumentasi
1. Import Database pada 
```
./database/topsis
```

2. Pengisian Data
```php
$this->topsis->setNilaiTopKriteria($this->TopsisModel->getDataTopKriteria());
$this->topsis->setNilaiTopAlternatif($this->TopsisModel->getDataTopAlternatif());
$this->topsis->setNilaiTopSample($this->TopsisModel->getDataTopSample());
```
Pada bagian parameter bisa diganti sesuai keinginan. lihat pada bagian model
```
./aplication/model/TopsisModel.php
```
3. Get Rangking
```php
//Panggil method getRangking() dahulu
$this->topsis->getRangking();

//lalu untuk mendapatkan nilai akses properti berikut
$this->topsis->hasilRangking;
```
4. Get Respone JSON dengan CodeIgniter REST SERVER
```php
public function index_get()
{
  $this->topsis->setNilaiTopKriteria($this->TopsisModel->getDataTopKriteria());
  $this->topsis->setNilaiTopAlternatif($this->TopsisModel->getDataTopAlternatif());
  $this->topsis->setNilaiTopSample($this->TopsisModel->getDataTopSample());

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
```

Terimakasih :
# Codeigniter REST SERVER
```
https://github.com/chriskacerguis/codeigniter-restserver
```

# Topsis dengan PHP Native
```
https://cahyadsn.phpindonesia.id/extra/topsis.v2.php
```
