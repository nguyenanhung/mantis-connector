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
     * @return bool
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/24/2021 33:30
     */
    function mantis_report($config = array(), $summary = 'Bug', $desc = 'Bug', $category = 'General', $priority = 40, $severity = 60)
    {
        $base = new nguyenanhung\MantisBT\MantisConnector();
        $base->setMonitorUrl($config['monitorUrl'])->setMonitorUser($config['monitorUser'])->setMonitorPassword($config['monitorPassword'])->setProjectId($config['monitorProjectId'])->setUsername($config['monitorUsername']);

        return $base->mantis($summary, $desc, $category, $priority, $severity);
    }
}
if (!function_exists('setup_mantis_bug_tracker')) {
    /**
     * Function setup_mantis_bug_tracker
     *
     * @param array $options Mảng cấu hình Monitor
     *
     * @return \nguyenanhung\MantisBT\MantisConnector
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 07/03/2023 49:57
     */
    function setup_mantis_bug_tracker($options = array())
    {
        $mantis = new nguyenanhung\MantisBT\MantisConnector();
        $mantis->setMonitorUrl($options['monitorUrl']);
        $mantis->setMonitorUser($options['monitorUser']);
        $mantis->setMonitorPassword($options['monitorPassword']);
        $mantis->setProjectId($options['monitorProjectId']);
        $mantis->setUsername($options['monitorUsername']);
        $mantis->__construct();

        return $mantis;
    }
}
