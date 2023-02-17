<?php
class Dashboardupbu extends Controller
{

    public function index()
    {
        $data['halaman'] = 'dashboard';

        $data['nama'] = $_SESSION['name'];
        $data['transmonth'] = $this->model('Transaction_model')->getTransactionMonthUpTenan();
        $data['transday'] = $this->model('Transaction_model')->getTransactionDayUpTenan();
        $data['totaltenan'] = $this->model('Tenan_model')->getTotalTenan();
        $data['totalakuntenan'] = $this->model('Acounts_model')->getTotalAkunTenan();

        $this->view('templates/head', $data);
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('adminupbu/dashboard', $data);
        $this->view('templates/foot');
        $this->view('templates/footer');
    }


    ######## KUMPULAN FUNGSI TENAN ########################################################################


    public function akuntenan()
    {
        $data['halaman'] = 'akuntenan';
        //
        $data['nama'] = $_SESSION['name'];

        $data['akuntenan'] = $this->model('Acounts_model')->getAcountTenanAll();
        $data['tenan'] = $this->model('Tenan_model')->getTenanNotAkunAll();
        $data['tenanAkun'] = $this->model('Tenan_model')->getTenanWithAkunAll();

        $this->view('templates/head', $data);
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);

        $this->view('adminupbu/akuntenan', $data);

