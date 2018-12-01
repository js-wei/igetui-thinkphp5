<?php
/**
 * 推送工厂
 * Created by PhpStorm.
 * User: xing.chen
 * Date: 2018/1/24
 * Time: 10:39
 */

namespace xing\push\core;
use think\facade;

class PushFactory extends facade
{

    /**
     * @var array
     */
    private static $drive = [
        'Umeng' => '\xing\push\drive\UmengService',
        'GeTui' => '\xing\push\drive\GeTuiService',
        'XingGe' => '\xing\push\drive\XinggeService',
    ];


    protected static function getFacadeClass()
    {
        return 'xing\push\core\PushFactory';
    }
    /**
     * @param string $driveName 推送
     * @return \xing\push\drive\UmengService
     * @throws \Exception
     */
    public static function getInstance(string $driveName)
    {
        if (!isset(static::$drive[$driveName])) throw new \Exception('没有这个驱动');
        return new static::$drive[$driveName];
    }
}