<?php
class Apierror extends Controller
{
    public function index()
    {
        $this->view('templates/head');
        $this->view('templates/apierror');
        $this->view('templates/foot');
    }
}