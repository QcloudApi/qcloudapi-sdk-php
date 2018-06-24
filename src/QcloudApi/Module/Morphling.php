<?php
require_once QCLOUDAPI_ROOT_PATH . '/Module/Base.php';
/**
 * QcloudApi_Module_Morphling
 * 动态模块，可以变为任意模块使用
 */
class QcloudApi_Module_Morphling extends QcloudApi_Module_Base
{
    /**
     * 设置接口域名
     * @param string $module
     */
    public function setServerHost($module)
    {
        $this->_serverHost = $module . '.api.qcloud.com';
        return $this;
    }
}
