<?php

namespace RmTop\RmCmsService\lib;

use PDO;
use PDOStatement;
use think\db\exception\PDOException;

/**
 * 数据库操作
 * Class RmDb
 * @package RmTop\RmSystemInstall\lib
 */
class RmDb
{

    // 保存数据库连接
    private static $mysql_instance = null;

    // 连接数据库
    public static function get_mysql_conn($config): ?\PDO
    {
        if(isset(self::$mysql_instance) && !empty(self::$mysql_instance)){
            return self::$mysql_instance;
        }
        $dbhost = $config['host'];
        $dbname = $config['dbname'];
        $dbport = $config['port']??'3306';
        $dbuser = $config['user'];
        $dbpasswd = $config['password'];
        $pconnect = $config['pconnect'];
        $charset = $config['charset'];
        $dsn = "mysql:host=$dbhost;port=$dbport;dbname=$dbname;";
        try {
            $h_param = array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            );
//            if ($charset != '') {
//                $h_param[\PDO::MYSQL_ATTR_INIT_COMMAND] = 'SET NAMES ' . $charset; //設置默認編碼
//            }
            if ($pconnect) {
                $h_param[\PDO::ATTR_PERSISTENT] = true;
            }
            $conn = new \PDO($dsn, $dbuser, $dbpasswd, $h_param);
        } catch (\PDOException $e) {
            throw new \ErrorException('Unable to connect to db server. Error:' . $e->getMessage(), 31);
            //return false;
        }
        self::$mysql_instance = $conn;
        return $conn;
    }





    // 执行查询

    public static function query($dbconn, $sqlstr, $condparam){
        $sth = $dbconn->prepare($sqlstr);
        try{
            $sth->execute($condparam);
        } catch (\PDOException $e) {
            echo $e->getMessage().PHP_EOL;
        }
        $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    // 重置连接
    public static function reset_connect(){
        self::$mysql_instance = null;
    }



    /**
     * 确认数据库
     * @param $config
     * @return bool
     */
    static function check_db($config)
    {
        // 创建数据连接
        $host = $config['host'];
        $dbname = $config['dbname'];
        $port = $config['port']??'3306';
        $user = $config['user'];
        $password = $config['password'];

        $pdoConn = new \PDO("mysql:host=$host;port=$port", $user, $password);
        $query = $pdoConn->prepare("SHOW TABLES FROM $dbname")->execute();
        // 判断连接是否有效
        $status = self::pdo_ping($pdoConn);
        if ($status) {
            $query = $pdoConn->prepare("SHOW TABLES FROM $dbname")->execute();
            $pdoConn = null;
            if (!$query) {
                return true;
            }
            return false;
        } else {
            $pdoConn = null;
            return false;
        }
    }



    /**
     **
     * 检查连接是否可用
     * @param Link $dbconn 数据库连接
     * @return Boolean
     */

   static  function pdo_ping($dbconn): bool
   {
        try {
            $dbconn->getAttribute(PDO::ATTR_SERVER_INFO);
        } catch (PDOException $e) {
            if (strpos($e->getMessage(), 'MySQL server has gone away') !== false) {
                return false;
            }


        }
        return true;

    }



    static function resMsg($s, $title, $content, $flag = true)
    {
        if ($flag) {
            $cs = 'i-success';
            $csfa = 'fa fa-check';
        } else {
            $cs = 'i-error';
            $csfa = 'fa fa-times';
        }
        $msg = '<li class="' . $cs . '"><span class="i-step">【第' . $s[0] . '步】</span>  <i><span class="i-title">##' . $title . '##</span> </i>  <span class="i-content">' . $s[0] . '-' . $s[1] . '------' . $content . '------   [<i class="' . $csfa . '" aria-hidden="true"></i>] </span> <i class="i-time">' . date('Y-m-d H:i:s') . '</i></li>';
        return $msg;
    }




}