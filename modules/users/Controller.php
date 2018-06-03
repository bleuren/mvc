<?php

namespace modules\users;

use core\Model;
use core\Controller as CoreController;
use modules\users\Method as users;

class Controller extends CoreController
{
    protected $method;

    public function __construct(Model $method)
    {
        $this->users = $method;
    }
    protected function index(): void
    {
        $view = $this->view;
        if (!empty($_SESSION['user'])) {
            $view->setVar('content', 'modules/users/templates/cpanel.tpl.php');
        } else {
            $ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
            $view->setVar('siteKey', SITE_KEY);
            $view->setVar('referer', $ref);
            $view->setVar('content', 'modules/users/templates/login.tpl.php');
        }
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function fail(): void
    {
        $reason = $this->getQuery('r');
        $view = $this->view;
        $view->setVar('reason', $reason);
        $view->setVar('content', 'modules/users/templates/fail.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function signup(): void
    {
        $view = $this->view;
        $view->setVar('content', 'modules/users/templates/signup.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function doSignup(): void
    {
        $data = array('username' => $this->postQuery('username'),
                    'password' => $this->postQuery('password'),
                    'name' => $this->postQuery('name'),
                    'gender' => $this->postQuery('gender'),
                    'birthday' => $this->postQuery('birthday'),
                    'email' => $this->postQuery('email'),
                    'address' => $this->postQuery('address'),
                    'telephone' => $this->postQuery('telephone'),
                    'photo' => 'modules/users/templates/images/default-user-image.png',
                    'role' => 1
                    );            
        $this->users->add($data);
        $this->redirectTo('index.php?mod=users&act=success');
    }
    protected function dologin(): void
    {
        $username = $this->postQuery('username');
        $password = $this->postQuery('password');
        $captcha = $this->postQuery('g-recaptcha-response');
        $csrf = $this->postQuery('csrf');
        if ($msg = $this->users->login($username, $password, $captcha, $csrf)) {
            $this->redirectTo('index.php');
        } else {
            $view = $this->view;
            $view->setVar('errorCodes', $msg);
            $view->setVar('content', 'modules/users/templates/fail.tpl.php');
            $view->render(TEMPLATE_DIR.'index.tpl.php');
        }
    }
    protected function logout(): void
    {
        $this->users->logout();
        $ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
        $this->redirectTo($ref);
    }
    public function __destruct()
    {
    }
}
