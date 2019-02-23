<?php
/**
 * Created by PhpStorm.
 * User: jswei
 * Date: 2019/2/23
 * Time: 15:07
 */
namespace jswei\push\sdk\geTui\igetui;

use jswei\push\sdk\geTui\protobuf\PBMessage;

class StopBatchTask extends PBMessage
{
    var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
    public function __construct($reader=null)
    {
        parent::__construct($reader);
        $this->fields["1"] = "PBString";
        $this->values["1"] = "";
        $this->fields["2"] = "PBString";
        $this->values["2"] = "";
        $this->fields["3"] = "PBString";
        $this->values["3"] = "";
        $this->fields["4"] = "PBString";
        $this->values["4"] = "";
    }
    function taskId()
    {
        return $this->_get_value("1");
    }
    function set_taskId($value)
    {
        return $this->_set_value("1", $value);
    }
    function appkey()
    {
        return $this->_get_value("2");
    }
    function set_appkey($value)
    {
        return $this->_set_value("2", $value);
    }
    function appId()
    {
        return $this->_get_value("3");
    }
    function set_appId($value)
    {
        return $this->_set_value("3", $value);
    }
    function seqId()
    {
        return $this->_get_value("4");
    }
    function set_seqId($value)
    {
        return $this->_set_value("4", $value);
    }
}
