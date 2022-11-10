<?php
class Api extends Controller
{
    private function cekToken($token)
    {
        $data = $this->model('Acounts_model')->cekToken($token);
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    public function login()
    {
        $ceklogin = $this->model('Login_model')->loginApi($_POST['username'], $_POST['password']);
        if ($ceklogin) {
            $data = [
                "condition" => true,
                "data" => $ceklogin,
            ];
            header('Content-Type: application/json');
            echo json_encode($data, JSON_NUMERIC_CHECK);
        } else {
            $data = [
                "condition" => false,
                "data" => false,
            ];
            header('Content-Type: application/json');
            echo json_encode($data, JSON_NUMERIC_CHECK);
        }
    }

    public function index($token = false)
    {
        if ($this->cekToken($token)) {
            $data['halaman'] = 'apiupbu';

            $this->view('templates/head', $data);

            echo " 
                <ul>
                <li>
                <a href=" . BASEURL . "api/produk/" . $token . ">produk</a>
                </li>

                <li>
                <a href=" . BASEURL . "api/inventaris/" . $token . ">inventaris</a>
                </li>
                

                <li>
                <a href=" . BASEURL . "api/transaksi/" . $token . ">transaksi</a>
                </li>
                

                <li>
                <a href=" . BASEURL . "api/item/" . $token . ">item</a>
                </li>

                 <li>
                <a href=" . BASEURL . "api/billing/" . $token . ">billing</a>
                </li>

                 <li>
                <a href=" . BASEURL . "api/pendapatan/" . $token . ">pendapatan</a>
                </li>

                
                </ul>
        ";
        } else {
            header("location:" . BASEURL . "apierror");
            exit;
        }
    }



    ############### PRODUK ################################################################### 
    public function produk($token = false, $id = null)
    {
        $cektok = $this->cekToken($token);
        if ($cektok) {

            if ($_SERVER['REQUEST_METHOD'] == 'GET') {

                if ($id == null) {
                    $data = $this->model('Product_model')->getProductAll($cektok['acount_id']);
                } else {
                    $data = $this->model('Product_model')->getProductById($cektok['acount_id'], $id);
                }
            } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {

                if ($id == null) {
                    if ($_POST['picture'] == "") {
                        $data = $this->model('Product_model')->createProduct($_POST);
                        if (!$data) {
                            header("location:" . BASEURL . "apierror");
                            exit;
                        } else {
                            if ($_POST['quantity'] > 0) {
                                $data = $this->model('Product_model')->getNewProductByTenan($_POST['tenan_id']);
                                if ($data) {
                                    $data = $this->model('StockTransaction_model')->insertStockProduct($_POST, $data['product_id']);
                                }
                            }
                        }
                    } else {
                        // if (Bunlib::uploadImgBase64($_POST['picture_name'], 'img/produk/', $_POST['picture'], $_POST['tenan_id'])) {
                        // copy('indexcopy/index.php', 'img/produk/' . $_POST['tenan_id'] . '/index.php');
                        $data = $this->model('Product_model')->createProduct($_POST, $_POST['picture']);
                        if (!$data) {
                            header("location:" . BASEURL . "apierror");
                            exit;
                        } else {
                            if ($_POST['quantity'] > 0) {
                                $data = $this->model('Product_model')->getNewProductByTenan($_POST['tenan_id']);
                                if ($data) {
                                    $data = $this->model('StockTransaction_model')->insertStockProduct($_POST, $data['product_id']);
                                }
                            }
                        }
                        // } else {
                        //     $data = $this->model('Product_model')->createProduct($_POST);
                        //     if (!$data) {
                        //         header("location:" . BASEURL . "apierror");
                        //         exit;
                        //     } else {
                        //         if ($_POST['quantity'] > 0) {
                        //             $data = $this->model('Product_model')->getNewProductByTenan($_POST['tenan_id']);
                        //             if ($data) {
                        //                 $data = $this->model('StockTransaction_model')->insertStockProduct($_POST, $data['product_id']);
                        //             }
                        //         }
                        //     }
                        // }
                    }
                } else {
                    $data = $this->model('Product_model')->updateProduct($_POST, $id);
                }
            } elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
                $this->model('Product_model')->delPict($id);

                $data = $this->model('Product_model')->delProduct($id);
            }

            header('Content-Type: application/json');
            $data = [
                "data" => $data,
            ];

            // $data['data'] = json_encode($data, JSON_NUMERIC_CHECK);
            echo json_encode($data, JSON_NUMERIC_CHECK);
        } else {
            header("location:" . BASEURL . "apierror");
            exit;
        }
    }


