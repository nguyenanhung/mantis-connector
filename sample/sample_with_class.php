<?php
/**
 * Project mantis-connector
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 2/10/20
 * Time: 15:27
 */
require_once __DIR__ . '/../vendor/autoload.php';

// Cấu hình Monitor
$config = array(
    'monitorUrl'       => 'xxx',
    'monitorUser'      => 'xxx',
    'monitorPassword'  => 'xxx',
    'monitorProjectId' => 1,
    'monitorUsername'  => 'hungna',
);
$base = new nguyenanhung\MantisBT\MantisConnector();
$base->setMonitorUrl($config['monitorUrl'])->setMonitorUser($config['monitorUser'])->setMonitorPassword($config['monitorPassword'])->setProjectId($config['monitorProjectId'])->setUsername($config['monitorUsername']);
$result = $base->mantis('Tên bug', 'Mô tả bug');

echo "<pre>";
print_r($result);
echo "</pre>";
