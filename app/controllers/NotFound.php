<?php
class NotFound extends Controller
{
    public function index()
    {
        $data['judul'] = '';

        $this->view('templates/head', $data);
        $this->view('templates/notfound', $data);
        // $this->view('templates/footer');
    }
}