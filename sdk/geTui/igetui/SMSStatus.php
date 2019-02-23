<?php
/**
 * Created by PhpStorm.
 * User: jswei
 * Date: 2019/2/23
 * Time: 15:07
 */
namespace jswei\push\sdk\geTui\igetui;

use jswei\push\sdk\geTui\protobuf\type\PBEnum;

class SMSStatus extends PBEnum
{
    const unread  = 0;
    const read  = 1;
}
