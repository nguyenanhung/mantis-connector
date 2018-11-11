<?php
/**
 * Project mantis-connector.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 11/11/18
 * Time: 13:55
 */
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../functions.php';

$connect              = new \nguyenanhung\MantisBT\MantisConnector();
$connect->debugStatus = TRUE;
$connect->loggerPath  = testLogPath();
$connect->__construct();

$result = $connect
    ->setMonitorUrl('http://xxxx.mantis.com/api/soap/mantisconnect.php?wsdl')
    ->setMonitorUser('td_report_mantis')
    ->setMonitorPassword('td_report_mantis_password')
    ->setProjectId(30)
    ->setUsername('user_name_nhan_report')
    ->mantis(
        'Đây là con bug khủng',
        'Nội dung mô tả bug',
        'General',
        40,
        60
    );

d($result);
