<?php
class Tenan extends Controller
{
    public function index()
    {
        $data['halaman'] = 'dashboard';
        $data['gambar'] = 'img/img';
        $data['nama'] = $_SESSION['name'];
        $this->view('templates/head', $data);
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('adminupbu/dashboard', $data);
        $this->view('templates/foot');
    }



}
