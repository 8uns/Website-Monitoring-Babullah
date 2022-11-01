<?php

class Administrator_model
{
    private $table = 'administrators';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getAllAdmin()
    {
        $this->db->query("SELECT alamat_id, administrator_id, name, username, password, levels, alamat.nama alamat FROM `administrators` LEFT JOIN alamat USING(alamat_id)");
        return $this->db->resultSet();
    }
    public function tambahDataAdministrator($data)
    {
        $data['password'] = md5($data['password']);
        $query = "INSERT INTO `administrators` 
                    (name, username, levels, password, alamat_id) 
                        VALUES
                        (:name, :username, :levels, :password, :alamat_id)";
        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('levels', $data['levels']);
        $this->db->bind('alamat_id', $data['alamat_id']);
        $this->db->bind('password', $data['password']);

        $this->db->execute();
        return $this->db->rowCount();
    }
    public function getAdministratorById($id)
    {
        $this->db->query("SELECT * FROM `administrators` WHERE administrator_id=:id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }
    public function ubahDataAdministrator($data, $id)
    {
        if ($data['password'] == '' || $data['password'] == null) {
            $query = "UPDATE `administrators` 
                    SET 
                    name=:name, 
                    username=:username,
                    levels=:levels,
                    alamat_id=:alamat_id
                    WHERE administrator_id=:administrator_id
                        ";
            $this->db->query($query);
        } else {
            $data['password'] = md5($data['password']);
            $query = "UPDATE `administrators` 
                    SET 
                    name=:name, 
                    username=:username, 
                    password=:password,
                    levels=:levels,
                    alamat_id=:alamat_id
                    WHERE administrator_id=:administrator_id
                        ";
            $this->db->query($query);
            $this->db->bind('password', $data['password']);
        }

        $this->db->bind('name', $data['name']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('levels', $data['levels']);
        $this->db->bind('alamat_id', $data['alamat_id']);
        $this->db->bind('administrator_id', $id);

        $this->db->execute();
        $_SESSION['name'] = $data['name'];

        return $this->db->rowCount();
    }

    public function hapusDataAdministrator($id)
    {
        $query = "DELETE FROM `administrators` WHERE administrator_id=:administrator_id";
        $this->db->query($query);
        $this->db->bind('administrator_id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
