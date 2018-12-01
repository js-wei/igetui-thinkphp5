<?php
namespace jswei\push\core;

class PushFactory
{

    /**
     * @var array
     */
    private static $drive = [
        'Umeng' => '\jswei\push\drive\UmengService',
        'GeTui' => '\jswei\push\drive\GeTuiService',
        'XingGe' => '\jswei\push\drive\XinggeService',
    ];

    /**
     * @param string $driveName 推送
     * @return \jswei\push\drive\UmengService
     * @throws \Exception
     */
    public static function getInstance(string $driveName)
    {
        if (!isset(static::$drive[$driveName])) throw new \Exception('没有这个驱动');
        return new static::$drive[$driveName];
    }
}