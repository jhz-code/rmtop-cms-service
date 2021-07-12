<?php


namespace RmTop\RmSystemInstall\lib;


/**
 * 文件操作
 * Class RmFileOpreate
 * @package RmTop\RmSystemInstall\lib
 */
class RmFileOpreate
{



    //删除目录（递归删除）
   static  function topDelDir($path)
    {
        if (is_dir($path)) {
            //扫描一个目录内的所有目录和文件并返回数组
            $dirs = scandir($path);

            foreach ($dirs as $dir) {
                //排除目录中的当前目录(.)和上一级目录(..)
                if ($dir != '.' && $dir != '..') {
                    //如果是目录则递归子目录，继续操作
                    $sonDir = $path.'/'.$dir;
                    if (is_dir($sonDir)) {
                        //递归删除
                        self::topDirPath($sonDir);

                        //目录内的子目录和文件删除后删除空目录
                        @rmdir($sonDir);
                    } else {

                        //如果是文件直接删除
                        @unlink($sonDir);
                    }
                }
            }
            @rmdir($path);
        }
    }


    /**
     * 目录拷贝
     * @param $dir1
     * @param $dir2
     */
    static function topCopyDir($dir1,$dir2){
        if (!file_exists($dir2)) {
            mkdir($dir2);
        }
        //遍历原目录
        $arr = scandir($dir1);
        foreach ($arr as $val) {
            if ($val != '.' && $val != '..') {
                //原目录拼接
                $sourceFile = $dir1 . '/' . $val;
                //目的目录拼接
                $dFile = $dir2 . '/' . $val;
                if (is_dir($sourceFile)) {
                    self::topCopyDir($sourceFile, $dFile);
                } else {
                    copy($sourceFile, $dFile);
                }
            }
        }
    }


    /**
     * 移动文件目录
     * @param $dir1
     * @param $dir2
     */
    static function topMoveDir($dir1, $dir2){
        self::topCopyDir($dir1, $dir2);
        self::topDelDir($dir1);
    }


    /**
     * 创建目录
     * @param $path
     * @param int $mode
     * @return bool
     */
    static function  topDirCreate($path, $mode = 0777): bool
    {
    if (is_dir($path))
        return TRUE;
    $ftp_enable = 0;
    $path = self::topDirPath($path);
    $temp = explode('/', $path);
    $cur_dir = '';
    $max = count($temp) - 1;
    for ($i = 0; $i < $max; $i++) {
        $cur_dir .= $temp[$i] . '/';
        if (@is_dir($cur_dir))
            continue;
        @mkdir($cur_dir, 0777, true);
        @chmod($cur_dir, 0777);
     }
     return is_dir($path);
}


    /**
     * 文件目录检测
     * @param $path
     * @return array|string|string[]
     */
    static function topDirPath($path)
    {
        $path = str_replace('\\', '/', $path);
        if (substr($path, -1) != '/')
            $path = $path . '/';
        return $path;
    }




}