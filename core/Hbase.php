<?php

/* ======================================== */
// Bleu Framework 2.00
// 系統框架開發 : 任家輝
// paste.ren@gmail.com
// Copyright © 2014 Jia-Huei Ren & DivStudio. All rights reserved
// 初次進入請先修改config.php檔案
// 請勿刪除此段版權宣告，否則依法追究
/* ======================================== */
use Thrift\Transport\TSocket;
use Thrift\Transport\TBufferedTransport;
use Thrift\Protocol\TBinaryProtocol;
use Hbase\HbaseClient;

class Hbase
{
    public function set()
    {
        $GLOBALS['THRIFT_ROOT'] = APP_REAL_PATH.'/libs/Thrift';
        require_once $GLOBALS['THRIFT_ROOT'].'/Thrift.php';
        require_once $GLOBALS['THRIFT_ROOT'].'/Type/TMessageType.php';
        require_once $GLOBALS['THRIFT_ROOT'].'/Type/TType.php';
        require_once $GLOBALS['THRIFT_ROOT'].'/Exception/TException.php';
        require_once $GLOBALS['THRIFT_ROOT'].'/Factory/TStringFuncFactory.php';
        require_once $GLOBALS['THRIFT_ROOT'].'/StringFunc/TStringFunc.php';
        require_once $GLOBALS['THRIFT_ROOT'].'/StringFunc/Core.php';
        require_once $GLOBALS['THRIFT_ROOT'].'/Transport/TSocket.php';
        require_once $GLOBALS['THRIFT_ROOT'].'/Transport/TBufferedTransport.php';
        require_once $GLOBALS['THRIFT_ROOT'].'/Protocol/TBinaryProtocol.php';
        require_once $GLOBALS['THRIFT_ROOT'].'/packages/Hbase/Hbase.php';
        require_once $GLOBALS['THRIFT_ROOT'].'/packages/Hbase/Types.php';
        try {
            $conn = $GLOBALS['CONNECTIONS']['hbase'];
            $socket = new TSocket($conn['host'], $conn['port']);
            $socket->setSendTimeout($conn['SendTimeout']);
            $socket->setRecvTimeout($conn['RecvTimeout']);
            $this->_transport = new TBufferedTransport($socket);
            $protocol = new TBinaryProtocol($this->_transport);
            $this->_link = new HbaseClient($protocol);

            return $this;
        } catch (Exception $e) {
            echo 'Error!: '.$e->getMessage().'<br />';
        }
    }
}
