<?php
require_once './src/QcloudApi/QcloudApi.php';

$config = array('SecretId'       => getenv("QCLOUD_SECRET_ID"), //'你的secretId',需要在环境变量中设置
                'SecretKey'      => getenv("QCLOUD_SECRET_KEY"), //'你的secretKey',需要在环境变量中设置
                'RequestMethod'  => 'GET',
                'DefaultRegion'  => 'gz');

// ckafa is not explicitly supported in src/QcloudApi/Module
$ckafka = QcloudApi::load("ckafka", $config);

$a = $ckafka->ListInstance();

if ($a === false) {
    $error = $ckafka->getError();
    echo "Error code:" . $error->getCode() . ".\n";
    echo "message:" . $error->getMessage() . ".\n";
    echo "ext:" . var_export($error->getExt(), true) . ".\n";
}

echo "Request: " . $ckafka->getLastRequest();
echo "\nResponse: " . $ckafka->getLastResponse();
echo "\n";
