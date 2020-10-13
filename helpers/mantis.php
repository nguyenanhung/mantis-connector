<?php
/**
 * Project mantis-connector
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 2/10/20
 * Time: 15:14
 */
if (!function_exists('mantis_report')) {
    /**
     * Function mantis_report
     *
     * @param array  $config   Cấu hình config của Monitor
     * @param string $summary  Thông tin Bug
     * @param string $desc     Thông tin chi tiết
     * @param string $category Phân loại bug
     * @param int    $priority Trọng số ưu tiên
     * @param int    $severity Level lỗi
     *
     * @return array|bool|mixed|string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 2/10/20 19:55
     */
    function mantis_report($config = array(), $summary = 'Bug', $desc = 'Bug', $category = 'General', $priority = 40, $severity = 60)
    {
        $base = new nguyenanhung\MantisBT\MantisConnector();
        $base->setMonitorUrl($config['monitorUrl'])->setMonitorUser($config['monitorUser'])->setMonitorPassword($config['monitorPassword'])->setProjectId($config['monitorProjectId'])->setUsername($config['monitorUsername']);

        return $base->mantis($summary, $desc, $category, $priority, $severity);
    }
}
