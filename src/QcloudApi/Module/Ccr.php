<?php
require_once QCLOUDAPI_ROOT_PATH . '/Module/Base.php';
/**
 * https://cloud.tencent.com/document/product/457/9427
 */
class QcloudApi_Module_Ccr extends QcloudApi_Module_Base
{
    /**
     * $_serverHost
     * 接口域名
     * @var string
     */
    protected $_serverHost = 'ccr.api.qcloud.com';
}
