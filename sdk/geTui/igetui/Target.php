<?php
/**
 * Created by PhpStorm.
 * User: jswei
 * Date: 2019/2/23
 * Time: 15:07
 */
namespace jswei\push\sdk\geTui\igetui;

use jswei\push\sdk\geTui\protobuf\PBMessage;

class Target extends PBMessage
{
    var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
    public function __construct($reader=null)
    {
        parent::__construct($reader);
        $this->fields["1"] = '\jswei\push\sdk\geTui\protobuf\type\PBString';
        $this->values["1"] = "";
        $this->fields["2"] = '\jswei\push\sdk\geTui\protobuf\type\PBString';
        $this->values["2"] = "";
        $this->fields["3"] = '\jswei\push\sdk\geTui\protobuf\type\PBString';
        $this->values["3"] = "";
    }
    function appId()
    {
        return $this->_get_value("1");
    }
    function set_appId($value)
    {
        return $this->_set_value("1", $value);
    }
    function clientId()
    {
        return $this->_get_value("2");
    }
    function set_clientId($value)
    {
        return $this->_set_value("2", $value);
    }
    function alias()
    {
        return $this->_get_value("3");
    }
    function set_alias($value)
    {
        return $this->_set_value("3", $value);
    }
}
