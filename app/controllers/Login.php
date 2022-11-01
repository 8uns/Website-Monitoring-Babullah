<?php
class Login extends Controller
{
    public function index()
    {
        $data['judul'] = 'Login';
        $this->view('templates/head', $data);
        $this->view('admin/index');
        // $data['judul'] = 'Login';
        // $this->view('templates/head', $data);
        // $this->view('templates/headerfront');
        // $this->view('templates/login');
        // $this->view('templates/footer');
        // $this->view('templates/foot');
    }

    public function loggedin()
    {
        if ($this->model('Login_model')->login($_POST)) {
            header('Location: ' . BASEURL);
            exit;
        } else {
            Flasher::setFlash('Failed', 'The username or password you entered is wrong', 'danger');
            header('Location: ' . BASEURL . 'admin/falselogin');
            exit;
        }
    }
}