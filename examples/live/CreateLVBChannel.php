<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once dirname(__FILE__).'/../../src/QcloudApi/QcloudApi.php';


$config = array('SecretId'       => getenv('TENCENTCLOUD_SECRET_ID'),
                'SecretKey'      => getenv('TENCENTCLOUD_SECRET_KEY'),
                'RequestMethod'  => 'GET',
                'DefaultRegion'  => 'ap-guangzhou');

$api = QcloudApi::load(QcloudApi::MODULE_LIVE, $config);

$package = array(
    'SignatureMethod' => 'HmacSHA256',
    'channelName' => 'test',
    'outputSourceType' => 1,
    'sourceList.0.name' => 'test',
    'sourceList.0.type' => 1,
);

$rsp = $api->CreateLVBChannel($package);

if ($rsp === false) {
    $error = $api->getError();
    echo "Error code:" . $error->getCode() . ".\n";
    echo "message:" . $error->getMessage() . ".\n";
    echo "ext:" . var_export($error->getExt(), true) . ".\n";
} else {
    var_dump($rsp);
}

echo "\nRequest :" . $api->getLastRequest();
echo "\nResponse :" . $api->getLastResponse();
echo "\n";
