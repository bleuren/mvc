<?php

namespace modules\shop;

use core\Model;
use core\Controller as CoreController;
use modules\shop\Method as shop;

class Controller extends CoreController
{
    protected $method;

    public function __construct(Model $method)
    {
        $this->shop = $method;
    }
    protected function index(): void
    {
        $view = $this->view;
        $id = $this->getQuery('id', 0);
        $depth = $this->getQuery('depth', 0);
        $per = $this->getQuery('per', 16);
        $page = $this->getQuery('page', 1);
        $view->setVar('hasRole', $this->hasRole([99]));
        $view->setVar('products', $this->shop->paganation($this->shop->allProd(), $per, $page));
        $view->setVar('content', 'modules/shop/templates/content.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function show(): void
    {
        $id = $this->getQuery('id');
        $obj = $this->shop->showProd($id);
        if ($obj === false) {
            $this->redirectTo('index.php?mod=shop');
        }
        $view = $this->view;
        $view->setVar('hasRole', $this->hasRole([99]));
        $view->setVar('product', $this->shop->showProd($id));
        $view->setVar('content', 'modules/shop/templates/prod/show.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function addCate(): void
    {
        $this->priv([99]);
        $view = $this->view;
        $view->setVar('content', 'modules/shop/templates/cate/add.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function doAddCate(): void
    {
        $this->priv([99]);
        $name = $this->postQuery('name');
        $desc = $this->postQuery('desc');
        $this->shop->addCate($name, $desc);
        $this->redirectTo('./index.php?mod=shop');
    }
    protected function addProd(): void
    {
        $this->priv([99]);
        $view = $this->view;
        $view->setVar('cate', $this->shop->allCate());
        $view->setVar('content', 'modules/shop/templates/prod/add.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function doAddProd(): void
    {
        $this->priv([99]);
        $id = $this->postQuery('id');
        $cid = $this->postQuery('cid');
        $name = $this->postQuery('name');
        $desc = $this->postQuery('desc');
        $cost = $this->postQuery('cost');
        $price = $this->postQuery('price');
        $discount = $this->postQuery('discount');
        $discount = !empty($discount) ? $discount : 100;
        $stock = $this->postQuery('stock');
        $stock = !empty($stock) ? $stock : 0;
        $available = $this->postQuery('available');
        $type = $this->postQuery('type');
        $image = $this->postQuery('image');
        $thumb = $this->postQuery('thumb');
        $this->shop->addProd($id, $cid, $name, $desc, $cost, $price, $discount, $thumb, $image, $stock, $available, $type);
        $this->redirectTo('./index.php?mod=shop');
    }
    protected function addCart(): void
    {
        $this->priv([99, 1]);
        $pid = $this->getQuery('pid');
        $quantity = $this->postQuery('quantity');
        $this->shop->addCart($_SESSION['user']->id, $pid, $quantity);
        $this->redirectTo('./index.php?mod=shop&act=cart');
    }
    protected function delCart(): void
    {
        $this->priv([99, 1]);
        $id = $this->getQuery('id');
        $this->shop->delCart($id);
        $this->redirectTo('./index.php?mod=shop&act=cart');
    }
    protected function cart(): void
    {
        $this->priv([99, 1]);
        $view = $this->view;
        $total = $this->shop->total($this->session('cart', array()));
        $freight = $this->shop->freight($this->session('cart', array()));
        $view->setVar('cart', $this->session('cart', array()));
        $view->setVar('freight', $freight);
        $view->setVar('content', 'modules/shop/templates/cart.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function addOrder(): void
    {
        $this->priv([99, 1]);
        $total = $this->shop->total($this->session('cart', array()));
        $freight = $this->shop->freight($this->session('cart', array()));
        $view = $this->view;
        $view->setVar('freight', $freight);
        $view->setVar('products', $this->session('cart', array()));
        $view->setVar('total', $total + $freight);
        $view->setVar('content', 'modules/shop/templates/addOrder.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function doAddOrder(): void
    {
        $this->priv([99, 1]);
        $name = $this->postQuery('name');
        $address = $this->postQuery('address');
        $phone = $this->postQuery('phone');
        $email = $this->postQuery('email');
        $this->shop->addOrder($this->session('user')->id, $name, $address, $phone, $email);
        $this->redirectTo('./index.php?mod=shop');
    }
    protected function check(): void
    {
        $this->priv([99, 1]);
        $MerchantID = $this->postQuery('MerchantID');
        $MerchantTradeNo = $this->postQuery('MerchantTradeNo');
        $RtnCode = $this->postQuery('RtnCode');
        $TradeNo = $this->postQuery('TradeNo');
        $TradeAmt = $this->postQuery('TradeAmt');
        $PayAmt = $this->postQuery('PayAmt');
        $PaymentDate = $this->postQuery('PaymentDate');
        $PaymentType = $this->postQuery('PaymentType');
        $TradeDate = $this->postQuery('TradeDate');
        $SimulatePaid = $this->postQuery('SimulatePaid');
        $this->shop->check($MerchantID, $MerchantTradeNo, $RtnCode, $TradeNo, $TradeAmt, $PayAmt, $PaymentDate, $PaymentType, $TradeDate, $SimulatePaid);
        $this->redirectTo('./index.php?mod=shop');
    }
    protected function error(): void
    {
        $view = $this->view;
        //74
        $view->setVar('content', 'modules/shop/templates/error.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function success(): void
    {
        $view = $this->view;
        $view->setVar('content', 'modules/shop/templates/success.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    protected function s(): void
    {
        $view = $this->view;
        $this->priv([99, 1]);
        $depth = $this->getQuery('depth', 0);
        $per = $this->getQuery('per', 2);
        $page = $this->getQuery('page', 1);
        $keyword = $this->postQuery('keyword');
        $obj = $this->shop->search($keyword);
        $view->setVar('obj', $this->shop->paganation($obj, $per, $page));
        $view->setVar('content', 'modules/shop/templates/content.tpl.php');
        $view->render(TEMPLATE_DIR.'index.tpl.php');
    }
    public function __destruct()
    {
    }
}
