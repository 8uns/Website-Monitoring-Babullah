<?php

class StockTransaction_model
{
    // jangan dirubah
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getStockInOutByTenanAndTime($tenanId, $data)
    {
        $this->db->query("SELECT * FROM `stock_transactions` 
                            JOIN `products` USING(product_id)
                            WHERE tenan_id=$tenanId AND date='" . $data['tgl'] . "'
        ORDER BY date DESC, time DESC");
        return $this->db->resultSet();
    }
    public function getStockInOutByTenanByProdukAndTime($tenanId, $produkId, $data)
    {
        $this->db->query("SELECT * FROM `stock_transactions` 
                            JOIN `products` USING(product_id)
                            WHERE tenan_id=$tenanId AND product_id=$produkId AND date='" . $data['tgl'] . "'
        ORDER BY date DESC, time DESC");
        return $this->db->resultSet();
    }

    public function updateStockTransaksiStatus($id)
    {
        $query = "UPDATE `stock_transactions`
                    SET 
                    status=1,
                    date=DATE(ADDTIME(SYSDATE(), '9:00:0')),
                    time=TIME(ADDTIME(SYSDATE(), '9:00:0')) 
                    WHERE transaction_id=:transaction_id
                    ";
        $this->db->query($query);

        $this->db->bind('transaction_id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getInventoryAll($acounid)
    {
        $this->db->query("SELECT 
        stock_transactions.date date,
        stock_transactions.time time,
        stock_transactions.in_out in_out,
        stock_transactions.product_id product_id,
        stock_transactions.qtytrans qtytrans,
        stock_transactions.transaction_id transaction_id,
        stock_transactions.status status,
        products.name name_product,
        products.picture picture,
        acount_id
        FROM `stock_transactions` 
        JOIN products USING(product_id)
        JOIN tenan USING(tenan_id)
        JOIN acounts USING(acount_id)
        WHERE acount_id=$acounid AND in_out='masuk'
        ORDER BY date DESC, time DESC");
        return $this->db->resultSet();
    }
    public function getInventoryById($acounid, $id)
    {
        $this->db->query("SELECT 
        stock_transactions.date date,
        stock_transactions.time time,
        stock_transactions.in_out in_out,
        stock_transactions.product_id product_id,
        stock_transactions.qtytrans qtytrans,
        stock_transactions.transaction_id transaction_id,
        stock_transactions.status status,
        products.name name_product,
        products.picture picture,
        acount_id
        FROM `stock_transactions` 
        JOIN products USING(product_id)
        JOIN tenan USING(tenan_id)
        JOIN acounts USING(acount_id)
        WHERE acount_id=$acounid AND in_out='masuk'  AND product_id=$id
        ORDER BY date DESC, time DESC");
        return $this->db->resultSet();
    }

    public function insertStockProduct($data, $idProduct)
    {
        $data['quantity'] = isset($data['quantity']) ?  $data['quantity'] : '';

        $query = "INSERT INTO `stock_transactions` 
                     (product_id, qtytrans, date, time, in_out, status) 
                         VALUES
                         (:product_id, :qtytrans, DATE(ADDTIME(SYSDATE(), '9:00:0')), TIME(ADDTIME(SYSDATE(), '9:00:0')), 'masuk', 1)";
        $this->db->query($query);
        $this->db->bind('product_id', $idProduct);
        $this->db->bind('qtytrans', $data['quantity']);

        $this->db->execute();

        return $this->db->rowCount();
    }
}
