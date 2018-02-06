<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once dirname(__FILE__).'/../../src/QcloudApi/QcloudApi.php';


$config = array('SecretId'       => getenv('TENCENTCLOUD_SECRET_ID'),
                'SecretKey'      => getenv('TENCENTCLOUD_SECRET_KEY'),
                'RequestMethod'  => 'GET',
                'DefaultRegion'  => 'gz');

$api = QcloudApi::load(QcloudApi::MODULE_STS, $config);

$package = array(
    'SignatureMethod' =>'HmacSHA256',
    'policy' => '{"statement":[{"action":["name/cos:GetObject","name/cos:PutObject"],"effect":"allow","resource":["qcs::cos:cn-north:uin/3411212962:prefix//3411212962/sevenyou/*"]}],"version":"2.0"}',
    'name' => 'test',
);

$rsp = $api->GetFederationToken($package);

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