    ############### TRANSACTION ################################################################### 
    public function transaksi($token = false, $id = null, $id2 = null)
    {
        $cektok = $this->cekToken($token);
        $idd = 1;
        if ($cektok) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                if ($id == 'bayar') {
                    $data = $this->model('Transaction_model')->updateTransaksiStatus($id2);
                    if ($data) {
                        $data = $this->model('StockTransaction_model')->updateStockTransaksiStatus($id2);
                        if ($data) {
                            $data = $this->model('Product_model')->getProductByTransactionId($id2);
                            foreach ($data as $qty) {
                                $data = $this->model('Product_model')->updateMinQtyProduct($qty['qtytrans'], $qty['product_id']);
                            }
                        }
                    }
                } elseif ($id == 'status') {
                    $data = $this->model('Transaction_model')->getTransactionStatus($cektok['acount_id']);
                    if (!$data) {
                        $idd = 0;
                        $data = [];
                    }
                } elseif ($id == null) {
                    $data = $this->model('Transaction_model')->getTransactionAll($cektok['acount_id']);
                } else {
                    $data = $this->model('Transaction_model')->getTransactionById($cektok['acount_id'], $id);
                }
            } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($id == 'cancel') {
                    $data = $this->model('Transaction_model')->updateCancelTransaction($id2);
                }
                if (isset($_POST['date'])) {
                    if ($_POST['date'] == '') {
                        $data = $this->model('Transaction_model')->getTransactionAll($cektok['acount_id']);
                    } else {
                        $data = $this->model('Transaction_model')->getTransactionAllByDate($cektok['acount_id'], $_POST['date']);
                    }
                }
                // else {
                //     $data = $this->model('Transaction_model')->createTransaction($_POST);
                // }
            } elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
                $data = $this->model('Transaction_model')->delTransaction($id);
            }

            header('Content-Type: application/json');
            $data = [
                "id" => $idd,
                "data" => $data,
            ];

            // $data['data'] = json_encode($data, JSON_NUMERIC_CHECK);
            echo json_encode($data, JSON_NUMERIC_CHECK);
        } else {
            header("location:" . BASEURL . "apierror");
            exit;
        }
    }


    ############### ITEM TRANSACTION ################################################################### 
    public function item($token = false, $id1 = null, $id2 = null)
    {
        $idd = 1;

        $cektok = $this->cekToken($token);
        if ($cektok) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                if ($id1 == 'aktif') {
                    $data = $this->model('Item_model')->getItemAllAktif($cektok['acount_id']);
                } elseif ($id1 == null) {
                    $idd = 0;
                    $data = [];
                } elseif ($id2 == null) {
                    $data = $this->model('Item_model')->getItemAll($cektok['acount_id'], $id1);
                } else {
                    $data = $this->model('Item_model')->getItemById($id2);
                }
            } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $data = $this->model('Item_model')->createItem($_POST, $id1);
                if (!$data) {
                    header("location:" . BASEURL . "apierror");
                    exit;
                }
            }
            //  elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            //     $data = $this->model('Item_model')->delItem($id);
            // }

            header('Content-Type: application/json');
            $data = [
                "id" => $idd,
                "data" => $data,
            ];

            // $data['data'] = json_encode($data, JSON_NUMERIC_CHECK);
            echo json_encode($data, JSON_NUMERIC_CHECK);
        } else {
            header("location:" . BASEURL . "apierror");
            exit;
        }
    }


    ############### BILLING ################################################################### 
    public function billing($token = false, $id = null, $id2 = null)
    {
        $idd = 1;
        $cektok = $this->cekToken($token);
        if ($cektok) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                if ($id == null) {
                    $data = $this->model('Billing_model')->getBillingAll($cektok['acount_id']);
                } elseif ($id == 'tahun') {
                    $data = $this->model('Billing_model')->getBillingAll($cektok['acount_id'], $id2);
                } elseif ($id == 'notif') {
                    $data = $this->model('Billing_model')->getBillingNotVal($cektok['acount_id']);
                    if (!$data) {
                        $idd = 0;
                        $data = [];
                    }
                } else {
                    $data = $this->model('Billing_model')->getBillingId($cektok['acount_id'], $id);
                }
            } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($id != null) {
                    if ($_POST['filepaymantName'] != '') {
                        $this->model('Billing_model')->delpaymant($id, $_POST['filetipe']);

                        if (Bunlib::uploadImgBase64($_POST['filepaymantName'], 'file/payment/', $_POST['filepaymant'], $_POST['tenan_id'])) {
                            copy('indexcopy/index.php', 'file/payment/' . $_POST['tenan_id'] . '/index.php');

                            $data = $this->model('Billing_model')->uploadPaymant($_POST['filepaymantName'], $id, $_POST['filetipe']);
                        } else {
                            header("location:" . BASEURL . "apierror");
                            exit;
                        }
                    } else {
                        header("location:" . BASEURL . "apierror");
                        exit;
                    }
                } else {
                    header("location:" . BASEURL . "apierror");
                    exit;
                }
            }
            //  elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            //     $data = $this->model('Item_model')->delItem($id);
            // }

            header('Content-Type: application/json');
            $data = [
                "id" => $idd,
                "data" => $data,
            ];

            echo json_encode($data, JSON_NUMERIC_CHECK);
        } else {
            header("location:" . BASEURL . "apierror");
            exit;
        }
    }

    public function inventaris($token = false, $id = null)
    {
        $idd = 1;
        $cektok = $this->cekToken($token);
        if ($cektok) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                if ($id == null) {
                    $data = $this->model('StockTransaction_model')->getInventoryAll($cektok['acount_id'], 'masuk');
                } else {
                    $data = $this->model('StockTransaction_model')->getInventoryById($cektok['acount_id'], $id);
                }
            } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['date'])) {
                    if ($_POST['date'] == '') {
                        $data = $this->model('StockTransaction_model')->getInventoryAll($cektok['acount_id'], $_POST['in_out']);
                    } else {
                        $data = $this->model('StockTransaction_model')->getInventoryAllByDate($cektok['acount_id'], $_POST['date'], $_POST['in_out']);
                    }
                } else {
                    $data = $this->model('StockTransaction_model')->insertStockProduct($_POST, $id);
                    if ($data) {
                        $data = $this->model('Product_model')->updatePlusQtyProduct($_POST['quantity'], $id);
                    }
                }
            }

            header('Content-Type: application/json');
            $data = [
                "id" => $idd,
                "data" => $data,
            ];
            echo json_encode($data, JSON_NUMERIC_CHECK);
        } else {
            header("location:" . BASEURL . "apierror");
            exit;
        }
    }


    public function pendapatan($token = false, $id = null, $id2 = null)
    {
        $idd = 1;
        $cektok = $this->cekToken($token);
        if ($cektok) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                // if ($id == null) {
                //     $data = $this->model('StockTransaction_model')->getInventoryAll($cektok['acount_id'], 'masuk');
                // } else {
                //     $data = $this->model('StockTransaction_model')->getInventoryById($cektok['acount_id'], $id);
                // }
            } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($id == 'bulanan') {
                    if ($id2 == 'total') {
                        if ($_POST['bulan'] != '' && $_POST['tahun'] != '') {
                            $data = $this->model('Tenan_model')->cekBulananTotal($_POST, $_POST['tenan_id']);
                        } else {
                            $data = $this->model('Tenan_model')->cekBulananTotalTerbaru($_POST['tenan_id']);
                        }
                    } else {
                        if ($_POST['bulan'] != '' && $_POST['tahun'] != '') {
                            $data = $this->model('Tenan_model')->cekBulananDetail($_POST, $_POST['tenan_id']);
                        } else {
                            $data = $this->model('Tenan_model')->cekBulananDetailTerbaru($_POST['tenan_id']);
                        }
                    }
                } elseif ($id == 'harian') {
                    if ($id2 == 'total') {
                        if ($_POST['tgl'] != '') {
                            $data = $this->model('Tenan_model')->cekHarianTenanTotal($_POST, $_POST['tenan_id']);
                        } else {
                            $data = $this->model('Tenan_model')->cekHarianTenanTotalTerbaru($_POST['tenan_id']);
                        }
                    } else {
                        if ($_POST['tgl'] != '') {
                            $data = $this->model('Tenan_model')->cekHarianTenanDetail($_POST, $_POST['tenan_id']);
                        } else {
                            $data = $this->model('Tenan_model')->cekHarianTenanDetailTerbaru($_POST['tenan_id']);
                        }
                    }
                }
            }

            header('Content-Type: application/json');
            $data = [
                "id" => $idd,
                "data" => $data,
            ];
            echo json_encode($data, JSON_NUMERIC_CHECK);
        } else {
            header("location:" . BASEURL . "apierror");
            exit;
        }
    }
}
