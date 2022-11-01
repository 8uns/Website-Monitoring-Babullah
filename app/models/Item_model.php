<?php

class Item_model
{
    // jangan dirubah
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    // stop 


    public function getItemAll($acounid, $transaction_id)
    {

        $this->db->query("SELECT 
        items.item_id item_id,
        items.name name,
        items.quantity quantity,
        items.price price,
        items.discount discount,
        items.transaction_id transaction_id
        FROM `items` 
        JOIN `transactions` USING(transaction_id)
        JOIN `tenan` USING(tenan_id)
        WHERE acount_id={$acounid} AND 
        transaction_id='$transaction_id'");
        return $this->db->resultSet();
    }

    public function getItemAllAktif($acoun_id)
    {
        $this->db->query("SELECT 
        items.item_id item_id,
        items.name name,
        items.quantity quantity,
        items.price price,
        items.discount discount,
        items.transaction_id transaction_id
        FROM `items` 
        JOIN `transactions` USING(transaction_id)
        JOIN `tenan` USING(tenan_id)
        WHERE acount_id=$acoun_id AND 
        transaction_id=
        (SELECT transaction_id
        FROM `transactions`
        JOIN tenan USING(tenan_id) 
        WHERE status=0 AND acount_id=$acoun_id) ");
        return $this->db->resultSet();
    }

    public function getItemAllByTransaction($id)
    {
        $this->db->query("SELECT 
        * FROM `items` WHERE transaction_id='$id'");
        return $this->db->resultSet();
    }



    public function getItemById($id)
    {
        $this->db->query("SELECT
        items.item_id item_id,
        items.name name,
        items.quantity quantity,
        items.price price,
        items.discount discount,
        items.transaction_id transaction_id
        FROM `items` 
        JOIN `transactions` USING(transaction_id)
        JOIN `tenan` USING(tenan_id)
        WHERE  
        item_id=$id");
        return $this->db->single();
    }



    public function createItem($data, $acounid)
    {
        $query = "SELECT transaction_id, tenan_id  FROM `transactions`  
                    JOIN tenan USING(tenan_id) 
                    WHERE acount_id=$acounid AND status='0'";
        $this->db->query($query);
        $transac =  $this->db->single();
        $this->db->close();

        if ($transac) {
            $data['name'] = isset($data['name']) ?  $data['name'] : '';
            $data['price'] = isset($data['price']) ?  $data['price'] : '';
            $data['quantity'] = isset($data['quantity']) ?  $data['quantity'] : '';
            $data['product_id'] = isset($data['product_id']) ?  $data['product_id'] : '';
            $query = "INSERT INTO `items` 
                    (name, price, quantity, transaction_id) 
                        VALUES
                        (:name, :price, :quantity, :transaction_id)";
            $this->db->query($query);
            $this->db->bind('name', $data['name']);
            $this->db->bind('price', $data['price']);
            $this->db->bind('quantity', $data['quantity']);
            $this->db->bind('transaction_id', $transac['transaction_id']);
            $this->db->execute();
            if ($this->db->rowCount()) {
                $this->db->close();

                $query = "INSERT INTO `stock_transactions` 
                     (product_id, qtytrans, transaction_id, date, time, in_out, status) 
                         VALUES
                         (:product_id, :qtytrans, :transaction_id, DATE(ADDTIME(SYSDATE(), '9:00:0')), TIME(ADDTIME(SYSDATE(), '9:00:0')), 'keluar', 0)";
                $this->db->query($query);
                $this->db->bind('product_id', $data['product_id']);
                $this->db->bind('qtytrans', $data['quantity']);
                $this->db->bind('transaction_id', $transac['transaction_id']);

                $this->db->execute();
                return $this->db->rowCount();
            } else {
                return false;
            }
        } else {
            $query = "INSERT INTO transactions 
            (date, time, transaction_id, tenan_id )
            VALUES(
                DATE(ADDTIME(SYSDATE(), '9:00:0')), 
                TIME(ADDTIME(SYSDATE(), '9:00:0')), 
                CONCAT('TR',REPLACE(CONVERT(DATE(ADDTIME(SYSDATE(), '9:00:0')),CHARACTER),'-',''),
                REPLACE(CONVERT(TIME(ADDTIME(SYSDATE(), '9:00:0')),CHARACTER),':','')),
                (SELECT tenan_id FROM tenan WHERE acount_id=$acounid) )
                            ";
            $this->db->query($query);
            $this->db->execute();
            $this->db->close();

            return $this->createItem($data, $acounid);
        }
    }
}
