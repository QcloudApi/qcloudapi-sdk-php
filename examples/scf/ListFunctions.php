<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once dirname(__FILE__).'/../../src/QcloudApi/QcloudApi.php';


$config = array('SecretId'       => getenv('TENCENTCLOUD_SECRET_ID'),
                'SecretKey'      => getenv('TENCENTCLOUD_SECRET_KEY'),
                'RequestMethod'  => 'GET',
                'DefaultRegion'  => 'gz');

$scf = QcloudApi::load(QcloudApi::MODULE_SCF, $config);

$package = array('SignatureMethod' =>'HmacSHA256');

$a = $scf->ListFunctions($package);

if ($a === false) {
    $error = $scf->getError();
    echo "Error code:" . $error->getCode() . ".\n";
    echo "message:" . $error->getMessage() . ".\n";
    echo "ext:" . var_export($error->getExt(), true) . ".\n";
} else {
    var_dump($a);
}

echo "\nRequest :" . $scf->getLastRequest();
echo "\nResponse :" . $scf->getLastResponse();
echo "\n";
