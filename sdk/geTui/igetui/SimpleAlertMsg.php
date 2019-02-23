<?php
/**
 * Created by PhpStorm.
 * User: jswei
 * Date: 2019/2/23
 * Time: 15:02
 */

namespace jswei\push\sdk\geTui\igetui;

class SimpleAlertMsg implements ApnMsg{
    var $alertMsg;

    public function get_alertMsg() {
        return $this->alertMsg;
    }
}