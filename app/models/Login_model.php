<?php

class Login_model
{

    private $db;
    private $bunlib;

    public function __construct()
    {
        $this->db = new Database;
        $this->bunlib = new Bunlib;
    }

    public function loginApi($username, $password)
    {
        $value = false;
        $data['password'] = $this->bunlib->generatePassword($password);
        $data['username'] = $username;
        $query = "SELECT acounts.name name, username, token, acount_id, tenan.name tenan, tenan_id, levels, password, contract_period FROM acounts JOIN tenan USING(acount_id)";
        $this->db->query($query);
        $this->db->execute();
        $dataMember = $this->db->resultSet();
        $this->db->close();

        foreach ($dataMember as $user) {
            if ($user['username'] == $data['username'] && $user['password'] == $data['password']) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['acount_id'] = $user['acount_id'];
                $_SESSION['image'] = '';
                $_SESSION['tenan'] = $user['tenan'];
                $_SESSION['level'] = $user['levels'];
                $_SESSION['token'] = $user['token'];
                $_SESSION['tenan_id'] = $user['tenan_id'];
                $_SESSION['contract_period'] = $user['contract_period'];
                $value = $_SESSION;
            }
        }
        return $value;
    }

    // public function loginMember($data)
    // {
    //     $value = false;
    //     $data['password'] = md5(Bunlib::generatePassword($data['password']));
    //     $query = "SELECT * FROM participants";
    //     $this->db->query($query);
    //     $this->db->execute();
    //     $dataMember = $this->db->resultSet();
    //     foreach ($dataMember as $user) {
    //         if ($user['username'] == $data['username'] && $user['password'] == $data['password']) {
    //             $_SESSION['id'] = $user['participant_id'];
    //             $_SESSION['username'] = $user['username'];
    //             $_SESSION['name'] = $user['name'];
    //             $_SESSION['image'] = $user['image'];
    //             $_SESSION['level'] = 5;

    //             $value = true;
    //         }
    //     }
    //     return $value;
    // }

    public function loginAdmin($data)
    {
        $value = false;
        $data['password'] = Bunlib::generatePassword($data['password']);
        $query = "SELECT * FROM acounts";
        $this->db->query($query);
        $this->db->execute();
        $dataMember = $this->db->resultSet();
        $this->db->close();


        foreach ($dataMember as $user) {
            if ($user['username'] == $data['username'] && $user['password'] == $data['password']) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['name'] =  $user['name'];
                $_SESSION['admin_id'] = $user['acount_id'];
                $_SESSION['image'] = '';
                $_SESSION['level'] = $user['levels'];
                $_SESSION['token'] = $user['token'];
                $value = true;
            }
        }
        return $value;
    }

    public function login($data)
    {
        return $this->loginAdmin($data);
    }
}
