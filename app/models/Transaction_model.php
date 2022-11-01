<?php

class Transaction_model
{
    // jangan dirubah
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    // stop 

    public function getTransactionDayUpTenan()
    {
        $this->db->query("SELECT tenan.name nama_tenan, date, DATE(sysdate()), DATE_FORMAT(date, '%d') tgl, FORMAT(SUM((price*quantity)), 0) total, DATE_FORMAT(date, '%M') bulan, YEAR(date) tahun FROM tenan
            JOIN transactions USING(tenan_id)
            JOIN items USING(transaction_id)
            WHERE transactions.date = DATE(sysdate())
            GROUP BY date, tenan_id
            ORDER BY date DESC
        ");
        return $this->db->resultSet();
    }
    public function getTransactionMonthUpTenan()
    {
        $this->db->query("SELECT tenan.name nama_tenan, FORMAT(SUM((price*quantity)), 0) total, DATE_FORMAT(date, '%M') bulan, YEAR(date) tahun FROM tenan
            JOIN transactions USING(tenan_id)
            JOIN items USING(transaction_id)
            WHERE MONTH(date) = MONTH(SYSDATE())
            GROUP BY MONTH(date), tenan_id
        ");
        return $this->db->resultSet();
    }

    public function getTransactionAll($acounid)
    {
        // untuk api
        $this->db->query("SELECT 
        transaction_id,
        date,
        time,
        cancel,
        status,
        tenan_id, 
        SUM((price*quantity)) total
        FROM `transactions` JOIN tenan USING(tenan_id) 
        JOIN `items` USING(transaction_id)
        WHERE acount_id=$acounid AND status=1
        AND date=(SELECT date FROM `transactions`
                    JOIN tenan USING(tenan_id) 
                    JOIN `items` USING(transaction_id)
                    WHERE acount_id=$acounid 
                    ORDER BY date DESC LIMIT 0,1)
        GROUP BY transaction_id
        ORDER BY date DESC, time DESC
        ");
        return $this->db->resultSet();
    }

    public function getTransactionAllByDate($acounid, $date)
    {
        // untuk api
        $this->db->query("SELECT 
        transaction_id,
        date,
        time,
        cancel,
        status,
        tenan_id, 
        SUM((price*quantity)) total
        FROM `transactions` JOIN tenan USING(tenan_id) 
        JOIN `items` USING(transaction_id)
        WHERE acount_id=$acounid AND status=1
        AND date='$date'
        GROUP BY transaction_id
        ORDER BY date DESC, time DESC
        ");
        return $this->db->resultSet();
    }



    public function getTransactionStatus($acounid)
    {
        // untuk API
        $this->db->query("SELECT 
        transaction_id,
        date,
        time,
        cancel,
        status,
        tenan_id, 
        COUNT(item_id) totalitem,
        SUM(quantity) totalproduk,
        SUM((price*quantity)) total
        FROM `transactions` JOIN tenan USING(tenan_id) 
        JOIN `items` USING(transaction_id)
        WHERE acount_id=$acounid AND status=0
        GROUP BY transaction_id
        ORDER BY date DESC
        ");
        return $this->db->resultSet();
    }

    public function getTransactionByIdOnly($id)
    {
        $this->db->query("SELECT *
        FROM `transactions`  
        WHERE transaction_id='" . $id . "'");
        return $this->db->single();
    }


    public function getTransactionById($acounid, $id)
    {
        $this->db->query("SELECT 
        transaction_id,
        date,
        time,
        cancel,
        status,
        tenan_id 
        FROM `transactions`  JOIN tenan USING(tenan_id) 
        WHERE acount_id=$acounid AND transaction_id='" . $id . "'");
        return $this->db->single();
    }



    // tambah Transaction
    public function createTransaction($data)
    {
        $data['date'] = isset($data['date']) ?  $data['date'] : '';
        $data['time'] = isset($data['time']) ?  $data['time'] : '';
        $data['transaction_id'] = isset($data['transaction_id']) ?  $data['transaction_id'] : '';
        $data['tenan_id'] = isset($data['tenan_id']) ?  $data['tenan_id'] : '';
        $query = "INSERT INTO `transactions` 
                    (date, time, transaction_id, tenan_id) 
                        VALUES
                        (:date, :time, :transaction_id, :tenan_id)";
        $this->db->query($query);
        $this->db->bind('date', $data['date']);
        $this->db->bind('time', $data['time']);
        $this->db->bind('transaction_id', $data['transaction_id']);
        $this->db->bind('tenan_id', $data['tenan_id']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    // update data Transaction
    public function updateCancelTransaction($id)
    {


        $query = "UPDATE `transactions`  
                    SET 
                    cancel=0 
                    WHERE transaction_id=:transaction_id
                    ";
        $this->db->query($query);

        $this->db->bind('transaction_id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateTransaksiStatus($id)
    {
        $query = "UPDATE `transactions`
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



    // hapus data Transaction
    public function delTransaction($id)
    {
        $query = "DELETE FROM `transactions` WHERE transaction_id=:transaction_id";
        $this->db->query($query);
        $this->db->bind('transaction_id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    // dsdsds
    public function getIncomeMonthByTenanId($data, $id)
    {
        $this->db->query("SELECT MONTH(date) bulan, FORMAT(SUM((price*quantity)), 0) total_bulanan FROM transactions 
        JOIN items 
        USING(transaction_id)
        WHERE tenan_id=" . $id . " AND MONTH(date)=" . $data['date'] . "
        GROUP BY MONTH(date)");
        return $this->db->resultSet();
    }
}
