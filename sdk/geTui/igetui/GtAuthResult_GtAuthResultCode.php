<?php
/**
 * Created by PhpStorm.
 * User: jswei
 * Date: 2019/2/23
 * Time: 14:54
 */

namespace jswei\push\sdk\geTui\igetui;

use jswei\push\sdk\geTui\protobuf\type\PBEnum;

class GtAuthResult_GtAuthResultCode extends PBEnum
{
    const successed  = 0;
    const failed_noSign  = 1;
    const failed_noAppkey  = 2;
    const failed_noTimestamp  = 3;
    const failed_AuthIllegal  = 4;
    const redirect  = 5;
}
