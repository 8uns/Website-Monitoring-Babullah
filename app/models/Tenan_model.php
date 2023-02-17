<?php

class Tenan_model
{
    // jangan dirubah
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    // stop jangan rubah

    public function getTotalTenan()
    {
        $this->db->query("SELECT COUNT(*) total_tenan FROM tenan ");
        return $this->db->single();
    }

    public function getTenanById($id)
    {
        $this->db->query("SELECT * FROM tenan WHERE tenan_id=$id");
        return $this->db->single();
    }

    public function getTenanAll()
    {
        $this->db->query("
        SELECT tenan_id, tenan.name name, npwp, contract_period, acount_id, username, acounts.name name_acount,
            (SELECT file_contract FROM contract_tenan WHERE tenan_id=tenan.tenan_id ORDER BY contract_tenan_id DESC LIMIT 0,1) file_contract ,
            (SELECT contract_tenan_id FROM contract_tenan WHERE tenan_id=tenan.tenan_id ORDER BY contract_tenan_id DESC LIMIT 0,1) contract_tenan_id 
            FROM `tenan` 
            LEFT JOIN `acounts` USING(acount_id)
            ORDER BY tenan_id DESC
        ");
        return $this->db->resultSet();
    }

    public function getTenanFilterByAcount()
    {
        $this->db->query("
        SELECT tenan_id, tenan.name name, npwp, contract_period, acount_id, username, acounts.name name_acount,
            (SELECT file_contract FROM contract_tenan WHERE tenan_id=tenan.tenan_id ORDER BY contract_tenan_id DESC LIMIT 0,1) file_contract ,
            (SELECT contract_tenan_id FROM contract_tenan WHERE tenan_id=tenan.tenan_id ORDER BY contract_tenan_id DESC LIMIT 0,1) contract_tenan_id 
            FROM `tenan` 
            LEFT JOIN `acounts` USING(acount_id)
             WHERE acount_id IS NOT NULL
            ORDER BY tenan_id DESC
        ");
        return $this->db->resultSet();
    }

    public function getArsipKontrak($id)
    {
        $this->db->query("
       SELECT * FROM `contract_tenan` WHERE tenan_id=$id ORDER BY date_upload DESC
        ");
        return $this->db->resultSet();
    }

    public function getTenanNotAkunAll()
    {
        $this->db->query("SELECT * FROM tenan WHERE acount_id IS NULL");
        return $this->db->resultSet();
    }

    public function getTenanWithAkunAll()
    {
        $this->db->query("SELECT * FROM tenan WHERE acount_id IS NOT NULL");
        return $this->db->resultSet();
    }

    public function getAkunTenanAll()
    {
        $this->db->query("SELECT * FROM `acounts` JOIN `tenan` USING(acount_id)");
        return $this->db->resultSet();
    }

    public function getAkunTenanAllNotAcount()
    {
        $this->db->query("SELECT * FROM `tenan` WHERE acount_id IS NULL");
        return $this->db->resultSet();
    }

    // tambah akun Tenan
    public function tambahAkunTenan($data)
    {
        $query = "INSERT INTO `acounts` 
                    (username, password) 
                        VALUES
                        (:username, :password )";
        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('cv', $data['cv']);
        $this->db->bind('npwp', $data['npwp']);
        $this->db->bind('contract_period', $data['contract_period']);
        $this->db->bind('agreement', $data['agreement']);

        $this->db->execute();
        return $this->db->rowCount();
    }


    // tambah Tenan
    public function tambahTenan($data)
    {
        $query = "INSERT INTO `tenan` 
                    (name, cv, npwp, agreement, contract_period) 
                        VALUES
                        (:name, :cv, :npwp, :agreement, :contract_period)";
        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('cv', $data['cv']);
        $this->db->bind('npwp', $data['npwp']);
        $this->db->bind('contract_period', $data['contract_period']);
        $this->db->bind('agreement', $data['agreement']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    // tambah Tenan
    public function insertFileContract($data, $id)
    {
        $query = "INSERT INTO `contract_tenan` 
                    (file_contract, date_upload, tenan_id) 
                        VALUES
                        (:file_contract, ADDTIME(SYSDATE(), '9:00:0'), :tenan_id)";
        $this->db->query($query);
        $this->db->bind('file_contract', $data);
        $this->db->bind('tenan_id', $id);

        $this->db->execute();
        return $this->db->rowCount();
    }
    public function updateFileContract($data, $contractid)
    {
        $query = "UPDATE `contract_tenan`  
                    SET 
                    file_contract=:file_contract 
                    WHERE contract_tenan_id=:contract_tenan_id
                        ";
        $this->db->query($query);
        $this->db->bind('file_contract', $data);
        $this->db->bind('contract_tenan_id', $contractid);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function deloldcontrat($id, $fileold)
    {

        if (file_exists('file/contract/' . $id . '/' .   $fileold)) {

            unlink('file/contract/' . $id . '/' .   $fileold);
        }

        return true;
    }

    // update data Tenan
    public function ubahDataTenan($data, $id)
    {
        $query = "UPDATE `tenan`  
                    SET 
                    name=:name, 
                    cv=:cv, 
                    npwp=:npwp, 
                    agreement=:agreement, 
                    contract_period=:contract_period
                    WHERE tenan_id=:tenan_id
                        ";
        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('cv', $data['cv']);
        $this->db->bind('npwp', $data['npwp']);
        $this->db->bind('contract_period', $data['contract_period']);
        $this->db->bind('agreement', $data['agreement']);
        $this->db->bind('tenan_id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    // hapus data Tenan
    public function hapusDataTenan($id)
    {

        $query = "DELETE FROM `acounts` WHERE acount_id=(SELECT acount_id FROM tenan WHERE tenan_id=$id)";
        $this->db->query($query);
        $this->db->execute();

        if ($this->db->rowCount()) {
            $this->db->close();

            $query = "DELETE FROM `tenan` WHERE tenan_id=:tenan_id";
            $this->db->query($query);
            $this->db->bind('tenan_id', $id);
            $this->db->execute();
            return $this->db->rowCount();
            exit;
        } else {
            $this->db->close();

            $query = "DELETE FROM `tenan` WHERE tenan_id=:tenan_id";
            $this->db->query($query);
            $this->db->bind('tenan_id', $id);
            $this->db->execute();
            return $this->db->rowCount();
            exit;
        }


        return false;
    }



    // update data Tenan Harian
    public function pendapatanHarianDataTenan()
    {
        $query = "SELECT date, FORMAT(SUM((price*quantity)),0) total_harian, tenan_id FROM transactions 
					JOIN items 
					USING(transaction_id)
					GROUP BY date, tenan_id
					ORDER BY date DESC";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    // update data Tenan Bulanan
    public function pendapatanBulananDataTenan()
    {
        $query = "SELECT MONTH(date) bulan, FORMAT(SUM((price*quantity)),0) total_bulanan, tenan_id FROM transactions 
					JOIN items 
					USING(transaction_id)
					GROUP BY MONTH(date), tenan_id
					ORDER BY date DESC";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    // update data Tenan Tahunan
    public function pendapatanTahunanDataTenan()
    {
        $query = "SELECT YEAR(date) year, FORMAT(SUM((price*quantity)),0) total_tahunan, tenan_id FROM transactions 
					JOIN items 
					USING(transaction_id)
					GROUP BY YEAR(date), tenan_id
					ORDER BY date DESC";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    // Cek data Tenan Harian
    public function cekHarianTenanDetail($data, $id)
    {
        $query = "SELECT 
        tenan.name nama_tenan, 
        transaction_id, 
        date, 
        DATE_FORMAT(date, '%d') tgl, 
        time, 
        FORMAT(SUM((price*quantity)),0) total_harian, 
        tenan_id,
        SUM((price*quantity)) total
        FROM transactions
					JOIN items USING(transaction_id)
					JOIN tenan USING(tenan_id)
					WHERE tenan_id=$id AND transactions.date='{$data['tgl']}'
					GROUP BY transaction_id ";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function cekHarianTenanDetailTerbaru($id)
    {
        $query = "SELECT 
        tenan.name nama_tenan, 
        transaction_id, 
        date, 
        DATE_FORMAT(date, '%d') tgl, 
        time, 
        FORMAT(SUM((price*quantity)),0) total_harian, 
        tenan_id 
        FROM transactions
					JOIN items USING(transaction_id)
					JOIN tenan USING(tenan_id)
					WHERE tenan_id=$id AND 
                    transactions.date=(
                    SELECT date FROM transactions
					JOIN items USING(transaction_id)
					JOIN tenan USING(tenan_id)
					WHERE tenan_id=$id 
					ORDER BY date DESC LIMIT 0,1
                    )
					GROUP BY transaction_id ";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function cekHarianTenanTotal($data, $id)
    {
        $query = "SELECT tenan.name nama_tenan, transaction_id, date, DATE_FORMAT(date, '%d') tgl, time, FORMAT(SUM((price*quantity)),0) total_harian, tenan_id FROM transactions
					JOIN items USING(transaction_id)
					JOIN tenan USING(tenan_id)
					WHERE tenan_id=$id AND transactions.date='{$data['tgl']}'
					GROUP BY date ";
        $this->db->query($query);
        return $this->db->resultSet();
    }
    public function cekHarianTenanTotalTerbaru($id)
    {
        $query = "SELECT tenan.name nama_tenan, transaction_id, date, DATE_FORMAT(date, '%d') tgl, time, FORMAT(SUM((price*quantity)),0) total_harian, tenan_id FROM transactions
					JOIN items USING(transaction_id)
					JOIN tenan USING(tenan_id)
					WHERE tenan_id=$id AND 
                    transactions.date=(
                    SELECT date FROM transactions
					JOIN items USING(transaction_id)
					JOIN tenan USING(tenan_id)
					WHERE tenan_id=$id 
					ORDER BY date DESC LIMIT 0,1
                    )
					GROUP BY date ";
        $this->db->query($query);
        return $this->db->resultSet();
    }


    // Cek data Tenan Bulanan
    public function cekBulananDetail($data, $id)
    {
        $query = "SELECT tenan.name nama_tenan, acounts.name namapengelola, transaction_id, date, MONTH(date) bulan, YEAR(date) tahun, FORMAT(SUM((price*quantity)),0) total_bulan, tenan_id FROM transactions
					JOIN items USING(transaction_id)
					JOIN tenan USING(tenan_id)
                    JOIN acounts USING(acount_id)
                    
                    WHERE MONTH(date) = '{$data['bulan']}' AND YEAR(date)='{$data['tahun']}' AND tenan_id=$id
					GROUP BY date ORDER BY date ASC";
        $this->db->query($query);
        return $this->db->resultSet();
    }
    public function cekBulananDetailTerbaru($id)
    {
        $query = "SELECT tenan.name nama_tenan, acounts.name namapengelola, transaction_id, date, MONTH(date) bulan, YEAR(date) tahun, FORMAT(SUM((price*quantity)),0) total_bulan, tenan_id FROM transactions
					JOIN items USING(transaction_id)
					JOIN tenan USING(tenan_id)
                    JOIN acounts USING(acount_id)
                     
                    WHERE MONTH(date) =(
                    SELECT MONTH(date) FROM transactions
					JOIN items USING(transaction_id)
					JOIN tenan USING(tenan_id)
                    JOIN acounts USING(acount_id)
                    
                    WHERE tenan_id=$id ORDER BY date DESC LIMIT 0,1
                    ) AND YEAR(date)=(
                    SELECT YEAR(date) FROM transactions
					JOIN items USING(transaction_id)
					JOIN tenan USING(tenan_id)
                    JOIN acounts USING(acount_id)
                    
                    WHERE tenan_id=$id ORDER BY date DESC LIMIT 0,1
                    )
                     AND tenan_id=$id
					GROUP BY date ORDER BY date ASC";
        $this->db->query($query);
        return $this->db->resultSet();
    }
    public function cekBulananTotal($data, $id)
    {
        $query = "SELECT tenan.name nama_tenan, acounts.name namapengelola, transaction_id, date, MONTH(date) bulan, YEAR(date) tahun, FORMAT(SUM((price*quantity)),0) total_bulan, tenan_id FROM transactions
					JOIN items USING(transaction_id)
					JOIN tenan USING(tenan_id)
                    JOIN acounts USING(acount_id)
                    
                    WHERE MONTH(date) = '{$data['bulan']}' AND YEAR(date)='{$data['tahun']}' AND tenan_id=$id
					GROUP BY MONTH(date) ORDER BY date ASC";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function cekBulananTotalTerbaru($id)
    {
        $query = "SELECT tenan.name nama_tenan, acounts.name namapengelola, transaction_id, date, MONTH(date) bulan, YEAR(date) tahun, FORMAT(SUM((price*quantity)),0) total_bulan, tenan_id FROM transactions
					JOIN items USING(transaction_id)
					JOIN tenan USING(tenan_id)
                    JOIN acounts USING(acount_id)
                    
                    WHERE MONTH(date) = 
                    (
                    SELECT MONTH(date) FROM transactions
					JOIN items USING(transaction_id)
					JOIN tenan USING(tenan_id)
                    JOIN acounts USING(acount_id)
                    
                    WHERE tenan_id=$id
					ORDER BY date DESC LIMIT 0,1
                    )
                    AND YEAR(date)=
                    (
                    SELECT YEAR(date) FROM transactions
					JOIN items USING(transaction_id)
					JOIN tenan USING(tenan_id)
                    JOIN acounts USING(acount_id)
                    
                    WHERE tenan_id=$id
					ORDER BY date DESC LIMIT 0,1
                    )
                    AND tenan_id=$id
					GROUP BY MONTH(date) ORDER BY date ASC";
        $this->db->query($query);
        return $this->db->resultSet();
    }


    // Cek data Tenan Bulanan
    public function cekTahunanDetail($data, $id)
    {
        $query = "SELECT tenan.name nama_tenan, transaction_id, MONTH(date) bulan, YEAR(date) tahun, FORMAT(SUM((price*quantity)),0)  total_tahun, tenan_id FROM transactions
					JOIN items USING(transaction_id)
					JOIN tenan USING(tenan_id)
                    
                    WHERE YEAR(date)='{$data['tahun']}' AND tenan_id=$id
					GROUP BY MONTH(date) ORDER BY date ASC ";
        $this->db->query($query);
        return $this->db->resultSet();
    }
}
