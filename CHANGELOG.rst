==========
CHANGE LOG
==========

latest (now)
============

2.0.9 (2018-08-03)
==================

* fix undefined warning

2.0.8 (2018-07-18)
==================

* support dynamic module: Now user can directly use any product's API, no longer require adding its source code file in src/QcloudApi/Module.

2.0.7 (2018-04-16)
==================

* add ccr module

2.0.6 (2018-03-02)
==================

* add emr module
* add tbaas module
* add athena module

2.0.5 (2018-02-06)
==================

* add sts module
* add partners module

2.0.4 (2017-12-28)
==================

* add redis module
* add batch module
* add ccs module

2.0.3 (2017-12-27)
==================

* add tmt module
* add apigateway module
* add dfw module
* add scf module

history
=======

* [2017/11/16] 新增Cloudaudit模块
* [2017/10/30] 新增Bgpip模块
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
