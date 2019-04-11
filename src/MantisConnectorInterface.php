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
    const VERSION             = '1.0.5';
    const LAST_MODIFIED       = '2019-04-11';
    const AUTHOR_NAME         = 'Hung Nguyen';
    const AUTHOR_EMAIL        = 'dev@nguyenanhung.com';
    const PROJECT_NAME        = 'Mantis Bug Tracker Connector';
    const TIMEZONE            = 'Asia/Ho_Chi_Minh';
    const REQUEST_TIMEOUT     = 60;
    const EXIT_SUCCESS        = 0; // no errors
    const EXIT_ERROR          = 1; // generic error
    const EXIT_CONFIG         = 3; // configuration error
    const EXIT_UNKNOWN_FILE   = 4; // file not found
    const EXIT_UNKNOWN_CLASS  = 5; // unknown class
    const EXIT_UNKNOWN_METHOD = 6; // unknown class member
    const EXIT_USER_INPUT     = 7; // invalid user input
    const EXIT_DATABASE       = 8; // database error
    const EXIT__AUTO_MIN      = 9; // lowest automatically-assigned error code
    const EXIT__AUTO_MAX      = 125; // highest automatically-assigned error code
    const USE_BENCHMARK       = FALSE;
    const USE_DEBUG           = FALSE;

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
     * @param string $summary
     * @param string $description
     * @param string $category
     * @param int    $priority
     * @param int    $severity
     *
     * @return mixed
     */
    public function mantis($summary = 'Bug', $description = 'Bug', $category = 'General', $priority = 40, $severity = 60);
}
