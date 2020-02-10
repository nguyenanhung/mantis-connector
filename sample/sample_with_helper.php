<?php
/**
 * Project mantis-connector
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 2/10/20
 * Time: 15:16
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
$result = mantis_report($config, 'Tên bug', 'Mô tả  chi tiết');

echo "<pre>";
print_r($result);
echo "</pre>";