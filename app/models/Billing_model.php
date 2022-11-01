<?php

class Billing_model
{
  // jangan dirubah
  private $db;
  public function __construct()
  {
    $this->db = new Database;
  }
  // stop 

  public function delBill($id)
  {
    $this->db->query("SELECT file_konsesi, file_sewatempat,  file_listrik, file_billing, tenan_id
        FROM `billings`  
        JOIN tenan USING(tenan_id)  
        WHERE billing_id=$id");

    $data = $this->db->single();

    // $this->db->close();
    if ($data && $data['file_konsesi'] != '') {
      if (file_exists('file/billing/' . $data['tenan_id'] . '/' .   $data['file_konsesi'])) {

        unlink('file/billing/' . $data['tenan_id'] . '/' .   $data['file_konsesi']);
      }
    }

    if ($data && $data['file_sewatempat'] != '') {
      if (file_exists('file/billing/' . $data['tenan_id'] . '/' .   $data['file_sewatempat'])) {

        unlink('file/billing/' . $data['tenan_id'] . '/' .   $data['file_sewatempat']);
      }
    }

    if ($data && $data['file_listrik'] != '') {
      if (file_exists('file/billing/' . $data['tenan_id'] . '/' .   $data['file_listrik'])) {

        unlink('file/billing/' . $data['tenan_id'] . '/' .   $data['file_listrik']);
      }
    }

    if ($data && $data['file_billing'] != '') {
      if (file_exists('file/billing/' . $data['tenan_id'] . '/' .   $data['file_billing'])) {

        unlink('file/billing/' . $data['tenan_id'] . '/' .   $data['file_billing']);
      }
    }

    return true;
  }
  public function delbillonly($id)
  {
    $this->db->query("SELECT file_konsesi, file_sewatempat,  file_listrik, file_billing, tenan_id
        FROM `billings`  
        JOIN tenan USING(tenan_id)  
        WHERE billing_id=$id");

    $data = $this->db->single();


    if ($data && $data['file_billing'] != '') {
      if (file_exists('file/billing/' . $data['tenan_id'] . '/' .   $data['file_billing'])) {

        unlink('file/billing/' . $data['tenan_id'] . '/' .   $data['file_billing']);
      }
    }

    return true;
  }

  public function konfirmasiBilingSuccess($id)
  {
    // $this->delPict($id);

    $query = "UPDATE `billings`  
                    SET 
                    validation=1,
                    validationdate=ADDTIME(SYSDATE(), '9:00:0')

                    WHERE billing_id=:billing_id
                    ";
    $this->db->query($query);
    $this->db->bind('billing_id', $id);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function batalkonfirmasiBilingSuccess($id)
  {
    // $this->delPict($id);

    $query = "UPDATE `billings`  
                    SET 
                    validation=0,
                    validationdate='0000-00-00 00:00:00'

                    WHERE billing_id=:billing_id
                    ";
    $this->db->query($query);
    $this->db->bind('billing_id', $id);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function getBillingAllTenan()
  {
    $this->db->query("SELECT 
        billing_id,
        month,
        TIME(date_file_tagihan) time,
        YEAR(date_file_tagihan) year,
        total,
        date_file_tagihan,
        file_konsesi,
        file_sewatempat,
        file_listrik,
        file_billing,
        payment_konsesi,
        payment_sewatempat,
        payment_listrik,
        validation,
        validationdate,
        tenan_id,
		tenan.name nama
        FROM `billings` 
        JOIN `tenan` USING(tenan_id) 
        JOIN `acounts` USING(acount_id) 
        ORDER BY billing_id DESC");
    return $this->db->resultSet();
  }

  // tambah Billing
  public function uploadBillingAdmin($data, $konsesi, $tempat, $listrik)
  {
    $query = "INSERT INTO `billings` 
                    (month, file_sewatempat, file_konsesi, file_listrik, tenan_id, date_file_tagihan) 
                        VALUES
                        (:month, :file_sewatempat, :file_konsesi, :file_listrik, :tenan_id, ADDTIME(SYSDATE(), '9:00:0'))";
    $this->db->query($query);
    $this->db->bind('month', $data['bulan']);
    $this->db->bind('file_sewatempat', $tempat);
    $this->db->bind('file_konsesi', $konsesi);
    $this->db->bind('file_listrik', $listrik);
    $this->db->bind('tenan_id', $data['tenan_id']);

    $this->db->execute();
    return $this->db->rowCount();
  }

  public function uploadBillingAdminaTen($billing, $id)
  {
    $query = "UPDATE `billings` 
                SET
                    file_billing=:file_billing, 
                    date_billing=ADDTIME(SYSDATE(), '9:00:0')
                WHERE billing_id=:billing_id
                       ";
    $this->db->query($query);
    $this->db->bind('file_billing', $billing);
    $this->db->bind('billing_id', $id);

    $this->db->execute();
    return $this->db->rowCount();
  }



  public function getBillingAll($acount_id)
  {
    $this->db->query("SELECT 
        billing_id,
        month,
        TIME(date_file_tagihan) time,
        YEAR(date_file_tagihan) year,
        total,
        date_file_tagihan,
        file_konsesi,
        file_sewatempat,
        file_listrik,
        file_billing,
        payment_konsesi,
        payment_sewatempat,
        payment_listrik,
        validation,
        validationdate,
        tenan_id 
        FROM `billings` 
        JOIN `tenan` USING(tenan_id) 
        JOIN `acounts` USING(acount_id)
        WHERE acount_id=$acount_id 
        ORDER BY billing_id DESC");
    return $this->db->resultSet();
  }


  public function getBillingId($acount_id, $id)
  {
    $this->db->query("SELECT 
        billing_id,
        month,
        TIME(date_file_tagihan) time,
        YEAR(date_file_tagihan) year,
        total,
        date_file_tagihan,
        file_konsesi,
        file_sewatempat,
        file_listrik,
        file_billing,
        payment_konsesi,
        payment_sewatempat,
        payment_listrik,
        validation,
        validationdate,
        tenan_id  
        FROM `billings` 
        JOIN `tenan` USING(tenan_id) 
        JOIN `acounts` USING(acount_id)
        WHERE acount_id=$acount_id
        AND billing_id=$id");
    return $this->db->resultSet();
  }

  public function getBillingNotVal($acount_id)
  {
    $this->db->query("SELECT 
        billing_id,
        month,
        TIME(date_file_tagihan) time,
        YEAR(date_file_tagihan) year,
        total,
        date_file_tagihan,
        file_konsesi,
        file_sewatempat,
        file_listrik,
        file_billing,
        payment_konsesi,
        payment_sewatempat,
        payment_listrik,
        validation,
        validationdate,
        tenan_id  
        FROM `billings` 
        JOIN `tenan` USING(tenan_id) 
        JOIN `acounts` USING(acount_id)
        WHERE acount_id=$acount_id 
        AND validation=0");
    return $this->db->single();
  }



  // public function delPict($id)
  // {
  //   $this->db->query("SELECT 
  //       filepaymant 
  //       FROM `billings` ) 
  //       WHERE billing_id=$id");

  //   $data = $this->db->single();
  //   $this->db->close();

  //   if (isset($data['filepaymant'])) {
  //     unlink('img/paymant/' . $data['filepaymant']);
  //   }
  //   $this->db->close();
  // }

  public function delpaymant($id, $tipe)
  {
    $this->db->query("SELECT payment_konsesi, payment_sewatempat,  payment_listrik, tenan_id
        FROM `billings`  
        JOIN tenan USING(tenan_id)  
        WHERE billing_id=$id");

    $data = $this->db->single();

    // $this->db->close();
    if ($tipe == 'konsesi' && $data && $data['payment_konsesi'] != '') {
      if (file_exists('file/payment/' . $data['tenan_id'] . '/' .   $data['payment_konsesi'])) {

        unlink('file/payment/' . $data['tenan_id'] . '/' .   $data['payment_konsesi']);
      }
    }

    if ($tipe == 'lapak' && $data && $data['payment_sewatempat'] != '') {
      if (file_exists('file/payment/' . $data['tenan_id'] . '/' .   $data['payment_sewatempat'])) {

        unlink('file/payment/' . $data['tenan_id'] . '/' .   $data['payment_sewatempat']);
      }
    }

    if ($tipe == 'listrik' && $data && $data['payment_listrik'] != '') {
      if (file_exists('file/payment/' . $data['tenan_id'] . '/' .   $data['payment_listrik'])) {

        unlink('file/payment/' . $data['tenan_id'] . '/' .   $data['payment_listrik']);
      }
    }

    return true;
  }

  public function uploadPaymant($filepaymant, $id, $tipe)
  {
    // $this->delPict($id);
    if ($tipe == 'konsesi') {
      $query = "UPDATE `billings`  
                    SET 
                    payment_konsesi=:payment_konsesi
                    WHERE billing_id=:billing_id
                    ";
      $this->db->query($query);
      $this->db->bind('payment_konsesi', $filepaymant);
      $this->db->bind('billing_id', $id);
    } elseif ($tipe == 'listrik') {
      $query = "UPDATE `billings`  
                    SET 
                    payment_listrik=:payment_listrik
                    WHERE billing_id=:billing_id
                    ";
      $this->db->query($query);
      $this->db->bind('payment_listrik', $filepaymant);
      $this->db->bind('billing_id', $id);
    } elseif ($tipe == 'lapak') {
      $query = "UPDATE `billings`  
                    SET 
                    payment_sewatempat=:payment_sewatempat
                    WHERE billing_id=:billing_id
                    ";
      $this->db->query($query);
      $this->db->bind('payment_sewatempat', $filepaymant);
      $this->db->bind('billing_id', $id);
    }


    $this->db->execute();
    return $this->db->rowCount();
  }
  public function uploadBilling($data, $id)
  {

    $upload = Bunlib::UploadFileTo($_FILES['name'], 'path/direktori', 'namafilebaru', ['ext', 'pdf', 'png'], 'size');
    if ($upload == 'empty') {
      // jika file kosong di form 
      // query
    } elseif ($upload == 'ext') {
      // jika ekstension tidak sesuai pdf jpg
    } elseif ($upload == 'oversize') {
      // jika kelebihan ukran file
    } else {
      // query
    }
  }

  public function delBilling($id)
  {
    $query = "DELETE FROM `billings` WHERE billing_id=:billing_id";
    $this->db->query($query);
    $this->db->bind('billing_id', $id);
    $this->db->execute();
    return $this->db->rowCount();
  }
  // // 
  // public function createBilling($data, $namePicture = null)
  // {
  //   if ($namePicture == null) {
  //     $data['name'] = isset($data['name']) ?  $data['name'] : '';
  //     $data['price'] = isset($data['price']) ?  $data['price'] : '';
  //     $data['tenan_id'] = isset($data['tenan_id']) ?  $data['tenan_id'] : '';
  //     if ($data['name'] === '' && $data['price'] === '' && $data['picture'] === '' && $data['tenan_id'] === '') {
  //       return false;
  //       exit;
  //     }

  //     $query = "INSERT INTO `products` 
  //                   (name, price, tenan_id) 
  //                       VALUES
  //                       (:name, :price, :tenan_id)";
  //     $this->db->query($query);
  //     $this->db->bind('name', $data['name']);
  //     $this->db->bind('price', $data['price']);
  //     $this->db->bind('tenan_id', $data['tenan_id']);

  //     $this->db->execute();
  //     return $this->db->rowCount();
  //   } else {
  //     $data['name'] = isset($data['name']) ?  $data['name'] : '';
  //     $data['price'] = isset($data['price']) ?  $data['price'] : '';
  //     $data['picture'] = $namePicture;
  //     $data['tenan_id'] = isset($data['tenan_id']) ?  $data['tenan_id'] : '';
  //     if ($data['name'] === '' && $data['price'] === '' && $data['picture'] === '' && $data['tenan_id'] === '') {
  //       return false;
  //       exit;
  //     }

  //     $query = "INSERT INTO `products` 
  //                   (name, price, picture, tenan_id) 
  //                       VALUES
  //                       (:name, :price, :picture, :tenan_id)";
  //     $this->db->query($query);
  //     $this->db->bind('name', $data['name']);
  //     $this->db->bind('price', $data['price']);
  //     $this->db->bind('picture', $data['picture']);
  //     $this->db->bind('tenan_id', $data['tenan_id']);

  //     $this->db->execute();
  //     return $this->db->rowCount();
  //   }
  // }


  // // update data Tenan
  // public function updateProduct($data, $id)
  // {
  //   $data['name'] = isset($data['name']) ?  $data['name'] : '';
  //   $data['price'] = isset($data['price']) ?  $data['price'] : '';
  //   $data['picture'] = isset($data['picture']) ?  $data['picture'] : '';
  //   $data['tenan_id'] = isset($data['tenan_id']) ?  $data['tenan_id'] : '';
  //   $query = "UPDATE `products`  
  //                   SET 
  //                   name=:name, 
  //                   price=:price, 
  //                   picture=:picture
  //                   WHERE product_id=:product_id
  //                   ";
  //   $this->db->query($query);
  //   $this->db->bind('name', $data['name']);
  //   $this->db->bind('price', $data['price']);
  //   $this->db->bind('picture', $data['picture']);

  //   $this->db->bind('product_id', $id);
  //   $this->db->execute();
  //   return $this->db->rowCount();
  // }

  // // hapus data Tenan
  // public function delProduct($id)
  // {
  //   $query = "DELETE FROM `products` WHERE product_id=:product_id";
  //   $this->db->query($query);
  //   $this->db->bind('product_id', $id);
  //   $this->db->execute();
  //   return $this->db->rowCount();
  // }
}