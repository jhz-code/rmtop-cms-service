<?php


namespace RmTop\RmCmsService\lib;


use PDO;
use think\db\exception\PDOException;

class RmTemp
{


    /**
     * 导出模板管理数据sql
     */
    static function ExportTempSql($savePath): string
    {
        $db  = self::getDbConfig();
        $to_file_name = $savePath;
        try {
            $conn = new PDO("mysql:host=" . $db['host'] . ";dbname=".$db['name'].";port=" . $db['port'] . "", $db['user'], $db['pass']);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//设置调优参数，遇到错误抛出异常
        } catch (PDOException $e) {
            echo $e->getMessage();//如果连接异常则抛出错误信息
            exit;
        }
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
        $mysql = "-- ----------------------------\r\n";
        $mysql .= "-- 日期：" . date("Y-m-d H:i:s", time()) . "\r\n";
        //将每个表的表结构导出到文件
        foreach ($tempSqlArr as $val) {
            $table_name = $db['table_prefix'].$val;
            $mysql.="DROP TABLE IF EXISTS `$table_name`;\n";//每个表前都准备Drop语句
            $table_query = $conn->query("show create table `$table_name`");//取出该表建表信息的结果集
            $create_sql = $table_query->fetch();//利用fetch方法取出该结果集对应的数组
            $mysql.=$create_sql['Create Table'] . ";\r\n\r\n";//写入建表信息
            $flag = 1;
            if ($flag != 0) {//如果标志位不是0则继续取出该表内容生成insert语句
                $iteams_query = $conn->prepare("select * from `$table_name`");//取出该表所有字段结果集
                $iteams_query->execute();
                $values = "";//准备空字符串装载insert value值
                $items = "";//准备空字符串装载该表字段名
                while ($item_query = $iteams_query->fetch(PDO::FETCH_ASSOC)) { //用关联查询方式返回表中字段名和值的数组
                    $item_names = array_keys($item_query);//取出该数组键值 即字段名
                    $item_names = array_map("addslashes", $item_names);//将特殊字符转译加\
                    $items = join('`,`', $item_names); //联合字段名 如：items1`,`item2 `符号为反引号 键盘1旁边 字段名用反引号括起
                    $item_values = array_values($item_query);//取出该数组值 即字段对应的值
                    $item_values = array_map("addslashes", $item_values);//将特殊字符转译加\
                    $value_string = join("','", $item_values);//联合值 如：value1','value2 值用单引号括起
                    $value_string = "('" . $value_string . "'),";//值两边加括号
                    $values .= "\n" . $value_string;//最后返回给$value
                }
                if ($values != "") {//如果$values不为空，即该表有内容
                    //写入insert语句
                    $insert_sql = "INSERT INTO `$table_name` (`$items`) VALUES" . rtrim($values, ",") . ";\n\r";
                    //将该语句写入$mysql
                    $mysql .= $insert_sql;
                }
            }
        }
        //表间的分割线
        $mysql .= "-- ---------------------------------------------------\n\r";
        $filename = $to_file_name."/top_temp.sql"; //导出的文件名
        file_put_contents($filename, $mysql);//导出sql文件
        return $filename;
    }


    /**
     * 模板数据导入
     * @param string $sql
     * @return bool
     */
    static function ImportTempSql(string $sql){
        $db  = self::getDbConfig();
        try {
            $conn = new PDO("mysql:host=" . $db['host'] . ";dbname=".$db['name'].";port=" . $db['port'] . "", $db['user'], $db['pass']);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//允许抛出异常
        } catch (PDOException $e) {
            echo $e->getMessage();//数据库连接不成功抛出异常
            exit;
        }
        try {
            if (file_exists($sql)){//如果文件存在
                $sql_stream = file_get_contents($sql);//读取整个文件内容
                $sql_stream = rtrim($sql_stream);//去掉末尾空格
                //切割单条sql语句生成数组
                $sql_array = explode(";", $sql_stream);
                //遍历该数组
                foreach ($sql_array as $value) {
                    if (!empty($value)) { //数组最后一个是空数组，所以需要判断一下
                        $sql = str_replace(" $$$ ", ";", $value) . ";"; //将该条sql语句中' $$$ '转换回；
                        if(preg_match('/DROP TABLE IF EXISTS `([A-Za-z0-9]+)_([^ ]*)`/', $sql, $matches)){
                            $sql = str_replace('`' . $matches[1] . '_', '`' . $db['table_prefix'], $sql);//替换表前缀
                        }
                        if(preg_match('/CREATE TABLE `([A-Za-z0-9]+)_([^ ]*)`/', $sql, $matches)){
                            $sql = str_replace('`' . $matches[1] . '_', '`' . $db['table_prefix'], $sql);//替换表前缀
                        }
                        if(preg_match('/INSERT INTO `([A-Za-z0-9]+)_([^ ]*)`/is', $sql, $matches)){
                            $sql = str_replace('`' . $matches[1] . '_', '`' . $db['table_prefix'], $sql);//替换表前缀
                        }

                        $conn->exec($sql); //执行该语句
                        echo  "成功插入数据：<br/><per>" . $sql . ";<per/><br/><br/>";
                    }
                }
                return true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage(); //执行异常则抛出异常
            exit;
        }
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