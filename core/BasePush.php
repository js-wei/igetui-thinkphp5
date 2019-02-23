<?php
namespace jswei\push\core;

use jswei\push\sdk\geTui\igetui\template\notify\IGtNotify;

/**
 * Class BasePush
 * @property string $title 标题
 * @property string $body 消息正文
 * @property array $extendedData 扩展参数
 * @package jswei\push\core
 */
class BasePush
{

    protected $title;
    protected $body;
    protected $extendedData = [];
    protected $logoURL;
    protected $logo;
    protected $template;
    protected $linkUrl;
    protected $templateType;
    protected $notify;

    protected $notyTitle;
    protected $notyContent;
    protected $notyIcon;
    protected $popTitle;
    protected $popContent;
    protected $popImage;
    protected $popButton1;
    protected $popButton2;
    protected $loadIcon;
    protected $loadTitle;
    protected $loadUrl;
    protected $isAutoInstall;
    protected $isActived;
    protected $isBelled;
    protected $isVibrationed;
    protected $isCleared;
    protected $pushTime;

    public $systemMessage = false;

    public function setNotyTitle($notyTitle){
        $this->notyTitle = $notyTitle;
    }
    public function setNotyContent($notyContent){
        $this->notyContent = $notyContent;
    }
    public function setNotyIcon($notyIcon){
        $this->notyIcon = $notyIcon;
    }
    public function setPopTitle($popTitle){
        $this->popTitle = $popTitle;
    }
    public function setPopContent($popContent){
        $this->popContent = $popContent;
    }

    public function setPopImage($popImage){
        $this->popImage = $popImage;
    }
    public function setPopButton1($popButton1){
        $this->popButton1 = $popButton1;
    }

    public function setPopButton2($popButton2){
        $this->popButton2 = $popButton2;
    }
    public function setLoadIcon($loadIcon){
        $this->loadIcon = $loadIcon;
    }

    public function setLoadTitle($loadTitle){
        $this->loadTitle = $loadTitle;
    }
    public function setLoadUrl($loadUrl){
        $this->loadUrl = $loadUrl;
    }

    public function setIsAutoInstall($isAutoInstall){
        $this->$isAutoInstall = $isAutoInstall;
    }
    public function setIsActived($isActived){
        $this->isActived = $isActived;
    }

    public function setIsBelled($isBelled){
        $this->isBelled = $isBelled;
    }
    public function setIsVibrationed($isVibrationed){
        $this->isVibrationed = $isVibrationed;
    }

    public function setIsCleared($isCleared){
        $this->isCleared = $isCleared;
    }
    public function setPushTime($time){
        $this->pushTime = $time;
    }
    /**
     * 设置推送消息的标题
     * @param string $title 标题
     * @return $this
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

    public function setLinkUrl($url){
        $this->linkUrl = $url;
        return $this;
    }

    /**
     * 设置消息体
     * @param string $body
     * @return $this
     */
    public function setBody(string $body)
    {
        $this->body = $body;
        return $this;
    }

    public function setTemplateType($templateType){
        $this->templateType = $templateType;
        return $this;
    }

    /**
     * 设置扩展数据
     * @param array $data
     * @return $this
     */
    public function setExtendedData(array $data)
    {
        $this->extendedData = $data;
        return $this;
    }
    /**
     * 设置是否发送系统通知（非透传）
     * @param $bool
     * @return $this
     */
    public function setSystemMessage($bool)
    {
        $this->systemMessage = $bool;
        return $this;
    }

    public function setLogo($logo){
        $this->logo = $logo;
        return $this;
    }

    public function setLogoURL($url){
        $this->logoURL = $url;
        return $this;
    }

    public function setTemplate($template){
        $this->template = $template;
        return $this;
    }

    /**
     * @param IGtNotify $notify
     */
    public function setNotify(IGtNotify $notify){
        $this->notify =$notify;
    }
}