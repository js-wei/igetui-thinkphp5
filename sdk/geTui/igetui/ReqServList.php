<?php
/**
 * Created by PhpStorm.
 * User: jswei
 * Date: 2019/2/23
 * Time: 14:54
 */

namespace jswei\push\sdk\geTui\igetui;

use jswei\push\sdk\geTui\protobuf\PBMessage;

class ReqServList extends PBMessage
{
    var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
    public function __construct($reader=null)
    {
        parent::__construct($reader);
        $this->fields["1"] = '\jswei\push\sdk\geTui\protobuf\type\PBString';
        $this->values["1"] = "";
        $this->fields["2"] = '\jswei\push\sdk\geTui\protobuf\type\PBInt';
        $this->values["2"] = "";
    }
    function seqId()
    {
        return $this->_get_value("1");
    }
    function set_seqId($value)
    {
        return $this->_set_value("1", $value);
    }
    function timestamp()
    {
        return $this->_get_value("2");
    }
    function set_timestamp($value)
    {
        return $this->_set_value("2", $value);
    }
}
