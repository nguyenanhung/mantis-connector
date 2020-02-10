<?php
/**
 * Project mantis-connector.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 11/11/18
 * Time: 13:48
 */

namespace nguyenanhung\MantisBT;

/**
 * Interface MantisConnectorInterface
 *
 * @package   nguyenanhung\MantisBT
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
interface MantisConnectorInterface
{
    const VERSION       = '1.0.6';
    const LAST_MODIFIED = '2020-02-10';
    const AUTHOR_NAME   = 'Hung Nguyen';
    const AUTHOR_EMAIL  = 'dev@nguyenanhung.com';
    const PROJECT_NAME  = 'Mantis Bug Tracker Connector';
    const TIMEZONE      = 'Asia/Ho_Chi_Minh';
    const SOAP_ENCODING = 'utf-8';
    const XML_ENCODING  = 'utf-8';
    const DECODE_UTF8   = FALSE;

    /**
     * Hàm lấy thông tin phiên bản Package
     *
     * @author  : 713uk13m <dev@nguyenanhung.com>
     * @time    : 10/13/18 15:12
     *
     * @return mixed|string Current Project Version, VD: 0.1.0
     */
    public function getVersion();

    /**
     * Function setMonitorUrl
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/8/18 19:08
     *
     * @param string $monitorUrl
     *
     * @return mixed
     */
    public function setMonitorUrl($monitorUrl = '');

    /**
     * Function setMonitorUser
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/8/18 19:08
     *
     * @param string $monitorUser
     *
     * @return mixed
     */
    public function setMonitorUser($monitorUser = '');

    /**
     * Function setMonitorPassword
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/8/18 19:09
     *
     * @param string $monitorPassword
     *
     * @return mixed
     */
    public function setMonitorPassword($monitorPassword = '');

    /**
     * Function setProjectId
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/8/18 19:09
     *
     * @param string $projectId
     *
     * @return mixed
     */
    public function setProjectId($projectId = '');

    /**
     * Function setUsername
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/8/18 19:09
     *
     * @param string $username
     *
     * @return mixed
     */
    public function setUsername($username = '');

    /**
     * Function mantis
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/8/18 19:16
     *
     * @param string $summary     Thông tin Bug
     * @param string $description Thông tin chi tiết
     * @param string $category    Phân loại bug
     * @param int    $priority    Trọng số ưu tiên
     * @param int    $severity    Level lỗi
     *
     * @return mixed
     */
    public function mantis($summary = 'Bug', $description = 'Bug', $category = 'General', $priority = 40, $severity = 60);
}
