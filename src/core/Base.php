<?php


namespace RmTop\RmCmsService\core;

require dirname(__DIR__).'/config/version.php';

class Base
{

    /**
     * 获取系统版本
     * @return string
     */
    static function getVersion(): string
    {
        return RM_VERSION;
    }


    /**
     * 获取系统名称
     * @return string
     */
    static function getSystemName(): string
    {
        return RM_SYSTEM;
    }


    /**
     * 获取系统版权
     * @return string
     *
     */
    static function getCopyright(): string
    {
        return RM_COPYRIGHT;
    }


    /**
     * 获取系统邮箱
     * @return string
     */
    static function getSystemEmail(): string
    {
        return RM_EMAIL;
    }

    /**
     * 获取官方电话
     * @return string
     */
    static function getSystemPhone(): string
    {
        return RM_PHONE;
    }


    /**
     * 获取系统官方电话
     * @return string
     */
    static function getSystemHost(): string
    {
        return RM_HOST;
    }


    /**
     * 获取系统升级地址
     * @return string
     */
    static function getSystemInstall(): string
    {
        return RM_INSTALL;
    }


    /**
     * 获取系统升级地址
     */
    static function getSystemUpgrade(): string
    {
        return RM_UPGRADE;
    }

    static function getAgree(){
        return RM_AGREE;
    }



}