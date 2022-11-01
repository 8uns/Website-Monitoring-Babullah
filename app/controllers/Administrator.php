<?php
class Administrator extends Controller
{
    public function index()
    {
        $data['judul'] = 'Administrator';
        $data['gambar'] = 'img/img';
        $data['nama'] = $_SESSION['name'];
        $data['members'] = $this->model('Administrator_model')->getAllAdmin();
        $this->view('templates/head', $data);
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('administrator/index', $data);
        // $this->view('templates/footer');
        $this->view('templates/foot');
    }
    public function tambah()
    {
        if ($this->model('Administrator_model')->tambahDataAdministrator($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');

            header('Location: ' . BASEURL . 'administrator');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . 'administrator');
            exit;
        }
    }

    public function getubah()
    {
        echo json_encode($this->model('Administrator_model')->getAdministratorById($_POST['id']));
    }

    public function ubah($id)
    {
        if ($this->model('Administrator_model')->ubahDataAdministrator($_POST, $id) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . 'administrator');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . 'administrator');
            exit;
        }
    }

    public function hapus($id){
        if($this->model('Administrator_model')->hapusDataAdministrator($id) > 0){
            Flasher::setFlash('berhasil', 'dihapus','success');

            header('Location: '.BASEURL.'administrator');
            exit;
        }else{
            Flasher::setFlash('gagal', 'dihapus','danger');
            header('Location: '.BASEURL.'administrator');
            exit;
        }
    }
}
