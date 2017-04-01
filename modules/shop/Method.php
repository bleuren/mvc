<?php

/* ======================================== */
// Bleu Framework 購物車模組 1.00
// 系統框架開發 : 任家輝
// paste.ren@gmail.com
// Copyright © 2014 Jia-Huei Ren & DivStudio. All rights reserved
// 初次進入請先修改config.php檔案
// 請勿刪除此段版權宣告，否則依法追究
/* ======================================== */

namespace modules\shop;

use core\Model;
use core\MySQL;

include 'libs/AllPay.Payment.Integration.php';
class Method extends Model
{
    public function __construct()
    {
        define('NO_FREIGHT', 2000);
        define('FREIGHT', 60);
        $this->cate = new MySQL('shop_categories');
        $this->prod = new MySQL('shop_products');
        $this->type = new MySQL('shop_prod_type');
        $this->order = new MySQL('shop_orders');
        $this->cate_prod = new MySQL('shop_cate_prod');
        $this->orderdetail = new MySQL('shop_orderdetails');
        $this->allpay = new MySQL('shop_allpay');
        //$this->prod->link->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
    }
    public function total($cart)
    {
        $obj = isset($cart) ? $cart : array();
        $total = 0;
        foreach ($obj as $i => $v) {
            $total += $v->price * $v->quantity;
        }

        return (int) $total;
    }
    public function freight($cart)
    {
        $total = $this->total($cart);

        return (int) ($total < NO_FREIGHT && $total != 0) ? FREIGHT : 0;
    }
    public function pay($MerchantTradeNo, $items, $desc = null)
    {
        try {
            //125.231.116.68/mvc/bleuc/index.php?mod=shop&act=pay
            //localhost/mvc/bleuc/index.php?mod=shop&act=pay
            $obj = new AllInOne();
            //服務參數
            // $obj->ServiceURL  = "https://payment.allpay.com.tw/Cashier/AioCheckOut/V2";   //服務位置
            // $obj->HashKey     = 'RsSu2ZYVAYELlSLG' ;
            // $obj->HashIV      = 'ZNtGNTHWhBaN25qe' ;
            // $obj->MerchantID  = '1419894';
            //服務參數
            $obj->ServiceURL = 'https://payment-stage.allpay.com.tw/Cashier/AioCheckOut/V2';
            //服務位置
            $obj->HashKey = '5294y06JbISpM5x9';
            //測試用Hashkey，請自行帶入AllPay提供的HashKey
            $obj->HashIV = 'v77hoKGq4kWxNNIS';
            //測試用HashIV，請自行帶入AllPay提供的HashIV
            $obj->MerchantID = '2000132';
            //測試用MerchantID，請自行帶入AllPay提供的MerchantID
            $total = 0;
            foreach ($items as $i => $v) {
                $total = $total + $v->price * $v->quantity;
            }
            $freight = $total < NO_FREIGHT && $total != 0 ? FREIGHT : 0;
            //基本參數(請依系統規劃自行調整)
            $obj->Send['ReturnURL'] = 'http://125.231.116.68/mvc/bleuc/index.php?mod=shop&act=check';
            //付款完成通知回傳的網址
            $obj->Send['MerchantTradeNo'] = $MerchantTradeNo;
            //訂單編號
            $obj->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');
            //交易時間
            $obj->Send['TotalAmount'] = (int) $total + $freight;
            //交易金額
            $obj->Send['TradeDesc'] = $desc;
            //交易描述
            $obj->Send['ChoosePayment'] = PaymentMethod::ALL;
            //付款方式:ALL
            $obj->Send['IgnorePayment'] = 'Tenpay#TopUpUsed#CVS#BARCODE#ATM';
            //訂單的商品資料
            foreach ($items as $i => $item) {
                array_push($obj->Send['Items'], array('Name' => $item->name, 'Price' => (int) $item->price, 'Currency' => '元', 'Quantity' => (int) $item->quantity, 'URL' => 'div.tw'));
            }
            if ($freight > 0) {
                array_push($obj->Send['Items'], array('Name' => '運費', 'Price' => (int) $freight, 'Currency' => '元', 'Quantity' => (int) 1));
            }
            //ATM 延伸參數(可依系統需求選擇是否代入)
            $obj->SendExtend['ExpireDate'] = 1;
            //繳費期限 (預設3天，最長60天，最短1天)
            $obj->SendExtend['PaymentInfoURL'] = '';
            //伺服器端回傳付款相關資訊。
            // 電子發票參數
            /*
            $obj->Send['InvoiceMark'] = InvoiceState::Yes;
            $obj->SendExtend['RelateNumber'] = $MerchantTradeNo;
            $obj->SendExtend['CustomerEmail'] = 'test@allpay.com.tw';
            $obj->SendExtend['CustomerPhone'] = '0911222333';
            $obj->SendExtend['TaxType'] = TaxType::Dutiable;
            $obj->SendExtend['CustomerAddr'] = '台北市南港區三重路19-2號5樓D棟';
            $obj->SendExtend['InvoiceItems'] = array();
            // 將商品加入電子發票商品列表陣列
            foreach ($obj->Send['Items'] as $info)
            {
                array_push($obj->SendExtend['InvoiceItems'],array('Name' => $info['Name'],'Count' =>
                    $info['Quantity'],'Word' => '個','Price' => $info['Price'],'TaxType' => TaxType::Dutiable));
            }
            $obj->SendExtend['InvoiceRemark'] = '測試發票備註';
            $obj->SendExtend['DelayDay'] = '0';
            $obj->SendExtend['InvType'] = InvType::General;
            */
            //產生訂單(auto submit至AllPay)
            $html = $obj->CheckOut();
            echo $html;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function addCart($uid, $pid, $quantity)
    {
        $uid = htmlspecialchars($uid);
        $pid = htmlspecialchars($pid);
        $quantity = htmlspecialchars($quantity);
        $arr = array();
        $cart = new \stdClass();
        $cart->pid = $pid;
        $cart->quantity = (int) $quantity;
        $result = $this->prod->find($pid);
        $cart->cost = (int) $result->cost;
        $cart->price = (int) ($result->price * $result->discount / 100);
        $cart->name = $result->name;
        $cart->stock = (int) $result->stock - (int) $quantity;
        $cart->quantity = (int) $quantity;
        $cart->total = (int) $cart->price * (int) $cart->quantity;
        if ($quantity > 0 && $cart->quantity > 0) {
            if (isset($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $i => $v) {
                    if (isset($v->pid) && $v->pid == $pid) {
                        $_SESSION['cart'][$i]->quantity += $quantity;
                        $_SESSION['cart'][$i]->total += $cart->total;
                        $total = 0;
                        foreach ($_SESSION['cart'] as $v) {
                            $total += $v->total;
                        }

                        return;
                    }
                }
                array_push($_SESSION['cart'], $cart);
            } else {
                array_push($arr, $cart);
                $_SESSION['cart'] = $arr;
            }
        } else {
            die('存貨不足或輸入數量不為正整數');
        }
    }
    public function delCart($id)
    {
        unset($_SESSION['cart'][$id]);
    }
    public function check($MerchantID, $MerchantTradeNo, $RtnCode, $TradeNo, $TradeAmt, $PayAmt, $PaymentDate, $PaymentType, $TradeDate, $SimulatePaid)
    {
        $this->allpay->save(array('MerchantID' => $MerchantID, 'MerchantTradeNo' => $MerchantTradeNo, 'RtnCode' => $RtnCode, 'TradeNo' => $TradeNo, 'TradeAmt' => $TradeAmt, 'PayAmt' => $PayAmt, 'PaymentDate' => $PaymentDate, 'PaymentType' => $PaymentType, 'TradeDate' => $TradeDate, 'SimulatePaid' => $SimulatePaid));

        return true;
    }
    // 分類
    public function addCate($name, $desc)
    {
        $desc = htmlspecialchars_decode($desc);
        $this->cate->save(array('name' => $name, 'desc' => $desc));

        return true;
    }
    public function allCate()
    {
        return $this->cate->all();
    }
    public function updCate($id, $name, $desc)
    {
        $desc = htmlspecialchars_decode($desc);
        $data = array('name' => $name, 'desc' => $desc);

        return $this->cate->update($data, $id);
    }
    public function delCate($id)
    {
        return $this->cate->delete($id);
    }
    public function addProd($id, $cid, $name, $desc, $cost, $price, $discount, $thumb, $image, $stock, $available, $type)
    {
        $type_tmp = explode('#', $type);
        $type = array();
        $total = 0;
        foreach ($type_tmp as $i => $v) {
            $type[$i] = explode('@', $v);
            $substock = (int) $type[$i][1];
            $total += $substock;
        }
        if ($total !== (int) $stock) {
            die('Substock not equal to total!');
            throw new \Exception('Substock not equal to total!');

            return false;
        } else {
            $desc = htmlspecialchars_decode($desc);
            $this->prod->save(array('id' => $id, 'cid' => $cid, 'name' => $name, 'desc' => $desc, 'cost' => (int) $cost, 'price' => (int) $price, 'discount' => (int) $discount, 'thumb' => $thumb, 'image' => $image, 'stock' => (int) $stock, 'available' => (int) $available));
            foreach ($type_tmp as $i => $v) {
                $type[$i] = explode('@', $v);
                $stock = (int) $type[$i][1];
                $this->type->save(array('id' => $i, 'pid' => $id, 'name' => $type[$i][0], 'stock' => $stock));
            }
        }

        return true;
    }
    public function updProd($id, $cid, $name, $desc, $cost, $price, $discount, $thumb, $image, $stock, $available)
    {
        $desc = htmlspecialchars_decode($desc);
        $data = array('cid' => $cid, 'name' => $name, 'desc' => $desc, 'cost' => (int) $cost, 'price' => (int) $price, 'discount' => (int) $discount, 'thumb' => $thumb, 'image' => $image, 'stock' => (int) $stock, 'available' => $available);

        return $this->prod->update($data, $id);
    }
    public function delProd($id)
    {
        return $this->prod->delete($id);
    }
    public function allProd()
    {
        return $this->prod->all();
    }
    public function showProd($id)
    {
        $product = $this->prod->find($id);
        $product->type = $this->type->sql('SELECT * FROM `shop_prod_type` WHERE pid = :pid', array(':pid' => $id))->fetchAll(\PDO::FETCH_OBJ);

        return $product;
    }
    //訂單
    public function addOrder($uid, $name, $address, $phone, $email, $trackingNumber = null)
    {
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : die;
        $id = date('ymd').str_pad($uid, 5, '0', STR_PAD_LEFT).mt_rand(100, 999);
        $this->order->save(array('id' => $id, 'uid' => $uid, 'name' => $name, 'address' => $address, 'phone' => $phone, 'email' => $email, 'trackingNumber' => $trackingNumber));
        unset($_SESSION['cart']);
        $this->pay($id, $cart, 'desc');

        return true;
    }
    public function updOrder($id, $uid, $name, $address, $phone, $email, $trackingNumber)
    {
        $data = array('uid' => $uid, 'name' => $name, 'address' => $address, 'phone' => $phone, 'email' => $email, 'trackingNumber' => $trackingNumber);

        return $this->order->update($data, $id);
    }
    public function delOrder($id)
    {
        return $this->order->delete($id);
    }
    public function allOrder()
    {
        return $this->order->all();
    }
    public function showOrder($id)
    {
        return $this->order->find($id);
    }
    //訂單細節
    public function addOrderDetail($oid, $pid, $price, $quantity, $SKU)
    {
        $this->orderdetail->save(array('oid' => $oid, 'pid' => $pid, 'price' => (int) $price, 'quantity' => (int) $quantity, 'SKU' => $SKU));

        return true;
    }
    public function updOrderDetail($oid, $pid, $price, $quantity, $SKU)
    {
        $data = array(':oid' => $oid, ':pid' => $pid, ':price' => (int) $price, ':quantity' => (int) $quantity, ':SKU' => $SKU);

        return $this->orderdetail->sql('UPDATE `shop_orderdetails` SET
                                        `price` = :price,
                                        `quantity` = :quantity,
                                        `SKU` = :SKU WHERE `oid` =:oid AND `pid` =:pid;', $data);
    }
    public function delOrderDetail($oid, $pid)
    {
        $data = array(':oid' => $oid, ':pid' => $pid);

        return $this->orderdetail->sql('DELETE FROM `shop_orderdetails` WHERE `oid` = :oid AND `pid` = :pid', $data);
    }
    public function allOrderDetail()
    {
        return $this->orderdetail->all();
    }
    public function showOrderDetail($oid, $pid)
    {
        $data = array(':oid' => $oid, ':pid' => $pid);

        return $this->orderdetail->sql('SELECT * FROM shop_orderdetails WHERE oid = :oid AND pid = :pid', $data);
    }
    //結束
    public function search($keyword)
    {
        $sql = 'SELECT * FROM articles WHERE title LIKE :key OR content LIKE :key OR file1 LIKE :key OR file2 LIKE :key OR file3 LIKE :key';

        return $this->prod->sql($sql, array(':key' => '%'.$keyword.'%'))->fetchAll(\PDO::FETCH_OBJ);
    }
    public function show($id)
    {
        return $this->prod->find($id);
    }
    public function all()
    {
        return array_reverse($this->prod->all());
    }
    public function __destruct()
    {
        $this->prod = null;
    }
}
