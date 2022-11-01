<?php
class Profil extends Controller
{

    public function index()
    {

        $data['judul'] = 'profil';
        $data['gambar'] = 'img/img';
        $data['nama'] = $_SESSION['name'];

        $this->view('templates/head', $data);
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        // $data['profile'] = $this->model('Profil_model')->getProfAdmin($_SESSION['admin_id']);
        $this->view('profil/admin', $data);

        $this->view('templates/foot');
    }
    public function getubahAdmin()
    {
        echo json_encode($this->model('Profil_model')->getProfilAdmin($_POST['id']));
    }
    public function getubah()
    {
        echo json_encode($this->model('Profil_model')->getProfil($_POST['id']));
    }

    public function ubahAdmin($id)
    {
        if ($this->model('Profil_model')->ubahDataProfilAdmin($_POST, $id) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . 'profil/admin');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . 'profil/admin');
            exit;
        }
    }


    public function ubah($id)
    {

        if ($this->model('Profil_model')->ubahDataProfilAdmin($_POST, $id) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . 'profil');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . 'profil');
            exit;
        }
    }
}
