<?php
/**
 * Project mantis-connector.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 11/11/18
 * Time: 13:48
 */

namespace nguyenanhung\MantisBT\Interfaces;

/**
 * Interface MantisConnectorInterface
 *
 * @package   nguyenanhung\MantisBT\Interfaces
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
interface MantisConnectorInterface
{
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
