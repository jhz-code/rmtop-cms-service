<?php


namespace RmTop\RmCmsService\lib;


use PDO;
use PDOException;

class RmEve
{

    /**
     * 检查连接是否可用
     * @param $dbconn  //数据库连接
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



    //环境变量检测
    static function env_check()
    {
        define('PHP_EDITION', '7.1.0');
        $reData = [];
        $err = 0;
        $env_items = [
            'os' => array('c' => 'PHP_OS','n'=>'操作系统', 'r' => 'noRestriction', 'b' => '建议使用Linux系统以提升程序性能','rs'=>'正在检测'),
            'server' => array('c' => 'SERVER_SOFTWARE','n'=>'服务器环境', 'r' => 'apache/nginx', 'b' => 'apache2.0以上/nginx1.6以上','rs'=>'正在检测'),
            'php' => array('c' => 'PHP_VERSION','n'=>'PHP版本', 'r' => '7.1.0', 'b' => '>7.1.0','rs'=>'正在检测'),
            'pdo' => array('c' => 'pdo','n'=>'PDO扩展', 'r' => '启用', 'b' => '必须开启','rs'=>'正在检测'),
            'session' => array('c' => 'session','n'=>'session', 'r' => '开启', 'b' => '开启 session.auto_start','rs'=>'正在检测'),
            'safe_mode' => array('c' => 'safe_mode','n'=>'safe_mode', 'r' => 'noRestriction', 'b' => '基础配置','rs'=>'正在检测'),
            'gd' => array('c' => 'gd_info','n'=>'GD库', 'r' => '1.0', 'b' => '必须开启','rs'=>'正在检测'),
            'curl' => array('c' => 'curl','n'=>'CURL库', 'r' => '启用', 'b' => '必须扩展','rs'=>'正在检测'),
            'fileinfo' => array('c' => 'finfo_open','n'=>'fileinfo库', 'r' => '启用', 'b' => '必须扩展','rs'=>'正在检测'),
            'openssl' => array('c' => 'openssl','n'=>'openssl库', 'r' => '启用', 'b' => '必须扩展','rs'=>'正在检测'),
            'bcmath' => array('c' => 'bcmath','n'=>'bcmath库', 'r' => '启用', 'b' => '必须扩展','rs'=>'正在检测'),
            'OPcache' => array('c' => 'opcache_get_configuration','n'=>'OPcache库', 'r' => 'noRestriction', 'b' => '启用','rs'=>'正在检测'),

            'file_uploads' => array('c' => 'file_uploads','n'=>'附件上传', 'r' => 'noRestriction', 'b' => '>2M','rs'=>'正在检测'),
            'disk_space' => array('c' => 'disk_free_space','n'=>'硬盘空间', 'r' => self::file_size_format(30 * 1048576), 'b' => '>100MB','rs'=>'正在检测'),
        ];
        session('install_check_err', null);
        foreach ($env_items as $key => $item) {
            $reData[$key] = self::env_item_check($item);
        }

        return $reData;

    }


    //环境变量一重检测
    static function env_item_check($item)
    {
        $item = array_merge($item, [
            'r' => $item['r'] == 'noRestriction' ? lang('noRestriction') : $item['r'],
            'b' => $item['b'] == 'noRestriction' ? lang('noRestriction') : $item['b'],
            'rs' => self::env_item_check_id($item)
        ]);

        return $item;

    }



    //环境变量二重检测
    static function env_item_check_id($c)
    {

        switch ($c['c']) {
            case 'PHP_OS':
                return '<span class="correct_span">&radic;</span> ' . PHP_OS;
                break;
            case 'SERVER_SOFTWARE':
                return '<span class="correct_span">&radic;</span> ' . $_SERVER[$c['c']];
                break;
            case 'PHP_VERSION':
                if (PHP_VERSION < $c['r']) {
                    //记录没达到环境要求标志,存入session

                    session('install_check_err', true);
                    return '<span class="error_span">&radic;</span> ' . PHP_VERSION;
                } else {
                    return '<span class="correct_span">&radic;</span> ' . PHP_VERSION;
                }
                break;
            case 'pdo':
                if (extension_loaded('pdo')) {
                    return '<span class="correct_span">&radic;</span> 已安装';
                } else {

                    session('install_check_err', true);
                    return '<span class="correct_span error_span">&radic;</span> 请安装PDO扩展';
                }
                break;
            case 'session':
                if (function_exists('session_start')) {
                    if (ini_get('session.auto_start')) {
                        return '<font color=green><i class="fa fa-check-square-o"></i> On</font>';
                    } else {
                        return '<span class="correct_span">&radic;</span> 已安装 <font color=#9acd32><i class="fa fa-exclamation-triangle"></i> session.auto_start Off</font>';
                    }

                } else {
                    session('install_check_err', true);
                    return '<span class="correct_span error_span">&radic;</span> 请安装SESSION扩展';
                }
                break;
            case 'safe_mode':
                if (ini_get('safe_mode')) {
                    return '<font color=green><i class="fa fa-check-square-o"></i> On</font>';
                } else {
                    return '<font color=#9acd32><i class="fa fa-exclamation-triangle"></i> Off</font> 忽略';
                }
                break;
            case 'file_uploads':
                return @ini_get('file_uploads') ? '<span class="correct_span">&radic;</span> ' . ini_get('upload_max_filesize') : '<span class="error_span">&radic;</span> ' . lang('unknown');
                break;
            case 'disk_free_space':
                if (function_exists('disk_free_space')) {
                    return disk_free_space(root_path()) >= self::mitobyte($c['r']) ? '<span class="correct_span">&radic;</span> ' . self::file_size_format(disk_free_space(root_path())) : '<span class="error_span">&radic;</span> ' . self::file_size_format(disk_free_space(root_path()));
                } else {
                    return '<span class="error_span">&radic;</span> ' . lang('unknown');
                }
                break;
            case 'gd_info':
                $tmp = function_exists('gd_info') ? gd_info() : array();
                if (empty($tmp['GD Version'])) {

                    session('install_check_err', true);
                    return '<font color=red><i class="fa fa-exclamation"></i> Off</font>';

                } else {
                    return '<font color=green><i class="fa fa-check-square-o"></i> On</font> ' . $tmp['GD Version'];
                }
                break;
            case 'curl':
                if (extension_loaded('curl')) {
                    if (function_exists('curl_init')) {
                        return '<font color=green><i class="fa fa-check-square-o"></i> On 支持</font> ';
                    } else {
                        session('install_check_err', true);
                        return '<font color=red><span class="correct_span">&radic;</span> 已安装 <i class="fa fa-exclamation"></i> Off 不支持</font>';
                    }

                } else {
                    session('install_check_err', true);
                    return '<span class="error_span">&radic;</span> 未安装';
                }
                break;
            case 'finfo_open':
                if (function_exists('finfo_open')) {
                    return '<font color=green><i class="fa fa-check-square-o"></i> On 支持</font> ';
                } else {
                    session('install_check_err', true);
                    return '<font color=red><span class="correct_span">&radic;</span> 已安装 <i class="fa fa-exclamation"></i> Off 不支持</font>';
                }

                break;
            case 'openssl':
                if (extension_loaded('openssl')) {
                    if (function_exists('openssl_encrypt')) {
                        return '<font color=green><i class="fa fa-check-square-o"></i> On 支持</font> ';
                    } else {
                        session('install_check_err', true);
                        return '<font color=red><span class="correct_span">&radic;</span> 已安装 <i class="fa fa-close"></i> Off 不支持</font>';
                    }

                } else {
                    session('install_check_err', true);
                    return '<span class="error_span">&radic;</span> 未安装';
                }
                break;
            case 'bcmath':
                if (function_exists('bcadd')) {
                    return '<font color=green><i class="fa fa-check-square-o"></i> On 支持</font> ';
                } else {
                    session('install_check_err', true);
                    return '<font color=red><i class="fa fa-close"></i> Off 不支持</font>';
                }

                break;
            case 'opcache_get_configuration':
                if (function_exists('opcache_get_configuration')) {
                    if (opcache_get_configuration()['directives']['opcache.enable']) {
                        return '<font color=green><i class="fa fa-check-square-o"></i> On 支持</font> ';
                    } else {
                        session('install_check_err', true);
                        return '<font color=red><span class="correct_span">&radic;</span> 已安装 <i class="fa fa-close"></i> Off 不支持</font>';
                    }

                } else {
                    session('install_check_err', true);
                    return '<span class="error_span">&radic;</span> 未安装';
                }
                break;
            case 'pdo_mysql':
                if (extension_loaded('pdo_mysql')) {
                    return '<font color=green><i class="fa fa-check-square-o"></i> On 支持</font> ';
                } else {
                    session('install_check_err', true);
                    return '<font color=red><i class="fa fa-close"></i> Off 不支持</font>';
                }
                break;
            case 'file_put_contents':
                if (function_exists('file_put_contents')) {
                    return '<font color=green><i class="fa fa-check-square-o"></i> On 支持</font> ';
                } else {
                    session('install_check_err', true);
                    return '<font color=red><i class="fa fa-close"></i> Off 不支持</font>';
                }
                break;
            case 'file_get_contents':
                if (function_exists('file_get_contents')) {
                    return '<font color=green><i class="fa fa-check-square-o"></i> On 支持</font> ';
                } else {
                    session('install_check_err', true);
                    return '<font color=red><i class="fa fa-close"></i> Off 不支持</font>';
                }
                break;
            case 'xml_parser_create':
                if (function_exists('xml_parser_create')) {
                    return '<font color=green><i class="fa fa-check-square-o"></i> On 支持</font> ';
                } else {
                    session('install_check_err', true);
                    return '<font color=red><i class="fa fa-close"></i> Off 不支持</font>';
                }
                break;
            case 'gethostbyname':
                if (function_exists('gethostbyname')) {
                    return '<font color=green><i class="fa fa-check-square-o"></i> On 支持</font> ';
                } else {
                    session('install_check_err', true);
                    return '<font color=red><i class="fa fa-close"></i> Off 不支持</font>';
                }
                break;
            case 'fsockopen':
                if (function_exists('fsockopen')) {
                    return '<font color=green><i class="fa fa-check-square-o"></i> On 支持</font> ';
                } else {
                    session('install_check_err', true);
                    return '<font color=red><i class="fa fa-close"></i> Off 不支持</font>';
                }
                break;
            case 'imagettftext':
                if (function_exists('imagettftext')) {
                    return '<font color=green><i class="fa fa-check-square-o"></i> On 支持</font> ';
                } else {
                    session('install_check_err', true);
                    return '<font color=red><i class="fa fa-close"></i> Off 不支持</font>';
                }
                break;

            default:
                session('install_check_err', true);
                return '<span class="error_span">&radic;</span>  无此检测项数据！';
        }

    }


  static  function file_size_format($size = 0, $dec = 2)
    {
        $unit = array("B", "KB", "MB", "GB", "TB", "PB");
        $pos = 0;
        while ($size >= 1024) {
            $size /= 1024;
            $pos++;
        }
        $result['size'] = round($size, $dec);
        $result['unit'] = $unit[$pos];
        return $result['size'] . $result['unit'];

    }



   static function mitobyte($value)
    {
        return preg_replace_callback('/^\s*(\d+)\s*(?:([kmgt]?)b?)?\s*$/i', function ($m) {
            switch (strtolower($m[2])) {
                case 't':
                    $m[1] *= 1024;
                case 'g':
                    $m[1] *= 1024;
                case 'm':
                    $m[1] *= 1024;
                case 'k':
                    $m[1] *= 1024;
            }
            return $m[1];
        }, $value);
    }


}