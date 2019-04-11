<?php
/**
 * Project mantis-connector.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 11/11/18
 * Time: 13:48
 */

namespace nguyenanhung\MantisBT;

use nguyenanhung\MyDebug\Debug;
use nguyenanhung\MyDebug\Benchmark;
use nguyenanhung\MyRequests\SoapRequest;
use nguyenanhung\MantisBT\Interfaces\ProjectInterface;
use nguyenanhung\MantisBT\Interfaces\MantisConnectorInterface;

/**
 * Class MantisConnector
 *
 * @package   nguyenanhung\MantisBT
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class MantisConnector implements ProjectInterface, MantisConnectorInterface
{
    public $debugStatus = FALSE;
    public $debugLevel  = NULL;
    public $loggerPath  = NULL;
    /** @var object \nguyenanhung\MyDebug\Debug */
    private $logger;
    /** @var object \nguyenanhung\MyDebug\Benchmark */
    private $benchmark;
    private $projectId       = NULL;
    private $username        = NULL;
    private $monitorUrl      = NULL;
    private $monitorUser     = NULL;
    private $monitorPassword = NULL;

    /**
     * MantisConnector constructor.
     */
    public function __construct()
    {
        if (self::USE_BENCHMARK === TRUE) {
            $this->benchmark = new Benchmark();
            $this->benchmark->mark('code_start');
        }
        $this->logger = new Debug();
        $this->logger->setLoggerSubPath(__CLASS__);
        if ($this->debugStatus === TRUE) {
            $this->logger->setDebugStatus($this->debugStatus);
            if (!empty($this->loggerLevel)) {
                $this->logger->setGlobalLoggerLevel($this->loggerLevel);
            }
            if (!empty($this->loggerPath)) {
                $this->logger->setLoggerPath($this->loggerPath);
            }
        }
        $this->logger->setLoggerFilename('Log-' . date('Y-m-d') . '.log');
    }

    /**
     * MantisConnector destructor.
     */
    public function __destruct()
    {
        if (self::USE_BENCHMARK === TRUE) {
            $this->benchmark->mark('code_end');
            $this->logger->debug(__FUNCTION__, 'Elapsed Time: ===> ' . $this->benchmark->elapsed_time('code_start', 'code_end'));
            $this->logger->debug(__FUNCTION__, 'Memory Usage: ===> ' . $this->benchmark->memory_usage());
        }
    }

    /**
     * Function getVersion
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/11/18 13:50
     *
     * @return mixed|string
     */
    public function getVersion()
    {
        return self::VERSION;
    }

    /**
     * Function setMonitorUrl
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/11/18 13:50
     *
     * @param string $monitorUrl
     *
     * @return $this|mixed
     */
    public function setMonitorUrl($monitorUrl = '')
    {
        $this->monitorUrl = $monitorUrl;
        $this->logger->debug(__FUNCTION__, 'setMonitorUrl: ', $this->monitorUrl);

        return $this;
    }

    /**
     * Function setMonitorUser
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/11/18 13:51
     *
     * @param string $monitorUser
     *
     * @return $this|mixed
     */
    public function setMonitorUser($monitorUser = '')
    {
        $this->monitorUser = $monitorUser;
        $this->logger->debug(__FUNCTION__, 'setMonitorUser: ', $this->monitorUser);

        return $this;
    }

    /**
     * Function setMonitorPassword
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/11/18 13:51
     *
     * @param string $monitorPassword
     *
     * @return $this|mixed
     */
    public function setMonitorPassword($monitorPassword = '')
    {
        $this->monitorPassword = $monitorPassword;
        $this->logger->debug(__FUNCTION__, 'setMonitorPassword: ', $this->monitorPassword);

        return $this;
    }

    /**
     * Function setProjectId
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/11/18 13:51
     *
     * @param string $projectId
     *
     * @return $this|mixed
     */
    public function setProjectId($projectId = '')
    {
        $this->projectId = $projectId;
        $this->logger->info(__FUNCTION__, 'setProjectId: ', $this->projectId);

        return $this;
    }

    /**
     * Function setUsername
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/11/18 13:52
     *
     * @param string $username
     *
     * @return $this|mixed
     */
    public function setUsername($username = '')
    {
        $this->username = $username;
        $this->logger->debug(__FUNCTION__, 'setUsername: ', $this->username);

        return $this;
    }

    /**
     * Function mantis
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/11/18 13:52
     *
     * @param string $summary
     * @param string $desc
     * @param string $category
     * @param int    $priority
     * @param int    $severity
     *
     * @return array|bool|mixed|null|string TRUE là thành công
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
        $issue_data = [
            'project'         => ['id' => $this->projectId],
            'priority'        => ['id' => $priority],
            'severity'        => ['id' => $severity],
            'handler'         => ['name' => $this->username],
            'reproducibility' => ['id' => 10],
            'category'        => $category,
            'summary'         => $summary,
            'description'     => $desc
        ];
        $data       = [
            'username' => $this->monitorUser,
            'password' => $this->monitorPassword,
            'issue'    => $issue_data
        ];
        // SOAP Request
        try {
            $soap                  = new SoapRequest();
            $soap->debugStatus     = $this->debugStatus;
            $soap->debugLoggerPath = $this->loggerPath;
            $soap->__construct();
            $soap->setEndpoint($this->monitorUrl);
            $soap->setCallFunction('mc_issue_add');
            $soap->setData($data);
            $result = $soap->clientRequestWsdl();
            $this->logger->debug(__FUNCTION__, 'Result from Mantis Tracking: ', $result);
            if (isset($result['data']) && is_integer($result['data'])) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
        catch (\Exception $e) {
            $error_message = 'Error File: ' . $e->getFile() . ' - Line: ' . $e->getLine() . ' - Code: ' . $e->getCode() . ' - Message: ' . $e->getMessage();
            $this->logger->error(__FUNCTION__, $error_message);
            $result = NULL;
        }

        return $result;
    }
}
