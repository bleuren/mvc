<?php

namespace modules\users;

use core\Model;
use core\MySQL;

class Method extends Model
{
    public function __construct()
    {
        $this->table = new MySQL('users');
    }
    public function current_protocol()
    {
        $protocol = 'http';
        if (array_key_exists('HTTPS', $_SERVER) && $_SERVER['HTTPS'] === 'on') {
            $protocol = 'https';
        }

        return $protocol;
    }
    //------------------------------------------------------------------------
    public function current_has_ssl()
    {
        return $this->current_protocol() == 'https';
    }
    //------------------------------------------------------------------------
    public function force_https()
    {
        if ($this->current_has_ssl() == false) {
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: ./index.php');
            exit;
        }
    }
    public function login($username, $password, $captcha, $csrf)
    {
        
        $secret = SECRET;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $token = count($_SESSION['csrf']) > 1 ? $_SESSION['csrf'][count($_SESSION['csrf']) - 2] : null;
            if (!isset($_SESSION['csrf']) || $token !== $csrf) {
                unset($_SESSION['csrf']);
                die('CSRF attack');
            }
            $recaptcha = new \ReCaptcha\ReCaptcha($secret);
            $resp = $recaptcha->verify($captcha, $_SERVER['REMOTE_ADDR']);
            if ($resp->isSuccess() && $this->verify($username, $password)) {
                return true;
            } else {
                return $resp->getErrorCodes();
            }
            unset($_SESSION['csrf']);
        }
        die('Do not refresh this page!');
    }
    public function verify($username, $password)
    {
        $result = $this->table->sql('SELECT * FROM users WHERE username=:username AND password=:password', array(':username' => $username, ':password' => $password));
        $result = $result->fetch(\PDO::FETCH_OBJ);
        if ($result != false) {
            $_SESSION['user'] = $result;
            $_SESSION['user']->IsAuthorized = true;
            unset($_SESSION['user']->password);
            $result = true;
        }

        return $result;
    }
    public function logout()
    {
        unset($_SESSION['user']);

        return false;
    }
    public function name($id)
    {
        $obj = $this->table->find($id);
        if (empty($obj)) {
            $obj = new stdClass();
            $obj->name = 'ERR_NAME';
        }

        return $obj->name;
    }
    public function __destruct()
    {
        $this->table = null;
    }
}
