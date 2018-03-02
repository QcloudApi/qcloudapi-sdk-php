<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once dirname(__FILE__).'/../../src/QcloudApi/QcloudApi.php';


$config = array('SecretId'       => getenv('TENCENTCLOUD_SECRET_ID'),
                'SecretKey'      => getenv('TENCENTCLOUD_SECRET_KEY'),
                'RequestMethod'  => 'GET',
                'DefaultRegion'  => 'gz');

$api = QcloudApi::load(QcloudApi::MODULE_ATHENA, $config);

$package = array(
    'SignatureMethod' =>'HmacSHA256',
    'InstanceId' => '4d8573a2-ff42-11e7-8858-525400bb7b8b',
    'AccessChannelCode' => 'default',
);

$rsp = $api->WelcomeMessage($package);

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
