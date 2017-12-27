<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once dirname(__FILE__).'/../../src/QcloudApi/QcloudApi.php';


$config = array('SecretId'       => getenv('TENCENTCLOUD_SECRET_ID'),
                'SecretKey'      => getenv('TENCENTCLOUD_SECRET_KEY'),
                'RequestMethod'  => 'GET',
                'DefaultRegion'  => 'gz');

$dfw = QcloudApi::load(QcloudApi::MODULE_DFW, $config);

$package = array('SignatureMethod' =>'HmacSHA256');

$a = $dfw->DescribeSecurityGroups($package);

if ($a === false) {
    $error = $dfw->getError();
    echo "Error code:" . $error->getCode() . ".\n";
    echo "message:" . $error->getMessage() . ".\n";
    echo "ext:" . var_export($error->getExt(), true) . ".\n";
} else {
    var_dump($a);
}

echo "\nRequest :" . $dfw->getLastRequest();
echo "\nResponse :" . $dfw->getLastResponse();
echo "\n";
