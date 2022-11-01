<?php

class Profil_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getProfil()
    {
        $this->db->query("SELECT * FROM `acounts` WHERE name='$_SESSION[name]'");
        return $this->db->resultSet();
    }


    public function ubahDataProfil($data, $id)
    {
        if ($data['password'] == '' || $data['password'] == null) {
            $query = "UPDATE `acounts` 
                    SET 
                    name=:name, 
                    username=:username
                    WHERE acount_id=:acount_id
                        ";
            $this->db->query($query);
        } else {
            $data['password'] = Bunlib::generatePassword($data['password']);
            $query = "UPDATE `acounts` 
                    SET 
                    name=:name, 
                    username=:username, 
                    password=:password
                    WHERE acount_id=:acount_id
                        ";
            $this->db->query($query);
            $this->db->bind('password', $data['password']);
        }
        $this->db->bind('name', $data['name']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('acount_id', $id);
        if ($this->db->execute()) {
            $_SESSION['name'] = $data['name'];
        }
        return $this->db->rowCount();
    }
}