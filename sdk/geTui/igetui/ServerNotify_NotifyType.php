<?php
/**
 * Created by PhpStorm.
 * User: jswei
 * Date: 2019/2/23
 * Time: 15:07
 */
namespace jswei\push\sdk\geTui\igetui;

use jswei\push\sdk\geTui\protobuf\type\PBEnum;

class ServerNotify_NotifyType extends PBEnum
{
    const normal  = 0;
    const serverListChanged  = 1;
    const exception  = 2;
}
