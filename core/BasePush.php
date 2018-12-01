<?php
/**
 * Created by PhpStorm.
 * User: xing.chen
 * Date: 2018/1/13
 * Time: 19:42
 */

namespace xing\push\core;

/**
 * Class BasePush
 * @property string $title 标题
 * @property string $body 消息正文
 * @property array $extendedData 扩展参数
 * @package xing\push\core
 */
class BasePush
{

    protected $title;
    protected $body;
    protected $extendedData = [];
    protected $logoURL;
    protected $logo;
    protected $template;

    public $systemMessage = false;
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
}