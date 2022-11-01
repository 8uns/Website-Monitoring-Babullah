<?php
class Admin extends Controller
{
    public function index()
    {
        $data['judul'] = 'Login';
        $this->view('templates/head', $data);
        $this->view('admin/index');
        // $this->view('templates/foot');
    }

    public function falselogin()
    {
        $data['judul'] = 'Login';
        $this->view('templates/head', $data);
        $this->view('admin/falselogin');
        // $this->view('templates/foot');
    }
}