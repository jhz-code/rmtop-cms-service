<?php


namespace RmTop\RmCmsService\lib;


use PDO;

class RmTemp
{


    /**
     * 导出模板管理数据sql
     */
    static function ExportTempSql($savePath){
        header("Content-type:text/html;charset=utf-8");
        $db  = self::getDbConfig();
        $to_file_name = $savePath.'/'."temp.sql";
        $conn = new \PDO("mysql:host=" . $db['host'] . ";port=" . $db['port'] . "", $db['user'], $db['pass']);
        $connStatus = RmDb::get_mysql_conn($conn);
        $db_isCreated = $connStatus->prepare("SHOW TABLES FROM `" . $db['name'] . "`")->execute();
        //链接数据库
        if($db_isCreated){
        //将这些表记录到一个数组
          $tempSqlArr = [
            'advertise',
            'advertise_group',
            'advertise_group',
            'column',
            'config',
            'config_group',
            'extends_category',
            'extends_params',
            'navs',
            'navs_category',
        ];

        $sqlDump = '';
        $info = "-- ----------------------------\r\n";
        $info .= "-- 日期：".date("Y-m-d H:i:s",time())."\r\n";
        $sqlDump .= $info;

        //将每个表的表结构导出到文件
        foreach($tempSqlArr as $val){
            $sql = "show create table ".$val;
            $ret = $conn->prepare($sql)->execute();
            $row=$ret->fetchAll(PDO::FETCH_ASSOC);
            $info = "-- ----------------------------\r\n";
            $info .= "-- Table structure for `".$val."`\r\n";
            $info .= "-- ----------------------------\r\n";
            $info .= "DROP TABLE IF EXISTS `".$val."`;\r\n";
            $sqlStr = $info.$row[1].";\r\n\r\n";
            //追加到文件
            file_put_contents($to_file_name,$sqlStr,FILE_APPEND);
            $sqldump .= $sqlStr;
            //释放资源
        }

        //将每个表的数据导出到文件
        foreach($tempSqlArr as $val){
            $sql = "select * from ".$db['prefix'].$val;
            $ret = $conn->prepare($sql)->execute();
            $row=$ret->fetchAll(PDO::FETCH_ASSOC);
            //如果表中没有数据，则继续下一张表
            if(count($row)<1) continue;
            //
            $info = "-- ----------------------------\r\n";
            $info .= "-- Records for `".$val."`\r\n";
            $info .= "-- ----------------------------\r\n";
            $sqldump .= $info;
            //file_put_contents($to_file_name,$info,FILE_APPEND);
            //读取数据
            while($row){
                $sqlStr = "INSERT INTO `".$val."` VALUES (";
                foreach($row as $zd){
                    $sqlStr .= "'".$zd."', ";
                }
                //去掉最后一个逗号和空格
                $sqlStr = substr($sqlStr,0,strlen($sqlStr)-2);
                $sqlStr .= ");\r\n";
                $sqldump .= $sqlStr;
                file_put_contents($to_file_name,$sqlStr,FILE_APPEND);
            }
            //释放资源
            $sqlDump .= '\r\n';
            file_put_contents($to_file_name,"\r\n",FILE_APPEND);
        }

        $filename = 'ciblog_'. date('Ymd_His', time()).'.sql';
        echo $sqlDump;
       }

    }


    /**
     * 导出模板文件
     */
    static function ExportTempFile(){

    }



    /**
     * 获取数据库配置
     * @return array
     */
    static function getDbConfig(): array
    {
        $default = config('database.default');

        $config = config("database.connections.{$default}");

        if (0 == $config['deploy']) {
            $dbConfig = [
                'adapter'      => $config['type'],
                'host'         => $config['hostname'],
                'name'         => $config['database'],
                'user'         => $config['username'],
                'pass'         => $config['password'],
                'port'         => $config['hostport'],
                'charset'      => $config['charset'],
                'table_prefix' => $config['prefix'],
            ];
        } else {
            $dbConfig = [
                'adapter'      => explode(',', $config['type'])[0],
                'host'         => explode(',', $config['hostname'])[0],
                'name'         => explode(',', $config['database'])[0],
                'user'         => explode(',', $config['username'])[0],
                'pass'         => explode(',', $config['password'])[0],
                'port'         => explode(',', $config['hostport'])[0],
                'charset'      => explode(',', $config['charset'])[0],
                'table_prefix' => explode(',', $config['prefix'])[0],
            ];
        }

        $table = config('database.migration_table', 'migrations');

        $dbConfig['default_migration_table'] = $dbConfig['table_prefix'] . $table;

        return $dbConfig;
    }




}