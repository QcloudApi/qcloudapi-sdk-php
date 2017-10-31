### qcloudapi-sdk-php

qcloudapi-sdk-php 是为了让 PHP 开发者能够在自己的代码里更快捷方便的使用腾讯云的 API 而开发的 SDK 工具包。

#### 更新历史

* [2017/10/30] 新增bgpip模块
* [2017/9/11] 新增Bmeip和Bmvpc模块
* [2017/8/7] 新增Feecenter模块
* [2017/7/31] 新增Bmlb模块
* [2017/7/12] 回滚：不默认传Version参数
* [5/19]设置接口默认Version： Cvm模块新版本API已经上线，通过是否传Version区分新旧版本。SDK默认调用新接口，因此需要增加Version的默认设置。 CvmAPI接口介绍见：https://www.qcloud.com/document/api/213/569
* [3/1]增加对HmacSHA1签名和HmacSHA256签名兼容的支持
* [7/15]增加Tdsql模块
* [7/6] 增加Cmem模块
* [6/17] 增加account模块
* [5/25] 添加Cbs、Snapshot和Scaling模块

#### 资源

* [公共参数](http://wiki.qcloud.com/wiki/%E5%85%AC%E5%85%B1%E5%8F%82%E6%95%B0)
* [API列表](http://wiki.qcloud.com/wiki/API)
* [错误码](http://wiki.qcloud.com/wiki/%E9%94%99%E8%AF%AF%E7%A0%81)

#### 入门

1. 申请安全凭证。
在第一次使用云 API 之前，用户首先需要在腾讯云网站上申请安全凭证，安全凭证包括 SecretId 和 SecretKey, SecretId 是用于标识 API 调用者的身份，SecretKey是用于加密签名字符串和服务器端验证签名字符串的密钥。SecretKey 必须严格保管，避免泄露。

2. 下载SDK，放入到您的程序目录。
[在 github 查看 >>](https://github.com/QcloudApi/qcloudapi-sdk-php)
[下载 PHP SDK >>](https://mc.qcloudimg.com/static/archive/cd1857b4d9a9aeb0179e72a59f235c41/qcloudapi-sdk-php-master.zip)

使用方法请参考下面的例子。

#### 例子

    <?php
    require_once './src/QcloudApi/QcloudApi.php';

    $config = array('SecretId'       => '你的secretId',
                    'SecretKey'      => '你的secretKey',
                    'RequestMethod'  => 'GET',
                    'DefaultRegion'  => '区域参数');

    // 第一个参数表示使用哪个域名
    // 已有的模块列表：
    // QcloudApi::MODULE_CVM      对应   cvm.api.qcloud.com
    // QcloudApi::MODULE_CDB      对应   cdb.api.qcloud.com
    // QcloudApi::MODULE_LB       对应   lb.api.qcloud.com
    // QcloudApi::MODULE_TRADE    对应   trade.api.qcloud.com
    // QcloudApi::MODULE_SEC      对应   csec.api.qcloud.com
    // QcloudApi::MODULE_IMAGE    对应   image.api.qcloud.com
    // QcloudApi::MODULE_MONITOR  对应   monitor.api.qcloud.com
    // QcloudApi::MODULE_CDN      对应   cdn.api.qcloud.com
    $service = QcloudApi::load(QcloudApi::MODULE_CVM, $config);

    // 请求参数，请参考wiki文档上对应接口的说明
    $package = array('offset' => 0,
                     'limit' => 3,
                     // 'Region' => 'gz', // 当Region不是上面配置的DefaultRegion值时，可以重新指定请求的Region
                     'SignatureMethod' => 'HmacSHA256',//指定所要用的签名算法，可选HmacSHA256或HmacSHA1，默认为HmacSHA1
                     );

    // 请求前可以通过下面四个方法重新设置请求的secretId/secretKey/region/method参数
    // 重新设置secretId
    $secretId = '你的secretId';
    $service->setConfigSecretId($secretId);
    // 重新设置secretKey
    $secretKey = '你的secretKey';
    $service->setConfigSecretKey($secretKey);
    // 重新设置region
    $region = 'sh';
    $service->setConfigDefaultRegion($region);
    // 重新设置method
    $method = 'POST';
    $service->setConfigRequestMethod($method);

    // 请求方法为对应接口的接口名，请参考wiki文档上对应接口的接口名
    $a = $service->DescribeInstances($package);

    // 生成请求的URL，不发起请求
    $a = $service->generateUrl('DescribeInstances', $package);

    if ($a === false) {
        // 请求失败，解析错误信息
        $error = $service->getError();
        echo "Error code:" . $error->getCode() . ' message:' . $error->getMessage();

        // 对于异步任务接口，可以通过下面的方法获取对应任务执行的信息
        $detail = $error->getExt();
    } else {
        // 请求成功
        var_dump($a);
    }
