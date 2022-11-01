<?php

class Product_model
{
    // jangan dirubah
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    // stop 


    public function getProductAll($acounid)
    {
        $this->db->query("SELECT 
        product_id, 
        products.name name, 
        products.price price, 
        products.picture picture, 
        products.quantity quantity,
        tenan_id 
        FROM `products` JOIN tenan USING(tenan_id) 
        WHERE acount_id=$acounid
        ORDER BY product_id DESC");
        return $this->db->resultSet();
    }

    public function getProductByTenan($tenanId)
    {
        $this->db->query("SELECT 
        product_id, 
        products.name name_product, 
        products.price price, 
        products.picture picture, 
        products.quantity quantity,
        tenan.name name,
        tenan_id 
        FROM `products` JOIN tenan USING(tenan_id) 
        WHERE tenan_id=$tenanId
        ORDER BY product_id DESC");
        return $this->db->resultSet();
    }

    public function getNewProductByTenan($tenanId)
    {
        $this->db->query("SELECT 
        product_id, 
        products.name name_product, 
        products.price price, 
        products.picture picture, 
        products.quantity quantity,
        tenan.name name,
        tenan_id 
        FROM `products` JOIN tenan USING(tenan_id) 
        WHERE tenan_id=$tenanId
        ORDER BY product_id DESC LIMIT 0,1 ");
        return $this->db->single();
    }
    public function getProductOnlyById($id)
    {
        $this->db->query("SELECT 
        product_id, 
        products.name name, 
        products.price price, 
        products.picture picture, 
        tenan_id 
        FROM `products` JOIN tenan USING(tenan_id) 
        WHERE product_id=$id");
        return $this->db->single();
    }

    public function getProductById($acounid, $id)
    {
        $this->db->query("SELECT 
        product_id, 
        products.name name, 
        products.price price, 
        products.picture picture, 
        tenan_id 
        FROM `products` JOIN tenan USING(tenan_id) 
        WHERE acount_id=$acounid AND product_id=$id");
        return $this->db->single();
    }

    public function getProductByTransactionId($transId)
    {
        $this->db->query("SELECT 
        *
        FROM `stock_transactions` 
        JOIN `products` USING(product_id)
        WHERE transaction_id='$transId'
        ORDER BY date DESC, time DESC");
        return $this->db->resultSet();
    }

    public function updateMinQtyProduct($qty, $id)
    {
        $query = "UPDATE `products`  
                    SET 
                    quantity=((SELECT quantity FROM `products` WHERE product_id=$id) - $qty)
                    WHERE product_id=$id
                    ";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updatePlusQtyProduct($qty, $id)
    {
        $query = "UPDATE `products`  
                    SET 
                    quantity=((SELECT quantity FROM `products` WHERE product_id=$id) + $qty)
                    WHERE product_id=$id
                    ";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->rowCount();
    }




    public function createProduct($data, $namePicture = null)
    {
        if ($namePicture == null) {
            $data['name'] = isset($data['name']) ?  $data['name'] : '';
            $data['quantity'] = isset($data['quantity']) ?  $data['quantity'] : '';
            $data['price'] = isset($data['price']) ?  $data['price'] : '';
            $data['tenan_id'] = isset($data['tenan_id']) ?  $data['tenan_id'] : '';
            if ($data['name'] === '' && $data['price'] === '' && $data['picture'] === '' && $data['tenan_id'] === '') {
                return false;
                exit;
            }

            $query = "INSERT INTO `products` 
                    (name, price, tenan_id, quantity) 
                        VALUES
                        (:name, :price, :tenan_id, :quantity)";
            $this->db->query($query);
            $this->db->bind('name', $data['name']);
            $this->db->bind('price', $data['price']);
            $this->db->bind('tenan_id', $data['tenan_id']);
            $this->db->bind('quantity', $data['quantity']);

            $this->db->execute();
            return $this->db->rowCount();
        } else {
            $data['name'] = isset($data['name']) ?  $data['name'] : '';
            $data['quantity'] = isset($data['quantity']) ?  $data['quantity'] : '';
            $data['price'] = isset($data['price']) ?  $data['price'] : '';
            $data['picture'] = $namePicture;
            $data['tenan_id'] = isset($data['tenan_id']) ?  $data['tenan_id'] : '';
            if ($data['name'] === '' && $data['price'] === '' && $data['picture'] === '' && $data['tenan_id'] === '') {
                return false;
                exit;
            }

            $query = "INSERT INTO `products` 
                    (name, price, picture, tenan_id, quantity) 
                        VALUES
                        (:name, :price, :picture, :tenan_id, :quantity)";
            $this->db->query($query);
            $this->db->bind('name', $data['name']);
            $this->db->bind('price', $data['price']);
            $this->db->bind('picture', $data['picture']);
            $this->db->bind('tenan_id', $data['tenan_id']);
            $this->db->bind('quantity', $data['quantity']);


            $this->db->execute();
            return $this->db->rowCount();
        }
    }


    public function updateProduct($data, $id)
    {
        $data['name'] = isset($data['name']) ?  $data['name'] : '';
        $data['price'] = isset($data['price']) ?  $data['price'] : '';
        $data['picture'] = isset($data['picture']) ?  $data['picture'] : '';
        $data['tenan_id'] = isset($data['tenan_id']) ?  $data['tenan_id'] : '';
        $query = "UPDATE `products`  
                    SET 
                    name=:name, 
                    price=:price, 
                    picture=:picture
                    WHERE product_id=:product_id
                    ";
        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('price', $data['price']);
        $this->db->bind('picture', $data['picture']);

        $this->db->bind('product_id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function delPict($id)
    {
        $this->db->query("SELECT picture, tenan_id 
        FROM `products`  
        JOIN tenan USING(tenan_id)  
        WHERE product_id=$id");

        $data = $this->db->single();

        // $this->db->close();
        if ($data && $data['picture'] != '') {
            if (file_exists('img/produk/' . $data['tenan_id'] . '/' .   $data['picture'])) {

                unlink('img/produk/' . $data['tenan_id'] . '/' .   $data['picture']);
            }
        }

        return true;
    }
    // hapus data Tenan
    public function delProduct($id)
    {


        $query = "DELETE FROM `products` WHERE product_id=:product_id";
        $this->db->query($query);
        $this->db->bind('product_id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
