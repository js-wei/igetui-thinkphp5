# 推送服务
设计概要：

工厂模式：可根据配置随时切换第三方推送（本人的所有包库都是工厂模式）

PHP版本：信鸽、个推PHP7以上，友盟5.3以上，如果PHP版本低可自行改一下兼容的，应该只有一两处地方不兼容

目前支持的驱动有：信鸽，友盟、个推

不需要依赖框架运行：是

### 安装
composer require jswei/igetui-thinkphp5

## 运行示例
以下为各推送平台的配置，你用哪个平台就复制哪个配置
```php
<?php

// -------------------- 独立运行：工厂模式 ---------------------
# 赋值你要使用哪个平台的配置，说明文档最下面为各平台的配置参考
// 友盟
$driveName = 'Umeng';

// 信鸽
$driveName = 'Xingge';

// 个推
$driveName = 'GeTui';
// 友盟配置
$config = [
    'android' => [
        'appKey' => 'appKey',
        'appMasterSecret' => 'appMasterSecret'
    ],
    'IOS' => [
        'appKey' => 'appKey',
        'appMasterSecret' => 'appMasterSecret'  
    ]
];
// 信使配置
$config = [
   'expireTime' => 86400,
    'android' => [
       'accessId' => 'accessId',
       'secret_key' => 'secret_key',
    ],
    'IOS' => [
       'accessId' => 'accessId',
       'secret_key' => 'secret_key',
    ]
];

// 个推配置
$config = [
  'AppID' => 'AppID',
  'AppKey' => 'AppKey',
  'MasterSecret' => 'AppKey',
];

// 设置标题和消息、自定义参数
$push = \jswei\push\core\PushFactory::getInstance($driveName)::init($config)
        ->setTitle('标题')
        ->setBody('消息正文')
        ->setExtendedData(['a' => 1, 'b' => 2]);// 自定义扩展参数
```


## ThinkPHP5容器运行
```php
<?php
// -------------------- ThinkPHP5容器运行 ---------------------
 // provider.php
 return [
    'GeTui' => jswei\push\drive\GeTuiService::class
 ];
 // config/getui.php
 return [
    'AppID' => 'gOgGqTwgRh7vHyFk0r4yIA',
    'AppKey' => 'BhwmxGZyBU9EzbKxYXfuE7',
    'MasterSecret' => 'ZYaWeKKGAL8Y8vTrwiYf9A',
    'AppSecret'=>'zlNnaU8SYd9VLuQJ2RNBY7',
    'LogoUrl' => 'http://dev.img.ybzg.com/static/app/user/getui_logo.png',
 ];

 // 使用
 $config = config('getui.');

 $igt = app('GeTui')->init($config);
 $igt->setTitle('测试通知');
 $igt->setBody('测试的通知他');
 //$igt->setLogo('https://gitee.com/uploads/69/144269_jswei.png?1418807117');
 //$igt->setLogoURL('https://gitee.com/uploads/69/144269_jswei.png?1418807117');
 $igt->setExtendedData(['title'=>'a new','content'=>'this is a text']);
 $res = $igt->sendOneAndroid('b0a1bdd6cc90e05dfa9c4104f12f175c');
 var_dump($res->getResult());
 

```


## 推送方法
```php
<?php
$config = [
  'AppID' => 'AppID',
  'AppKey' => 'AppKey',
  'MasterSecret' => 'AppKey',
];
$push = \jswei\push\core\PushFactory::getInstance('GeTui')::init($config);
//   ***************  发送方法  **********   
# 广播：所有平台
$push->sendAll();
# 广播：安卓
$push->sendAllAndroid();
# 广播：IOS
$push->sendAllIOS();

# 单播：所有平台
$push->sendOne('设备码');
# 单播：安卓
$push->sendOneAndroid('设备码');
# 单播：IOS
$push->sendOneIOS('设备码');

```
```php
//下面是最新的用例
$config = config('getui.');
$igt = new GeTuiService($config);
$igt->setLogo('https://gitee.com/uploads/69/144269_jswei.png?'.time());
$igt->setTitle('测试通知');
$igt->setBody('测试的通知他');
//在notifyInfo或者transmission模板时显示透传信息
$igt->setExtendedData(['title'=>'a new','content'=>'this is a text']);
//链接模板必填
$igt->setLinkUrl('http://baidu.com');
//设置通知模板
//IGtTemplateTye::notifyInfo  打开app当setExtendedData时候透传信息
//IGtTemplateTye::link 链接模板
//IGtTemplateTye::transmission 透传模板
//IGtTemplateTye::download 下载模板
$igt->setTemplateType(IGtTemplateTye::download);
//下载模板专属配置
$igt->setNotyTitle('下载模板');
$igt->setNotyContent('下载模板');
$igt->setNotyIcon('https://gitee.com/uploads/69/144269_jswei.png?'.time());
$igt->setPopTitle('下载模板弹出标题');
$igt->setPopContent('下载模板弹出内容');
$igt->setPopImage('https://gitee.com/uploads/69/144269_jswei.png?1418807117');
$igt->setLoadIcon('https://gitee.com/uploads/69/144269_jswei.png?1418807117');
$igt->setLoadTitle('下载模板加载标题');
$igt->setLoadUrl('https://pecl.php.net/get/redis-4.2.0.tgz');
$res = $igt->sendAllAndroid()->getResult()
```
## 下面的示例（向指定用户推送）
```php
public function push()
{
    $config = config('getui.');
    $push = new GeTuiService($config);
    $push->setLogoURL('https://gitee.com/uploads/69/144269_jswei.png');
    $push->setTitle('测试通知');
    $push->setBody('测试的通知他');
    $push->setLinkUrl('http://baidu.com');
    //设置通知模板
    //IGtTemplateTye::notifyInfo  打开app当setExtendedData时候透传信息
    //IGtTemplateTye::link 链接模板
    //IGtTemplateTye::transmission 透传模板
    //IGtTemplateTye::download 下载模板
    $push->setTemplateType(IGtTemplateTye::link);
    //实现的方法
    /*
     $push->sendAllAndroid();     //向所有安卓平台发送
     $push->sendAllIOS();        //向所有苹果平台发送
     $push->sendAll();           //向所有平台发送
     $push->sendOne('client_id1'); //单台设备发送
     $push->sendToUserList('');  //向指定用户列表发送['client_id1','client_id2'...]

    //其他的一些可以获取个推对象和模板进行操作更多的操作
    // 获取个推对象实例
    //$igeTui = $push->getIGeTui();
    //获取消息模板
    $template = $push->getCurrentTemplate();*/
    return $push->sendToUserList(['b0a1bdd6cc90e05dfa9c4104f12f175c'])->getResult();
}
```
## 示例的响应信息（向指定用户推送）
```json
{
  "result": "ok",
  "contentId": "OSL-0223_BwEXmU9cAI8SpXGG39UTz6",
  "details": {
    "b0a1bdd6cc90e05dfa9c4104f12f175c": "successed_offline"
  }
}
```