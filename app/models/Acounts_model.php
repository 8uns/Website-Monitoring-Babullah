<?php

class Acounts_model
{
    // jangan dirubah
    private $db;
    public function __construct()
    {
        $this->db = new Database;
        $this->bunlib = new Bunlib;
    }

    public function getTotalAkunTenan()
    {
        $this->db->query("SELECT COUNT(*) total_akuntenan FROM acounts
            JOIN tenan USING(acount_id)");
        return $this->db->single();
    }
    // stop 

    public function ubahDataAkunTenan($data, $id)
    {
        if ($data['password'] != '') {
            $pass = $this->bunlib->generatePassword($data['password']);
            $showit = $this->bunlib->generatePasswordEncodeTwoWay($data['password']);
            $query = "UPDATE `acounts`  
                    SET 
                    name=:name, 
                    username=:username, 
                    password='$pass', 
                    showit='$showit' 
                    WHERE acount_id=:acount_id
                        ";
            $this->db->query($query);
            $this->db->bind('name', $data['name']);
            $this->db->bind('username', $data['username']);
            $this->db->bind('acount_id', $id);
            $this->db->execute();
            return $this->db->rowCount();
        } else {
            $query = "UPDATE `acounts`  
                    SET 
                    name=:name, 
                    username=:username 
                    WHERE acount_id=:acount_id
                        ";
            $this->db->query($query);
            $this->db->bind('name', $data['name']);
            $this->db->bind('username', $data['username']);
            $this->db->bind('acount_id', $id);
            $this->db->execute();
            return $this->db->rowCount();
        }
    }

    public function tambahAkunTenan($data)
    {
        $this->db->query("SELECT * FROM `acounts` WHERE username='" . $data['username'] . "'");
        $cekakun = $this->db->single();
        if (!$cekakun) {
            $this->db->close();

            $pass = $this->bunlib->generatePassword($data['password']);
            $showit = $this->bunlib->generatePasswordEncodeTwoWay($data['password']);
            $tokens = $data['name'] . $data['username'] . $data['password'];
            $token = $this->bunlib->generateToken($tokens);


            $query = "INSERT INTO `acounts` 
                    (username, name, password, showit, levels, status, token) 
                        VALUES
                        (:username, :name, '$pass', '$showit', '1', '1', '$token')";
            $this->db->query($query);
            $this->db->bind('username', $data['username']);
            $this->db->bind('name', $data['name']);
            $this->db->execute();

            if ($this->db->rowCount()) {
                $this->db->close();

                $query = "UPDATE `tenan`  
                 SET 
                 acount_id=(SELECT acount_id FROM `acounts` ORDER BY acount_id DESC LIMIT 0,1)
                 
                 WHERE tenan_id=:tenan_id
                 ";
                $this->db->query($query);
                $this->db->bind('tenan_id', $data['tenan_id']);
                $this->db->execute();
                return $this->db->rowCount();
            } else {
                return false;
            }
        } else {
            return 'double';
        }
    }


    public function getAcountByid($id)
    {
        $this->db->query("SELECT * FROM `acounts` WHERE acount_id=" . $id);
        return $this->db->single();
    }

    public function getAcountTenanByid($id)
    {
        $this->db->query("SELECT acount_id, tenan_id, username, acounts.name name, tenan.name tenan  FROM `acounts` JOIN tenan USING(acount_id) WHERE acount_id=" . $id);
        return $this->db->single();
    }

    public function getAcountTenanAll()
    {
        $this->db->query("SELECT showit, acount_id, tenan_id, username, acounts.name name, tenan.name tenan, npwp, contract_period FROM `acounts` JOIN tenan USING(acount_id)  ");
        return $this->db->resultSet();
    }

    public function cekToken($token)
    {
        $this->db->query("SELECT token, acount_id  FROM `acounts` WHERE token='" . $token . "'");
        return $this->db->single();
    }

    // public function getProductAllByTenan($id)
    // {
    //     $this->db->query("SELECT * FROM `products` WHERE tenan_id=" . $id);
    //     return $this->db->resultSet();
    // }

    // public function getProductById($id)
    // {
    //     $this->db->query("SELECT * FROM `products` WHERE product_id=" . $id);
    //     return $this->db->single();
    // }



    // tambah Tenan
    //   public function createProduct($data)
    //   {
    //             $data['name'] = isset($data['name']) ?  $data['name'] : '';
    //             $data['price'] = isset($data['price']) ?  $data['price'] : '';
    //             $data['picture'] = isset($data['picture']) ?  $data['picture'] : '';
    //             $data['tenan_id'] = isset($data['tenan_id']) ?  $data['tenan_id'] : '';
    //             $query = "INSERT INTO `products` 
    //             (name, price, picture, tenan_id) 
    //                 VALUES
    //                 (:name, :price, :picture, :tenan_id)";
    //             $this->db->query($query);
    //             $this->db->bind('name', $data['name']);
    //             $this->db->bind('price', $data['price']);
    //             $this->db->bind('picture', $data['picture']);
    //             $this->db->bind('tenan_id', $data['tenan_id']);

    //             $this->db->execute();
    //             return $this->db->rowCount();
    //   }


    //   // update data Tenan
    //   public function updateProduct($data, $id)
    //   {
    //             $data['name'] = isset($data['name']) ?  $data['name'] : '';
    //             $data['price'] = isset($data['price']) ?  $data['price'] : '';
    //             $data['picture'] = isset($data['picture']) ?  $data['picture'] : '';
    //             $data['tenan_id'] = isset($data['tenan_id']) ?  $data['tenan_id'] : '';
    //             $query = "UPDATE `products`  
    //             SET 
    //             name=:name, 
    //             price=:price, 
    //             picture=:picture
    //             WHERE product_id=:product_id
    //             ";
    //             $this->db->query($query);
    //             $this->db->bind('name', $data['name']);
    //             $this->db->bind('price', $data['price']);
    //             $this->db->bind('picture', $data['picture']);

    //             $this->db->bind('product_id', $id);
    //             $this->db->execute();
    //             return $this->db->rowCount();
    //   }

    //   // hapus data Tenan
    //   public function delProduct($id)
    //   {
    //             $query = "DELETE FROM `products` WHERE product_id=:product_id";
    //             $this->db->query($query);
    //             $this->db->bind('product_id', $id);
    //             $this->db->execute();
    //             return $this->db->rowCount();
    //   }
}