        $this->view('templates/foot');
        $this->view('templates/footer');
    }
    public function createAkunTenan()
    {
        $tambah = $this->model('Acounts_model')->tambahAkunTenan($_POST);
        if ($tambah == 'double') {
            Flasher::setFlash('gagal', 'ditambahkan. username sudah ada', 'danger');
            header('Location: ' . BASEURL . 'Dashboardupbu/akuntenan');
            exit;
        } elseif ($tambah > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . 'Dashboardupbu/akuntenan');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . 'Dashboardupbu/akuntenan');
            exit;
        }
    }
    public function updateAkunTenan($id)
    {
        if ($this->model('Acounts_model')->ubahDataAkunTenan($_POST, $id) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . 'Dashboardupbu/akuntenan');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . 'Dashboardupbu/akuntenan');
            exit;
        }
    }


    // menampilkan halaman tenan
    public function tenan()
    {
        $data['halaman'] = 'tenan';

        $data['nama'] = $_SESSION['name'];
        $data['tenan'] = $this->model('Tenan_model')->getTenanAll();

        $this->view('templates/head', $data);
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('adminupbu/tenan', $data);
        $this->view('templates/foot');
        $this->view('templates/footer');
    }

    public function produktenan($tenanId)
    {
        $data['halaman'] = 'tenan';

        $data['nama'] = $_SESSION['name'];
        $data['produktenan'] = $this->model('Product_model')->getProductByTenan($tenanId);
        $data['tenan'] = $this->model('Tenan_model')->getTenanById($tenanId);

        $this->view('templates/head', $data);
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('adminupbu/produktenan', $data);
        $this->view('templates/foot');
        $this->view('templates/footer');
    }
    public function stockinout($tenanId)
    {
        $data['halaman'] = 'tenan';

        $data['nama'] = $_SESSION['name'];
        $data['stockinout'] = $this->model('StockTransaction_model')->getStockInOutByTenanAndTime($tenanId, $_POST);
        $data['tenan'] = $this->model('Tenan_model')->getTenanById($tenanId);

        $this->view('templates/head', $data);
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('adminupbu/stockinout', $data);
        $this->view('templates/foot');
        $this->view('templates/footer');
    }
    public function stockinoutproduk($tenanId, $produkId)
    {
        $data['halaman'] = 'tenan';

        $data['nama'] = $_SESSION['name'];
        $data['stockinout'] = $this->model('StockTransaction_model')->getStockInOutByTenanByProdukAndTime($tenanId, $produkId, $_POST);
        $data['tenan'] = $this->model('Tenan_model')->getTenanById($tenanId);
        $data['produk'] = $this->model('Product_model')->getProductOnlyById($produkId);

        $this->view('templates/head', $data);
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('adminupbu/stockinoutproduk', $data);
        $this->view('templates/foot');
        $this->view('templates/footer');
    }

    public function arsipkontrak($id)
    {
        $data['halaman'] = 'tenan';

        $data['nama'] = $_SESSION['name'];
        $data['arsip'] = $this->model('Tenan_model')->getArsipKontrak($id);
        $data['tenan'] = $this->model('Tenan_model')->getTenanById($id);

        $this->view('templates/head', $data);
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('adminupbu/arsipkontrak', $data);
        $this->view('templates/foot');
        $this->view('templates/footer');
    }
    // menambah tenan baru
    public function createTenan()
    {
        if ($this->model('Tenan_model')->tambahTenan($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . 'Dashboardupbu/tenan');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . 'Dashboardupbu/tenan');
            exit;
        }
    }
    // memperbarui data tenan
    public function update($id)
    {
        if ($this->model('Tenan_model')->ubahDataTenan($_POST, $id) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . 'Dashboardupbu/tenan');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . 'Dashboardupbu/tenan');
            exit;
        }
    }
    // tambah file kontrak tenan
    public function addfilecontract($id)
    {

        $filecontract = md5('contract' . $_FILES['file_contract']['name'] . date("Y-m-d H:i:s"));
        $uploadcontract = Bunlib::UploadFileTo('file_contract', 'file/contract/', $filecontract, ['pdf'], '2024070', $id);
        if ($uploadcontract == 'empty') {
            Flasher::setFlash('Gagal.', 'File Contract kosong', 'danger');
            header('Location: ' . BASEURL . 'Dashboardupbu/tenan');
            exit;
        } elseif ($uploadcontract == 'ext') {
            Flasher::setFlash('Gagal.', 'Ekstensi File Contract bukan Pdf', 'danger');
            header('Location: ' . BASEURL . 'Dashboardupbu/tenan');
            exit;
        } elseif ($uploadcontract == 'oversize') {
            Flasher::setFlash('Gagal.', 'File Tagihan Contract Lebih Dari 2 MB', 'danger');
            header('Location: ' . BASEURL . 'Dashboardupbu/tenan');
            exit;
        } else {
            copy('indexcopy/index.php', 'file/contract/' . $id . '/index.php');
            if ($this->model('Tenan_model')->insertFileContract($uploadcontract, $id) > 0) {
                Flasher::setFlash('berhasil', 'ditambahkan', 'success');
                header('Location: ' . BASEURL . 'Dashboardupbu/tenan');
                exit;
            } else {
                Flasher::setFlash('gagal', 'ditambahkan', 'danger');
                header('Location: ' . BASEURL . 'Dashboardupbu/tenan');
                exit;
            }
        }
    }
    public function ubahfilecontract($id, $contractid, $fileold)
    {
        $this->model('Tenan_model')->deloldcontrat($id, $fileold);

        $filecontract = md5('contract' . $_FILES['file_contract']['name'] . date("Y-m-d H:i:s"));
        $uploadcontract = Bunlib::UploadFileTo('file_contract', 'file/contract/', $filecontract, ['pdf'], '2024070', $id);
        if ($uploadcontract == 'empty') {
            Flasher::setFlash('Gagal.', 'File Contract kosong', 'danger');
            header('Location: ' . BASEURL . 'Dashboardupbu/tenan');
            exit;
        } elseif ($uploadcontract == 'ext') {
            Flasher::setFlash('Gagal.', 'Ekstensi File Contract bukan Pdf', 'danger');
            header('Location: ' . BASEURL . 'Dashboardupbu/tenan');
            exit;
        } elseif ($uploadcontract == 'oversize') {
            Flasher::setFlash('Gagal.', 'File Tagihan Contract Lebih Dari 2 MB', 'danger');
            header('Location: ' . BASEURL . 'Dashboardupbu/tenan');
            exit;
        } else {
            copy('indexcopy/index.php', 'file/contract/' . $id . '/index.php');
            if ($this->model('Tenan_model')->updateFileContract($uploadcontract, $contractid) > 0) {
                Flasher::setFlash('berhasil', 'ditambahkan', 'success');
                header('Location: ' . BASEURL . 'Dashboardupbu/tenan');
                exit;
            } else {
                Flasher::setFlash('gagal', 'ditambahkan', 'danger');
                header('Location: ' . BASEURL . 'Dashboardupbu/tenan');
                exit;
            }
        }
    }
    // menghapus data tenan
    public function deltenan($id)
    {
        if ($this->model('Tenan_model')->hapusDataTenan($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');

            header('Location: ' . BASEURL . 'Dashboardupbu/tenan');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . 'Dashboardupbu/tenan');
            exit;
        }
    }







    // Cek Pendapatan Harian Tenan
    public function cekHarianTenan($id)
    {
        $data['halaman'] = 'tenan';
        $data['transaksiharian'] = $this->model('Tenan_model')->cekHarianTenanDetail($_POST, $id);

        if ($data['transaksiharian']) {
            $this->view('templates/head', $data);
            $this->view('templates/header', $data);
            $this->view('templates/sidebar', $data);
            $this->view('adminupbu/cekHarianTenan', $data);
            $this->view('templates/foot');
            $this->view('templates/footer');
        } else {
            Flasher::setFlash('Kosong!!!', 'Data Harian <strong>  ' . $_POST['tenan'] . ' </strong> Pada Tanggal <strong>' . $_POST['tgl'] . '</strong> Tidak Ada', 'warning');
            header('Location: ' . BASEURL . 'Dashboardupbu/tenan');
            exit;
        }
    }
    // Cek Pendapatan Bulanan Tenan
    public function cekBulananTenan($id)
    {
        $data['halaman'] = 'tenan';

        if (isset($_POST['bulan'])) {
            $data['transaksibulanan'] = $this->model('Tenan_model')->cekBulananDetail($_POST, $id);
            if ($data['transaksibulanan']) {

                if (isset($_POST['submit']) && $_POST['submit'] == 'cetak') {
                    $data['transaksibulananTotal'] = $this->model('Tenan_model')->cekBulananTotal($_POST, $id);
                    $this->view('adminupbu/cetakpdfBulan', $data);
                } else {
                    $this->view('templates/head', $data);
                    $this->view('templates/header', $data);
                    $this->view('templates/sidebar', $data);
                    $this->view('adminupbu/cekBulananTenan', $data);
                    $this->view('templates/foot');
                    $this->view('templates/footer');
                }
            } else {
                Flasher::setFlash('Kosong!!!', 'Data Bulanan <strong>  ' . $_POST['tenan'] . ' </strong> Pada Bulan <strong>' . $_POST['bulan'] . '</strong> dan Tahun <strong>' . $_POST['tahun'] . '</strong> Tidak Ada', 'warning');
                header('Location: ' . BASEURL . 'Dashboardupbu/tenan');
                exit;
            }
        } else {
            Flasher::setFlash('Perhatian', 'buka pdf kembali', 'warning');
            header('Location: ' . BASEURL . 'Dashboardupbu/tenan');
            exit;
        }
    }

    // Cek Pendapatan Tahunan Tenan
    public function cekTahunanTenan($id)
    {
        $data['halaman'] = 'tenan';

        $data['transaksitahunan'] = $this->model('Tenan_model')->cekTahunanDetail($_POST, $id);


        if ($data['transaksitahunan']) {
            $this->view('templates/head', $data);
            $this->view('templates/header', $data);
            $this->view('templates/sidebar', $data);
            $this->view('adminupbu/cekTahunanTenan', $data);
            $this->view('templates/foot');
            $this->view('templates/footer');
        } else {
            Flasher::setFlash('Kosong!!!', 'Data Tahunan <strong>  ' . $_POST['tenan'] . ' </strong> Pada Tahun <strong>' . $_POST['tahun'] . '</strong> Tidak Ada', 'warning');
            header('Location: ' . BASEURL . 'Dashboardupbu/tenan');
            exit;
        }
    }





    ######## KUMPULAN FUNGSI BILLLING ########################################################################
    public function konfirmasiBuktiPembayaran($id)
    {
        if ($this->model('Billing_model')->konfirmasiBilingSuccess($id) > 0) {
            Flasher::setFlash('berhasil', 'dikonfirmasi', 'success');
            header('Location: ' . BASEURL . 'Dashboardupbu/billingtenan');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dikonfirmasi', 'danger');
            header('Location: ' . BASEURL . 'Dashboardupbu/billingtenan');
            exit;
        }
    }

    public function batalkonfirmasiBuktiPembayaran($id)
    {
        if ($this->model('Billing_model')->batalkonfirmasiBilingSuccess($id) > 0) {
            Flasher::setFlash('berhasil', 'membatalkan konfirmasi', 'success');
            header('Location: ' . BASEURL . 'Dashboardupbu/billingtenan');
            exit;
        } else {
            Flasher::setFlash('gagal', 'membatalkan konfirmasi', 'danger');
            header('Location: ' . BASEURL . 'Dashboardupbu/billingtenan');
            exit;
        }
    }

    public function hapusBilling($id)
    {
        $this->model('Billing_model')->delBill($id);

        if ($this->model('Billing_model')->delBilling($id) > 0) {
            Flasher::setFlash('berhasil', 'menghapus billing', 'success');
            header('Location: ' . BASEURL . 'Dashboardupbu/billingtenan');
            exit;
        } else {
            Flasher::setFlash('gagal', 'menghapus billing', 'danger');
            header('Location: ' . BASEURL . 'Dashboardupbu/billingtenan');
            exit;
        }
    }

    public function billingtenan()
    {
        $data['halaman'] = 'billingtenan';

        $data['nama'] = $_SESSION['name'];

        $data['billing'] = $this->model('Billing_model')->getBillingAllTenan();
        $data['tenan'] = $this->model('Tenan_model')->getTenanFilterByAcount();
        $this->view('templates/head', $data);
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        // $this->view('templates/maintenance', $data);
        $this->view('adminupbu/billingtenan', $data);
        $this->view('templates/foot');
        $this->view('templates/footer');
    }

    // Tambah Billing baru 
    public function tambahBilling()
    {

        $filekonsesi = md5('konsesi' . $_FILES['file_konsesi']['name'] . date("Y-m-d H:i:s"));
        $filesewatempat = md5('lapak' . $_FILES['file_sewatempat']['name'] . date("Y-m-d H:i:s"));
        $filelistrik = md5('listrik' . $_FILES['file_listrik']['name'] . date("Y-m-d H:i:s"));

        $uploadkonsesi = Bunlib::UploadFileTo('file_konsesi', 'file/billing/', $filekonsesi, ['pdf'], '2024070', $_POST['tenan_id']);
        if ($uploadkonsesi == 'empty') {
            Flasher::setFlash('Gagal.', 'File Konsesi kosong', 'danger');
            header('Location: ' . BASEURL . 'Dashboardupbu/billingtenan');
            exit;
        } elseif ($uploadkonsesi == 'ext') {
            Flasher::setFlash('Gagal.', 'Ekstensi File Konsesi bukan Pdf', 'danger');
            header('Location: ' . BASEURL . 'Dashboardupbu/billingtenan');
            exit;
        } elseif ($uploadkonsesi == 'oversize') {
            Flasher::setFlash('Gagal.', 'File Tagihan Konsesi Lebih Dari 2 MB', 'danger');
            header('Location: ' . BASEURL . 'Dashboardupbu/billingtenan');
            exit;
        } else {

            $uploadsewatempat = Bunlib::UploadFileTo('file_sewatempat', 'file/billing/', $filesewatempat, ['pdf'], '2024070', $_POST['tenan_id']);
            if ($uploadsewatempat == 'empty') {
                Flasher::setFlash('Gagal.', 'File Tagihan Sewa Tempat kosong', 'danger');
                header('Location: ' . BASEURL . 'Dashboardupbu/billingtenan');
                exit;
            } elseif ($uploadsewatempat == 'ext') {
                Flasher::setFlash('Gagal.', 'Ekstensi File Sewa Tempat bukan Pdf', 'danger');
                header('Location: ' . BASEURL . 'Dashboardupbu/billingtenan');
                exit;
            } elseif ($uploadsewatempat == 'oversize') {
                Flasher::setFlash('Gagal.', 'File Tagihan Sewa Tempat Lebih Dari 2 MB', 'danger');
                header('Location: ' . BASEURL . 'Dashboardupbu/billingtenan');
                exit;
            } else {

                $uploadlistrik = Bunlib::UploadFileTo('file_listrik', 'file/billing/', $filelistrik, ['pdf'], '2024070', $_POST['tenan_id']);
                if ($uploadlistrik == 'empty') {
                    Flasher::setFlash('Gagal.', 'File Tagihan Listrik', 'danger');
                    header('Location: ' . BASEURL . 'Dashboardupbu/billingtenan');
                    exit;
                } elseif ($uploadlistrik == 'ext') {
                    Flasher::setFlash('Gagal.', 'Ekstensi File Listrik Pdf', 'danger');
                    header('Location: ' . BASEURL . 'Dashboardupbu/billingtenan');
                    exit;
                } elseif ($uploadlistrik == 'oversize') {
                    Flasher::setFlash('Gagal.', 'File Tagihan Listrik Lebih Dari 2 MB', 'danger');
                    header('Location: ' . BASEURL . 'Dashboardupbu/billingtenan');
                    exit;
                } else {

                    copy('indexcopy/index.php', 'file/billing/' . $_POST['tenan_id'] . '/index.php');

                    if ($this->model('Billing_model')->uploadBillingAdmin($_POST, $uploadkonsesi, $uploadsewatempat, $uploadlistrik) > 0) {

                        Flasher::setFlash('berhasil', 'ditambahkan', 'success');
                        header('Location: ' . BASEURL . 'Dashboardupbu/billingtenan');
                        exit;
                    }
                }
            }
        }
    }

    public function keluarkanBilling($tenan_id, $id)
    {
        $filebilling = md5('billing' . $_FILES['file_billing']['name'] . date("Y-m-d H:i:s"));

        $uploadbillling = Bunlib::UploadFileTo('file_billing', 'file/billing/', $filebilling, ['pdf'], '2024070', $tenan_id);
        if ($uploadbillling == 'empty') {
            Flasher::setFlash('Gagal.', 'File Billing kosong', 'danger');
            header('Location: ' . BASEURL . 'Dashboardupbu/billingtenan');
            exit;
        } elseif ($uploadbillling == 'ext') {
            Flasher::setFlash('Gagal.', 'Ekstensi File Billing bukan Pdf', 'danger');
            header('Location: ' . BASEURL . 'Dashboardupbu/billingtenan');
            exit;
        } elseif ($uploadbillling == 'oversize') {
            Flasher::setFlash('Gagal.', 'File Tagihan Billing Lebih Dari 2 MB', 'danger');
            header('Location: ' . BASEURL . 'Dashboardupbu/billingtenan');
            exit;
        } else {
            copy('indexcopy/index.php', 'file/billing/' . $tenan_id . '/index.php');
            if ($this->model('Billing_model')->uploadBillingAdminaTen($uploadbillling, $id) > 0) {
                Flasher::setFlash('berhasil', 'ditambahkan', 'success');
                header('Location: ' . BASEURL . 'Dashboardupbu/billingtenan');
                exit;
            }
        }
    }

    public function perbaruibilling($tenan_id, $id)
    {
        $this->model('Billing_model')->delbillonly($id);
        $this->keluarkanBilling($tenan_id, $id);
    }




    ######## KUMPULAN FUNGSI PROFIL ########################################################################
    public function profil()
    {
        $data['halaman'] = 'profil';

        $data['nama'] = $_SESSION['name'];

        $data['akun'] = $this->model('Profil_model')->getProfil();

        $this->view('templates/head', $data);
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('adminupbu/profil', $data);

        $this->view('templates/foot');
        $this->view('templates/footer');
    }


    // Update Profil
    public function updateProfil($id)
    {
        if ($this->model('Profil_model')->ubahDataProfil($_POST, $id) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . 'Dashboardupbu/profil');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . 'Dashboardupbu/profil');
            exit;
        }
    }


    public function getItamTransac($id)
    {
        $data = $this->model('Item_model')->getItemAllByTransaction($id);
        echo json_encode($data, JSON_NUMERIC_CHECK);
    }
    // cetak transaksi detail
    public function cetaktransDetail($idtrans)
    {
        $data['halaman'] = 'tenan';
        $data['itemtrans'] = $this->model('Item_model')->getItemAllByTransaction($idtrans);
        $data['trans'] = $this->model('Transaction_model')->getTransactionByIdOnly($idtrans);
        $this->view('adminupbu/cetakPdfTransDetail', $data);
    }
}
