# qcloudapi-sdk-php

qcloudapi-sdk-php是为了让PHP开发者能够在自己的代码里更快捷方便的使用腾讯云的API而开发的SDK工具包。

## 资源

* [公共参数](http://wiki.qcloud.com/wiki/%E5%85%AC%E5%85%B1%E5%8F%82%E6%95%B0)
* [API列表](http://wiki.qcloud.com/wiki/API)
* [错误码](http://wiki.qcloud.com/wiki/%E9%94%99%E8%AF%AF%E7%A0%81)

## 入门

1. 申请安全凭证。
在第一次使用云API之前，用户首先需要在腾讯云网站上申请安全凭证，安全凭证包括 SecretId 和 SecretKey, SecretId 是用于标识 API 调用者的身份，SecretKey是用于加密签名字符串和服务器端验证签名字符串的密钥。SecretKey 必须严格保管，避免泄露。

2. 下载SDK，放入到您的程序目录。
使用方法请参考下面的例子。

## 例子

    <?php
    require_once './src/QcloudApi/QcloudApi.php';

    $config = array('SecretId'       => '你的secretId',
                    'SecretKey'      => '你的secretKey',
                    'RequestMethod'  => 'GET',
                    'DefaultRegion'  => 'gz');

    // 第一个参数表示使用哪个域名，例如：
    // QcloudApi::MODULE_CVM      对应   cvm.api.qcloud.com
    // 对于没有被显式定义的模块，你也可以使用动态模块，例如：
    // $service = QcloudApi::load("ckafka", $config);
    $service = QcloudApi::load(QcloudApi::MODULE_CVM, $config);

    // 请求参数，请参考wiki文档上对应接口的说明
    $package = array('offset' => 0,
                     'limit' => 3,
                     // 'Region' => 'sh', // 当Region不是上面配置的DefaultRegion值时，可以重新指定请求的Region
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

## 动态模块

以前SDK需要把每一个产品都建一个类文件，指定域名，这虽然加强了合法性检查，但是新产品上线后，可能没有同步到SDK，造成开发者使用不便。2.0.8及更高的版本支持动态模块，你可以直接按模块名初始化一个service对象，例如：``$service = QcloudApi::load("ckafka", $config);``，这里ckafka并未有对应的类文件，但是仍然可以初始化成功并执行接下来的接口调用。注意，代码中实际上是把模块名拼接API的根域名进行调用的，而极个别的产品其模块名和域名不对应，典型的如cmq的域名首部是带地域信息的，此时模块名应该遵从域名首部。
