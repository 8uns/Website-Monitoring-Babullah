<?php
class Logout extends Controller
{

    public function logout()
    {
        if ($_SESSION['level'] == 5) {
            session_destroy();
            header('Location: ' . BASEURL . 'login');
            exit;
        } else {
            session_destroy();
            header('Location: ' . BASEURL . 'admin');
            exit;
        }
    }
}
