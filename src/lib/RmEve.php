<?php


namespace RmTop\RmSystemInstall\lib;


use PDO;
use PDOException;

class RmEve
{


    /**
     * 检查连接是否可用
     * @param $dbconn  数据库连接
     * @return bool
     */
    function topPdoCheck($dbconn): bool
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


}