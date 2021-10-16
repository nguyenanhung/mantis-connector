<?php
/**
 * Project mantis-connector.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 11/11/18
 * Time: 13:48
 */

namespace nguyenanhung\MantisBT;

use Exception;
use nguyenanhung\MyNuSOAP\nusoap_client;

/**
 * Class MantisConnector
 *
 * @package   nguyenanhung\MantisBT
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class MantisConnector
{
    const VERSION       = '1.1.3';
    const LAST_MODIFIED = '2021-10-16';
    const AUTHOR_NAME   = 'Hung Nguyen';
    const AUTHOR_EMAIL  = 'dev@nguyenanhung.com';
    const PROJECT_NAME  = 'Mantis Bug Tracker Connector';
    const TIMEZONE      = 'Asia/Ho_Chi_Minh';
    const SOAP_ENCODING = 'utf-8';
    const XML_ENCODING  = 'utf-8';
    const DECODE_UTF8   = false;

    public    $debugStatus = false;
    public    $debugLevel;
    public    $loggerPath;
    protected $logger;
    protected $benchmark;
    protected $projectId;
    protected $username;
    protected $monitorUrl;
    protected $monitorUser;
    protected $monitorPassword;

    /**
     * MantisConnector constructor.
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     */
    public function __construct()
    {
    }

    /**
     * Function getVersion
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/24/2021 35:04
     */
    public function getVersion()
    {
        return self::VERSION;
    }

    /**
     * Function Benchmark
     *
     * @return mixed
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     */
    public function getBenchmark()
    {
        return $this->benchmark;
    }

    /**
     * Function Logger
     *
     * @return mixed
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * Function DebugLevel
     *
     * @return null
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     */
    public function getDebugLevel()
    {
        return $this->debugLevel;
    }

    /**
     * Function LoggerPath
     *
     * @return null
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     */
    public function getLoggerPath()
    {
        return $this->loggerPath;
    }

    /**
     * Function DebugStatus
     *
     * @return bool
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     */
    public function isDebugStatus()
    {
        return $this->debugStatus;
    }

    /**
     * Function setMonitorUrl
     *
     * @param string $monitorUrl
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/24/2021 36:02
     */
    public function setMonitorUrl($monitorUrl = '')
    {
        $this->monitorUrl = $monitorUrl;

        return $this;
    }

    /**
     * Function setMonitorUser
     *
     * @param string $monitorUser
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/24/2021 35:59
     */
    public function setMonitorUser($monitorUser = '')
    {
        $this->monitorUser = $monitorUser;

        return $this;
    }

    /**
     * Function setMonitorPassword
     *
     * @param string $monitorPassword
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/24/2021 35:57
     */
    public function setMonitorPassword($monitorPassword = '')
    {
        $this->monitorPassword = $monitorPassword;

        return $this;
    }

    /**
     * Function setProjectId
     *
     * @param string $projectId
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/24/2021 35:54
     */
    public function setProjectId($projectId = '')
    {
        $this->projectId = $projectId;

        return $this;
    }

    /**
     * Function setUsername
     *
     * @param string $username
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/24/2021 35:51
     */
    public function setUsername($username = '')
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Function mantis
     *
     * @param string $summary  Thông tin Bug
     * @param string $desc     Thông tin chi tiết
     * @param string $category Phân loại bug
     * @param int    $priority Trọng số ưu tiên
     * @param int    $severity Level lỗi
     *
     * @return bool TRUE là thành công
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 10/13/2020 19:43
     */
    public function mantis($summary = 'Bug', $desc = 'Bug', $category = 'General', $priority = 40, $severity = 60)
    {
        if (empty($desc)) {
            $desc = $summary;
        }

        $issue = array(
            'project'         => array(
                'id' => $this->projectId
            ),
            'priority'        => array(
                'id' => $priority
            ),
            'severity'        => array(
                'id' => $severity
            ),
            'handler'         => array(
                'name' => $this->username
            ),
            'reproducibility' => array(
                'name' => 'always'
            ),
            'category'        => $category,
            'summary'         => $summary,
            'description'     => $desc
        );
        $data  = array(
            'username' => $this->monitorUser,
            'password' => $this->monitorPassword,
            'issue'    => $issue
        );

        try {
            $client                   = new nusoap_client($this->monitorUrl, true);
            $client->soap_defencoding = self::SOAP_ENCODING;
            $client->xml_encoding     = self::XML_ENCODING;
            $client->decode_utf8      = self::DECODE_UTF8;
            $error                    = $client->getError();
            if ($error) {
                if (function_exists('log_message')) {
                    log_message('error', "Client Request WSDL Error: " . json_encode($error));
                }

                return false;
            }
            $result = $client->call('mc_issue_add', $data);

            return isset($result) && is_int($result);
        } catch (Exception $e) {
            if (function_exists('log_message')) {
                log_message('error', 'Error Message: ' . $e->getMessage());
                log_message('error', 'Error Trace As String: ' . $e->getTraceAsString());
            }

            return false;
        }
    }
}
