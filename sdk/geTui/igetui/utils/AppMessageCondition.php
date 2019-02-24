<?php
/**
 * Created by PhpStorm.
 * User: jswei
 * Date: 2019/2/23
 * Time: 14:58
 */

namespace jswei\push\sdk\geTui\igetui\utils;

class AppMessageCondition {
    public $PHONE_TYPE = OptType::_OR_;
    public $REGION = OptType::_OR_;
    public $TAG = OptType::_OR_;
    public $OTHER = OptType::_OR_;

    /**
     * @param OptType $phoneType
     */
    public function setPhoneType(OptType $phoneType){
        $this->PHONE_TYPE= $phoneType;
    }

    /**
     * @param OptType $provinceType
     */
    public function setProvinceType(OptType $provinceType){
        $this->REGION= $provinceType;
    }

    /**
     * @param OptType $tagType
     */
    public function setTagType(OptType $tagType){
        $this->OTHER= $tagType;
    }
}