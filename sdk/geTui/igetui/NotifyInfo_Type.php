<?php
/**
 * Created by PhpStorm.
 * User: jswei
 * Date: 2019/2/23
 * Time: 15:07
 */
namespace jswei\push\sdk\geTui\igetui;

use jswei\push\sdk\geTui\protobuf\type\PBEnum;

class NotifyInfo_Type extends PBEnum
{
    const _payload  = 0;
    const _intent  = 1;
    const _url  = 2;
}
