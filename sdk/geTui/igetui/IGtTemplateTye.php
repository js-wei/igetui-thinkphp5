<?php
/**
 * Created by PhpStorm.
 * User: jswei
 * Date: 2019/2/23
 * Time: 15:07
 */
namespace jswei\push\sdk\geTui\igetui;

use jswei\push\sdk\geTui\protobuf\type\PBEnum;

class IGtTemplateTye extends PBEnum
{
    const notifyInfo  = 1;
    const link  = 2;
    const download  = 3;
    const transmission  = 4;
}
