<html>
    <head><title>自動安裝系統</title></head>
    <body>
        <h3>Bleu Framework自動安裝程序</h3>
        <span>請完成下列設定，系統將會自動幫您建立資料庫。</span>
		<ul>
		<li>安裝前請先確認目錄權限為777(chmod 777 .)</li>
		<li>確認沒有同名資料庫</li>
		<li>程序結束後請依照指示刪除安裝資料，並且將目錄權限改為755</li>
		<li>設定upload資料夾權限為777(chmod -R 777 ./uploads)</li>
		</ul>
        <form method="POST" action="install.php">
            資料庫位置: <input type="text" name="dbhost" value="localhost" /></br>
            資料庫名稱: <input type="text" name="dbname" value="1019" /></br>
            管理員帳號: <input type="text" name="dbuser" value="admin" /></br>
            管理員密碼: <input type="password" name="dbpass" value="" /></br>
            後台帳號: <input type="text" name="cpuser" value="admin" /></br>
            後台密碼: <input type="password" name="cppass" value="" /></br>
			顯示語言: <input type="text" name="lang" value="en" /></br>				
            資料表前綴: <input type="text" name="prefix" value="暫不支援此功能" disabled="disabled"/></br>
            <input type="submit" />
        </form>
    </body>
</html>
<?php 
$dbhost = postQuery('dbhost');
$dbname = postQuery('dbname');
$dbuser = postQuery('dbuser');
$dbpass = postQuery('dbpass');
$lang = postQuery('lang');
$appname = 'MyApp';
$prefix = '';
$succeed = true;
$file_sample = 'install/config.sample.php';
$file_install = 'install.php';
$file_config = 'config.php';
$str = '';
chmod('.', 0777);
echo '開始讀取檔案...</br>';
if (file_exists($file_sample)) {
    $file = fopen($file_sample, 'r');
    if ($file != null) {
        echo '設定參數中</br>';
        while (!feof($file)) {
            $line = fgets($file);
            $line = str_replace('@host', $dbhost, $line);
            $line = str_replace('@database', $dbname, $line);
            $line = str_replace('@username', $dbuser, $line);
            $line = str_replace('@password', $dbpass, $line);
            $line = str_replace('@prefix', $prefix, $line);
            $line = str_replace('@lang', $lang, $line);
            $str .= $line;
        }
        fclose($file);
    }
}
echo '開始寫入檔案...</br>';
if (file_exists($file_config)) {
    echo '發現已有config設定檔，執行刪除</br>';
    if (unlink($file_config)) {
        echo '刪除config.php成功</br>';
    } else {
        $succeed = false;
        echo '刪除失敗，嘗試執行覆寫</br>';
    }
}
$file = fopen($file_config, 'a+');
if (($file = fopen($file_config, 'r+')) !== false) {
    echo '寫入資料中...</br>';
    fwrite($file, $str);
    fclose($file);
} else {
    $succeed = false;
    echo '請確認目錄是否為可寫入</br>';
}
try {
    $conn = new PDO('mysql:host='.$dbhost, $dbuser, $dbpass);
    $conn->exec("CREATE DATABASE `{$dbname}` CHARACTER SET utf8 COLLATE utf8_general_ci;");
    $conn->exec("USE `{$dbname}`;");
} catch (PDOException $e) {
    die($e->getMessage());
}
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
function postQuery($name, $default = null)
{
    if (isset($_POST[$name]) && is_array($_POST[$name])) {
        foreach ($_POST[$name] as $i => $v) {
            $content[$i] = isset($_POST[$name][$i]) ? $_POST[$name][$i] : die;
        }
    } else {
        $content = isset($_POST[$name]) ? $_POST[$name] : die;
    }

    return $content;
}
function creatTable($name, $query)
{
    global $prefix;
    queryMysql("CREATE TABLE IF NOT EXISTS {$prefix}{$name}({$query})");
    echo "Table '{$prefix}{$name}' created or already exists.<br>";
}
function queryMysql($sql, $params = null)
{
    global $conn;
    $query = null;
    try {
        $query = $conn->prepare($sql);
        $query->execute($params);
    } catch (PDOException $e) {
        die($e->getMessage());
    }

    return $query;
}
function save($table, $data)
{
    global $prefix, $conn;
    try {
        $col = null;
        $key = null;
        $val = null;
        foreach ($data as $name => $value) {
            $col = $col.'`'.$name.'`,';
            $key = $key.':'.$name.',';
            $val = $val.$value.',';
            $format_data[':'.$name] = $value;
        }
        $col = substr($col, 0, -1);
        $key = substr($key, 0, -1);
        $val = substr($val, 0, -1);
        $sql = "INSERT IGNORE INTO `{$prefix}{$table}` ({$col}) VALUES ({$key})";
        $query = $conn->prepare($sql);
        $query->execute($format_data);
        echo "Insert {$prefix}{$table} value".json_encode($data).'<br>';
    } catch (PDOException $e) {
        die($e->getMessage());
    }

    return $value;
}
echo '建立資料表</br>';
creatTable('activities', '`id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `url` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)');
creatTable('articles', '`id` int(5) NOT NULL AUTO_INCREMENT,
  `category` text NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `file1` text,
  `file2` text,
  `file3` text,
  `author` int(5) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)');
