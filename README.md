# push
设计概要：

工厂模式：可根据配置随时切换第三方推送（本人的所有包库都是工厂模式）

PHP版本：信鸽、个推PHP7以上，友盟5.3以上，如果PHP版本低可自行改一下兼容的，应该只有一两处地方不兼容

目前支持的驱动有：信鸽，友盟、个推

不需要依赖框架运行：是

### 安装
composer require jswei/igetui-thinkphp5

## 运行示例


```php
<?php

// -------------------- 独立运行：工厂模式 ---------------------

# 赋值你要使用哪个平台的配置，说明文档最下面为各平台的配置参考

// 设置标题和消息、自定义参数
$push = \jswei\push\core\PushFactory::getInstance($driveName)::init($config)
        ->setTitle('标题')
        ->setBody('消息正文')
        ->setExtendedData(['a' => 1, 'b' => 2]);// 自定义扩展参数

        
        
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

## 各推送平台配置
以下为各推送平台的配置，你用哪个平台就复制哪个配置
```php
<?php
//  ***  初始化驱动
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

// provider.php
return [
    'GeTui' => jswei\push\drive\GeTuiService::class
];
// 使用
 $igt = app('GeTui')->init($config);
 $igt->setTitle('测试通知');
 $igt->setBody('测试的通知他');
 //$igt->setLogo('https://gitee.com/uploads/69/144269_jswei.png?1418807117');
 //$igt->setLogoURL('https://gitee.com/uploads/69/144269_jswei.png?1418807117');
 $igt->setExtendedData(['title'=>'a new','content'=>'this is a text']);
 $res = $igt->sendOneAndroid('b0a1bdd6cc90e05dfa9c4104f12f175c');
 var_dump($res->getResult());

```

## 配置
```php
<?php

// 接上面的配置

// 友盟
$driveName = 'Umeng';

// 信鸽
$driveName = 'Xingge';

// 个推
$driveName = 'GeTui';


```

## 透传消息（自定义消息通知）

如无说明，默认都是透传消息。

其中友盟的安卓手机通知会发送两次通知，一次是消息通知，一次为透传通知

其中个推只要设置了扩展参数，就会发送透传消息，否则为默认通知。