<?php
namespace jswei\push\drive;

use http\Exception;
use jswei\push\sdk\geTui\IGeTui;
use jswei\push\sdk\geTui\igetui\IGtAppMessage;
use jswei\push\sdk\geTui\igetui\IGtListMessage;
use jswei\push\sdk\geTui\igetui\IGtTemplateTye;
use jswei\push\sdk\geTui\igetui\template\IGtLinkTemplate;
use jswei\push\sdk\geTui\igetui\template\IGtNotificationTemplate;
use jswei\push\sdk\geTui\igetui\IGtSingleMessage;
use jswei\push\sdk\geTui\igetui\IGtTarget;
use jswei\push\core\BasePush;
use jswei\push\core\PushInterface;
use jswei\push\sdk\geTui\igetui\template\IGtNotyPopLoadTemplate;
use jswei\push\sdk\geTui\igetui\utils\AppConditions;
use jswei\push\sdk\geTui\igetui\utils\OptType;
use jswei\push\sdk\geTui\igetui\template\IGtTransmissionTemplate;

class GeTuiService extends BasePush implements PushInterface
{

    protected $config = [];
    protected $AppID;
    protected $AppSecret;
    protected $AppKey;
    protected $MasterSecret;
    protected $igt;
    const HOST = 'http://sdk.open.api.igexin.com/apiex.htm';
    protected $result;

    /**
     * 初始化
     * @param array $config 配置
     * @return GeTuiService
     */
    public static function init($config)
    {
        $class = new self();

        $class->config = $config;
        $class->AppKey = $config['AppKey'] ?? '';
        $class->AppID = $config['AppID'] ?? '';
        $class->AppSecret = $config['AppSecret'] ?? '';
        $class->MasterSecret = $config['MasterSecret'] ?? '';
        $class->LogoUrl = $config['LogoUrl'] ?? '';

        return $class;
    }
    public function __construct($config)
    {
        $this->config = $config;
        $this->AppKey = $config['AppKey'] ?? '';
        $this->AppID = $config['AppID'] ?? '';
        $this->AppSecret = $config['AppSecret'] ?? '';
        $this->MasterSecret = $config['MasterSecret'] ?? '';
        $this->LogoUrl = $config['LogoUrl'] ?? '';
        $this->igt = new IGeTui(self::HOST, $this->AppKey, $this->MasterSecret);

    }

    public function setConfig($config)
    {
        $this->config = $config;
        $this->AppKey = $config['AppKey'] ?? '';
        $this->AppID = $config['AppID'] ?? '';
        $this->AppSecret = $config['AppSecret'] ?? '';
        $this->MasterSecret = $config['MasterSecret'] ?? '';
        $this->LogoUrl = $config['LogoUrl'] ?? '';
        return $this;
    }

    // 发送广播
    public function sendAll($phoneTypeList=null,$provinceList=null,$tagList=null){
        //定义透传模板，设置透传内容，和收到消息是否立即启动启用
        $template = $this->getTemplate();
        //$template = IGtLinkTemplateDemo();
        // 定义"AppMessage"类型消息对象，设置消息内容模板、发送的目标App列表、是否支持离线发送、以及离线消息有效期(单位毫秒)
        $message = new IGtAppMessage();
        $message->set_isOffline(true);
        $message->set_offlineExpireTime(10 * 60 * 1000);//离线时间单位为毫秒，例，两个小时离线为3600*1000*2
        $message->set_data($template);
        $message->setPushTime($this->pushTime);
        $message->set_speed(100);
        $appIdList = array($this->AppID);
        $message->set_appIdList($appIdList);
        if($phoneTypeList || $provinceList || $tagList){
            $cdt = new AppConditions();
            if($phoneTypeList){
                $cdt->addCondition(AppConditions::PHONE_TYPE, $phoneTypeList);
            }
            if($provinceList){
                $provinceList = is_array($provinceList)?$provinceList:[$provinceList];
                $cdt->addCondition(AppConditions::REGION, $provinceList,OptType::_AND_);
            }
            if($tagList){
                $tagList = is_array($tagList)?$tagList:[$tagList];
                $cdt->addCondition(AppConditions::TAG, $tagList);
            }
            $message->set_conditions($cdt);
        }
        $this->result = $this->igt->pushMessageToApp($message);
    }
    // 安卓 - 广播
    public function sendAllAndroid($provinceList=null,$tagList=null){
        $this->sendAll(['ANDROID'],$provinceList,$tagList);
        return $this;
    }
    // IOS - 广播
    public function sendAllIOS(){
        $this->sendAll(['ISO']);
        return $this;
    }


    /**
     * 单播：所有平台
     * @param string $device
     */
    public function sendOne($device)
    {
        //消息模版：
        // 4.NotyPopLoadTemplate：通知弹框下载功能模板
        $template = $this->getTemplate();
        //定义"SingleMessage"
        $message = new IGtSingleMessage();
        $message->set_isOffline(true);//是否离线
        $message->set_offlineExpireTime(3600*12*1000);//离线时间
        $message->set_data($this->template??$template);//设置推送消息类型
        //$message->set_PushNetWorkType(0);//设置是否根据WIFI推送消息，2为4G/3G/2G，1为wifi推送，0为不限制推送
        //接收方
        $target = new IGtTarget();
        $target->set_appId($this->AppID);
        $target->set_clientId($device);
        $this->result = $this->igt->pushMessageToSingle($message, $target);
        return $this;
    }

    /**
     * 安卓 - 单播
     * @param string $device 发送设备
     */
    public function sendOneAndroid($device)
    {
        return $this->sendOne($device);
    }