creatTable('articles_group', '`id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)');
creatTable('articles_file', '`articles_id` int(5) NOT NULL AUTO_INCREMENT,
  `path` varchar(100) NOT NULL,
  PRIMARY KEY (`articles_id`,`path`)');
creatTable('downloads', '`id` int(5) NOT NULL AUTO_INCREMENT,
  `group` varchar(20) NOT NULL,
  `name` text NOT NULL,
  `path` text NOT NULL,
  `author` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group` (`group`)');
creatTable('downloads_group', '`id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)');
creatTable('links', '`id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `url` varchar(100) NOT NULL,
  `logo` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)');
creatTable('members', '`id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(20) NOT NULL,
  `title` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `photo` text NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` text NOT NULL,
  `work` text,
  PRIMARY KEY (`id`)');
creatTable('pages', '`id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `content` text,
  `url` text,
  `uid` int(5) NOT NULL,
  `display` int(1) NOT NULL DEFAULT \'1\',
  `upd_dte` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  PRIMARY KEY (`id`)');
creatTable('shop_allpay', '`MerchantID` varchar(10) NOT NULL,
  `MerchantTradeNo` varchar(20) NOT NULL,
  `RtnCode` int(10) NOT NULL,
  `TradeNo` varchar(20) NOT NULL,
  `TradeAmt` int(10) NOT NULL,
  `PayAmt` int(10) NOT NULL,
  `PaymentDate` varchar(20) NOT NULL,
  `PaymentType` varchar(20) NOT NULL,
  `TradeDate` varchar(20) NOT NULL,
  `SimulatePaid` tinyint(4) NOT NULL,
  PRIMARY KEY (`MerchantTradeNo`)');
creatTable('shop_categories', '`id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `desc` text NOT NULL,
  PRIMARY KEY (`id`)');
creatTable('shop_cate_prod', '`cate_id` int(5) NOT NULL,
  `prod_id` int(5) NOT NULL,
  PRIMARY KEY (`cate_id`,`prod_id`)');
creatTable('shop_orderdetails', '`oid` int(14) NOT NULL,
  `pid` int(5) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT \'1\',
  `SKU` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`oid`,`pid`)');
creatTable('shop_orders', '`id` varchar(20) NOT NULL,
  `uid` int(5) NOT NULL,
  `name` varchar(32) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(32) NOT NULL,
  `orderDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `trackingNumber` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)');
creatTable('shop_products', '`id` varchar(32) NOT NULL,
  `cid` int(5) NOT NULL,
  `name` varchar(32) NOT NULL,
  `desc` text,
  `cost` int(8) NOT NULL DEFAULT \'0\',
  `price` int(8) NOT NULL,
  `discount` int(3) NOT NULL DEFAULT \'100\',
  `thumb` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `updateDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stock` int(5) NOT NULL DEFAULT \'0\',
  `available` tinyint(4) NOT NULL DEFAULT \'0\',
  PRIMARY KEY (`id`)');
creatTable('shop_prod_type', '`id` varchar(32) NOT NULL,
  `pid` varchar(32) NOT NULL,
  `name` text NOT NULL,
  `stock` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`pid`)');
creatTable('sidebar', '`id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `url` text NOT NULL,
  `target` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)');
creatTable('users', '`id` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` varchar(32) NOT NULL,
  `identifier` varchar(32) DEFAULT NULL,
  `token` varchar(32) DEFAULT NULL,
  `timeout` int(10) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `gender` varchar(2) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `address` text,
  `tel` varchar(10) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `reg_dte` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` int(2) NOT NULL DEFAULT \'0\',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)');
creatTable('weeks', '`id` int(5) NOT NULL AUTO_INCREMENT,
  `year` year(4) NOT NULL,
  `month` int(2) NOT NULL,
  `week` int(2) NOT NULL,
  `file` text NOT NULL,
  `author` int(5) NOT NULL,
  PRIMARY KEY (`id`)');
echo '寫入初始化資料</br>';
save('pages', array('id' => 1, 'name' => 'DONT DELETE THIS!', 'uid' => '1', 'display' => 0, 'lft' => 1, 'rgt' => 2));
if (ctype_alnum($_POST['cpuser']) && isset($_POST['cppass'])) {
    save('users', array('username' => $_POST['cpuser'], 'password' => $_POST['cppass'], 'identifier' => 'a6250babcd2ca4720ef30ab6ad4d4394', 'token' => 'afac31073cd2d772f54bdec38db1c203', 'timeout' => null, 'name' => 'Administrator', 'gender' => 'M', 'birthday' => '1992-04-21', 'address' => '台灣', 'tel' => '0982831424', 'email' => 'paste.ren@gmail.com', 'ip' => $_SERVER['REMOTE_ADDR'], 'reg_dte' => '2014-01-19 22:34:10', 'role' => 99));
}

save('users', array('username' => 'test', 'password' => 'test', 'identifier' => 'a6250babcd2ca4720ef30ab6ad4d4394', 'token' => 'afac31073cd2d772f54bdec38db1c203', 'timeout' => null, 'name' => 'Test', 'gender' => 'M', 'birthday' => '1992-04-21', 'address' => '台灣', 'tel' => '0982831424', 'email' => '10461115@gm.nfu.edu.tw', 'ip' => $_SERVER['REMOTE_ADDR'], 'reg_dte' => '2014-01-19 22:34:10', 'role' => 1));
if (rename($file_install, $new = md5(time()).'.php.bak')) {
    echo "自動更改檔名 {$file_install} 為 {$new}</br>";
} else {
    $succeed = false;
    echo '修改設定檔config.sample.php失敗，請確認目錄權限是否為可寫入</br>';
}
if (file_exists($file_install)) {
    $succeed = false;
    echo '基於安全性問題，請修改或刪除目錄下install.php，並將目錄權限改為755</br>';
}
if ($succeed) {
    echo '<a href=\'index.php\'>恭喜您! 系統已完成設定，請點此進入網站!</a>';
} else {
    echo '安裝失敗，請修改設定重新安裝!';
}
