<?php
// 07.01.2025 (c) Alexander Livanov

class Database
{
    function fetchAllData($db_name)
    {
        global $db_connect;
        $query = $db_connect->prepare("SELECT * FROM $db_name");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}

class User
{
    private function getDataByID($id)
    {
        global $db_connect;
        $query = $db_connect->prepare("SELECT * FROM users WHERE id=" . $id);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    private function getDataByParam($param, $data)
    {
        global $db_connect;
        $query = $db_connect->prepare("SELECT * FROM users WHERE $param='$data'");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    private function setDataByID($id, $field_name, $data)
    {
        global $db_connect;
        $query = $db_connect->prepare("UPDATE users SET $field_name = '$data' WHERE id = $id");
        $query->execute();
    }

    function getRole($id)
    {
        $result = $this->getDataByID($id);

        return $result['role'];
    }

    function getID($username)
    {
        $result = $this->getDataByParam('username', $username);

        return $result['id'];
    }

    function getUsername($id)
    {
        $result = $this->getDataByID($id);

        return $result['username'];
    }

    function setUsername($id, $data)
    {
        return $this->setDataByID($id, 'username', $data);
    }

    function getLastActivity($id)
    {
        return $this->getDataByID($id)['last_activity'];
    }

    function getUserRating($id)
    {
        return $this->getDataByID($id)['rating'];
    }

    function getRegDate($id)
    {
        return $this->getDataByID($id)['reg_date'];
    }

    function getServerTime()
    {
        return date('d.m.Y H:i', time());
    }

    function updateLastActivityTime($id)
    {
        return $this->setDataByID($id, 'last_activity', getServerTime());
    }

    function findUserByToken($tokenHash)
    {
        global $db_connect;
        $query = $db_connect->prepare("SELECT * FROM users WHERE token='" . hash('sha256', $tokenHash) . "'");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        // print_r($result);
        return $result['id'];
    }

    function auth()
    {
        global $uid;
        if (!empty($_COOKIE['AUTH_TOKEN'])) {
            $_SESSION['uid'] = $this->findUserByToken($_COOKIE['AUTH_TOKEN']);
            $uid = $_SESSION['uid'];
            return true;
        } else {
            return false;
        }
    }
}
