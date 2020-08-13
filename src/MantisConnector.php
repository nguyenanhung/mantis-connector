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
class MantisConnector implements MantisConnectorInterface
{
    public  $debugStatus     = FALSE;
    public  $debugLevel      = NULL;
    public  $loggerPath      = NULL;
    private $logger;
    private $benchmark;
    private $projectId       = NULL;
    private $username        = NULL;
    private $monitorUrl      = NULL;
    private $monitorUser     = NULL;
    private $monitorPassword = NULL;

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
     * @return mixed|string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 2/10/20 57:44
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
     * @return $this|mixed
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 2/10/20 58:44
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
     * @return $this|mixed
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 2/10/20 58:55
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
     * @return $this|mixed
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 2/10/20 58:59
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
     * @return $this|mixed
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 2/10/20 59:08
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
     * @return $this|mixed
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 2/10/20 59:18
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
     * @return array|bool|mixed|null|string TRUE là thành công
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 2/10/20 12:18
     */
    public function mantis($summary = 'Bug', $desc = 'Bug', $category = 'General', $priority = 40, $severity = 60)
    {
        if (empty($desc)) {
            $desc = $summary;
        }
        if (empty($priority)) {
            $priority = 40;
        }
        if (empty($severity)) {
            $severity = 60;
        }
        if (empty($category)) {
            $category = 'General';
        }
        $issue = array(
            'project'         => array('id' => $this->projectId),
            'priority'        => array('id' => $priority),
            'severity'        => array('id' => $severity),
            'handler'         => array('name' => $this->username),
            'reproducibility' => array('id' => 10),
            'category'        => $category,
            'summary'         => $summary,
            'description'     => $desc
        );
        $data  = array(
            'username' => $this->monitorUser,
            'password' => $this->monitorPassword,
            'issue'    => $issue
        );
        // SOAP Request
        try {
            $client                   = new nusoap_client($this->monitorUrl, TRUE);
            $client->soap_defencoding = self::SOAP_ENCODING;
            $client->xml_encoding     = self::XML_ENCODING;
            $client->decode_utf8      = self::DECODE_UTF8;
            $error                    = $client->getError();
            if ($error) {
                $error_message = "Client Request WSDL Error: " . json_encode($error);
                if (function_exists('log_message')) {
                    log_message('error', $error_message);
                }
                $result = FALSE;
            } else {
                $result = $client->call('mc_issue_add', $data);
                if (isset($result['data']) && is_integer($result['data'])) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        }
        catch (Exception $e) {
            if (function_exists('log_message')) {
                log_message('error', 'Error Message: ' . $e->getMessage());
                log_message('error', 'Error Trace As String: ' . $e->getTraceAsString());
            }
            $result = NULL;
        }

        return $result;
    }
}