    /**
     * IOS - 单播
     * @param string $device 发送设备
     */
    public function sendOneIOS($device)
    {
        $this->sendOne($device);
    }

    /**
     * 指定用户推送
     * @param array $clientIdList
     * @return $this
     */
    public function sendToUserList($clientIdList=[]){
        putenv("gexin_pushList_needDetails=true");//是否开启needDetails
        putenv("gexin_pushList_needAsync=true");//是否开启needAsync
        $template = $this->getTemplate();
        $message = new IGtListMessage();
        $message->set_isOffline(true);//是否离线
        $message->set_offlineExpireTime(3600*12*1000);//离线时间
        $message->set_data($template);//设置推送消息类型
        $message->set_PushNetWorkType(1);//设置是否根据WIFI推送消息，1为wifi推送，0为不限制推送
        $contentId = $this->igt->getContentId($message);
        if(!$clientIdList){
            throw Exception('client_id\'s not be empty!');
        }
        $pushList=[];
        foreach ($clientIdList as $v){
            if($v){
                $target = new IGtTarget();
                $target->set_appId($this->AppID);
                $target->set_clientId($v);
                array_push($pushList,$target);
            }
        }
        if(!$pushList){
            throw Exception('client_id\'s not be empty,please confirm again.');
        }
        $this->result = $this->igt->pushMessageToList($contentId,$pushList);
        return $this;
    }

    // 发送组播
    public function sendGroup()
    {

    }
    // 安卓 - 组播
    public function sendGroupAndroid()
    {

    }
    // IOS - 组播
    public function sendGroupIOS()
    {

    }

    public function getError()
    {
    }

    public function getResult()
    {
        return $this->result;
    }
    public function getCurrentTemplate(){
        return $this->getTemplate();
    }

    private function getTemplate()
    {
        $templateType = $this->templateType ?? IGtTemplateTye::notification;
        switch ($templateType){
            case 2:
                $template =  new IGtLinkTemplate();
                if(!$this->linkUrl){
                    throw Exception('Link linkUrl not be empty!');
                }
                $template->set_url($this->linkUrl);
                break;
            case 3:
                $template =  new IGtNotyPopLoadTemplate();
                if(!$this->notyTitle){
                    throw  Exception('PopLoad notyTitle not be empty!');
                }
                if(!$this->notyContent){
                    throw  Exception('PopLoad notyContent not be empty!');
                }
                if(!$this->notyIcon){
                    throw  Exception('PopLoad notyIcon not be empty!');
                }
                if(!$this->popContent){
                    throw  Exception('PopLoad popContent not be empty!');
                }
                if(!$this->popImage){
                    throw Exception('PopLoad popImage not be empty!');
                }
                if(!$this->loadIcon){
                    throw Exception('PopLoad loadIcon not be empty!');
                }
                if(!$this->loadTitle){
                    throw Exception('PopLoad loadTitle not be empty!');
                }
                if(!$this->loadUrl){
                    throw Exception('PopLoad loadUrl not be empty!');
                }
                //通知栏
                $template ->set_notyTitle($this->notyTitle);                 //通知栏标题
                $template ->set_notyContent($this->notyContent);            //通知栏内容
                $template ->set_notyIcon($this->notyIcon);                 //通知栏logo
                $template ->set_isBelled($this->isBelled??true);                    //是否响铃
                $template ->set_isVibrationed($this->isVibrationed??true);               //是否震动
                $template ->set_isCleared($this->isCleared??true);                   //通知栏是否可清除
                //弹框
                $template ->set_popTitle($this->popTitle);   //弹框标题
                $template ->set_popContent($this->popContent); //弹框内容
                $template ->set_popImage($this->popImage);           //弹框图片
                $template ->set_popButton1($this->popButton1??"下载");     //左键
                $template ->set_popButton2($this->popButton2??"取消");     //右键
                //下载
                $template ->set_loadIcon($this->loadIcon);           //弹框图片
                $template ->set_loadTitle($this->loadTitle);
                $template ->set_loadUrl($this->loadUrl);
                $template ->set_isAutoInstall($this->isAutoInstall??false);
                $template ->set_isActived($this->isActived??false);
                break;
            case 4:
                $template =  new IGtTransmissionTemplate();
                if($this->notify){
                    $template->set3rdNotifyInfo($this->notify);
                }elseif ($this->extendedData){
                    $extendData = json_encode($this->extendedData);
                    $template->set_transmissionType(1);//透传消息类型
                    $template->set_transmissionContent($extendData);//透传内容
                }else{
                    throw Exception('payload not be empty!');
                }
                break;
            case 1:
            default:
                $template =  new IGtNotificationTemplate();
                if (!empty($this->extendedData)) {
                    $extendData = json_encode($this->extendedData);
                    $template->set_transmissionType(1);//透传消息类型
                    $template->set_transmissionContent($extendData);//透传内容
                }
                break;
        }
        $template->set_appId($this->AppID);                   //应用appid
        $template->set_appkey($this->AppKey);                 //应用appkey
        if(!in_array($this->templateType,[3,4])){
            $template->set_title($this->title);      //通知栏标题
            $template->set_text($this->body);     //通知栏内容
            $template->set_logo($this->logo??$this->LogoUrl);                       //通知栏logo
            $template->set_logoURL($this->logoURL??$this->LogoUrl);                    //通知栏logo链接
            $template->set_isRing(true);                   //是否响铃
            $template->set_isVibrate(true);                //是否震动
            $template->set_isClearable(true);              //通知栏是否可清除$template->set_transmissionType(1);//透传消息类型
        }
        return $template;
    }


}