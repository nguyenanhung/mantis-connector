[![Latest Stable Version](https://poser.pugx.org/nguyenanhung/mantis-connector/v)](https://packagist.org/packages/nguyenanhung/mantis-connector)
[![Latest Unstable Version](https://poser.pugx.org/nguyenanhung/mantis-connector/v/unstable)](https://packagist.org/packages/nguyenanhung/mantis-connector)
[![Total Downloads](https://poser.pugx.org/nguyenanhung/mantis-connector/downloads)](https://packagist.org/packages/nguyenanhung/mantis-connector)
[![License](https://poser.pugx.org/nguyenanhung/mantis-connector/license)](https://packagist.org/packages/nguyenanhung/mantis-connector)
[![Monthly Downloads](https://poser.pugx.org/nguyenanhung/mantis-connector/d/monthly)](https://packagist.org/packages/nguyenanhung/mantis-connector)
[![Daily Downloads](https://poser.pugx.org/nguyenanhung/mantis-connector/d/daily)](https://packagist.org/packages/nguyenanhung/mantis-connector)
[![composer.lock](https://poser.pugx.org/nguyenanhung/mantis-connector/composerlock)](https://packagist.org/packages/nguyenanhung/mantis-connector)

# Mantis Bug Tracker Connector

## Version

- [x] V1.x support all PHP version `>=5.4`
- [x] V2.x support all PHP version `>=7.0`

## Cài packages vào trong repositories

```http
composer require nguyenanhung/mantis-connector
```

## Hướng dẫn sử dụng

### Quick Function

Tham khảo đoạn code bên dưới

```php
<?php
/**
 * Project mantis-connector
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 2/10/20
 * Time: 15:16
 */
require_once __DIR__ . '/vendor/autoload.php';

// Cấu hình Monitor
$config = array(
    'monitorUrl'       => 'xxx',
    'monitorUser'      => 'xxx',
    'monitorPassword'  => 'xxx',
    'monitorProjectId' => 1,
    'monitorUsername'  => 'hungna',
);
$result = mantis_report($config, 'Tên bug', 'Mô tả  chi tiết');
```

### With Class

Tham khảo đoạn code bên dưới

```php
<?php
/**
 * Project mantis-connector
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 2/10/20
 * Time: 15:27
 */
require_once __DIR__ . '/vendor/autoload.php';

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

```

## Liên hệ

| STT  | Họ tên         | SĐT           | Email           | Skype            |
| ---- | -------------- | ------------- | --------------- | ---------------- |
| 1    | Nguyễn An Hưng | 033 295 3760 | hungna@gviet.vn | nguyenanhung5891 |
