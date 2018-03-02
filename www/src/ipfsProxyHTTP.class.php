<?php
/**
 * 2017-2018 ipns.co
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 *
 * @author    Wandrille RONCE <contact@ipns.co>
 * @copyright 2017-2018 ipns.co
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */


class ipfsProxyHTTP {

    /**
     * @var getipfs
     */
    private static $instance = null;

    /**
     * @var string
     */
    protected $uri = null;

    /**
     * @var string
     */
    protected $ipfs_uri = null;

    /**
     * @var bool
     */
    protected $check_host = CHECK_HOST;

    /**
     * @var bool
     */
    protected $ssl_verify_host = true;

    /**
     * @var bool
     */
    protected $ssl_verify_peer = false;

    /**
     * @var int
     */
    protected $timeout = CHECK_HOST_TIMEOUT;

    /**
     * getipfs constructor.
     * @param $uri
     */
    public function __construct($uri) {
        $this->uri = $uri;
    }

    /**
     * Return instantiated class
     * @return mixed
     */
    public static function getInstance() {
        return self::$instance;
    }


    /**
     * Load class instance with specific URI
     * @param $uri
     * @return class
     */
    public static function loadInstance($uri) {

        if (!isset(self::$instance)) {
            self::$instance = new ipfsProxyHTTP($uri);
        }

        return self::$instance;
    }

    /**
     * Execution of getipfs
     */
    public function dispatch() {
        if ($this->uri) {
            foreach(IPFS_STRING_PREFIX as $prefix)
                if (strtolower(substr($this->uri,  0, strlen($prefix))) == $prefix) {
                    $this->ipfs_uri = substr($this->uri, strlen($prefix) + 1);
                    $hash = substr($this->ipfs_uri, 0, IPFS_STRING_LENGTH);
                }
            if (is_null($this->ipfs_uri)) {
                $this->ipfs_uri = substr($this->uri, 1);
                $hash = substr($this->ipfs_uri, 0, IPFS_STRING_LENGTH);
            }

            if ($hash && strlen($hash) == IPFS_STRING_LENGTH) {
                self::redirect($this->ipfs_uri);
            }
            elseif (strlen($this->ipfs_uri) < 2)
                self::template(INDEX_TEMPLATE);
            else
                self::notFound();
        }
    }

    /**
     * Not found exception
     */
    protected static function notFound() {
        self::template(NOTFOUND_TEMPLATE);
    }

    /**
     * Redirect to a proxy server
     * @param string $ipfs_uri
     */
    protected function redirect($ipfs_uri) {
        if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'])
            return self::redirectHTTP($ipfs_uri);
        else
            return self::redirectHTTP($ipfs_uri);
    }

    /**
     * Redirect to the proxy server via HTTP
     * @param string $ipfs_uri
     */
    protected function redirectHTTP($ipfs_uri) {
        header('Location: '.self::getHostURL($ipfs_uri));
        $this->handleHeaderType($ipfs_uri);
        exit();
    }

    /**
     * Handle HTTP header Content-Type
     * @param string $uri
     */
    protected function handleHeaderType($uri) {
        $ext = substr($uri, -3);

        switch ($ext) {
            case 'jpg':
                header('Content-Type: image/jpeg');
                break;
            case 'png':
                header('Content-Type: image/png');
                break;
            case 'svg':
                header('Content-Type: image/svg+xml');
                break;
            case 'gif':
                header('Content-Type: image/gif');
                break;
        }

    }

    /**
     * Redirect to the proxy server via HTML
     * @param string $ipfs_uri
     */
    protected function redirectHTML($ipfs_uri) {
        self::template(REDIRECT_TEMPLATE, array('url'=>self::getHostURL($ipfs_uri)));
    }


    /**
     * Get URL of a proxy server
     * @param string $ipfs_uri
     * @return string
     */
    protected function getHostURL($ipfs_uri) {

        if (!is_readable(PROXY_LIST_FILE))
            self::error('Proxy file is not readable');

        $proxys = file(PROXY_LIST_FILE);

        if ($proxys) {
            if ($this->isCheckHost())
                shuffle($proxys);
            else
                $proxys = array($proxys[array_rand($proxys)]);

            $hostURL = null;
            foreach ($proxys as $proxyURL) {
                if ($proxyURL) {
                    $proxyURL = self::clean_url($proxyURL);

                    if (self::check_host($proxyURL)) {
                        $url = str_replace('@', $ipfs_uri, $proxyURL);
                        if (strpos($this->uri, '/ipns/') !== FALSE) {
                            if (($pos = strpos($url, '/ipfs/')) !== FALSE)
                            $url = substr_replace($url, '/ipns/', $pos, strlen('/ipns/'));
                        }

                        return $url;
                    }
                }
            }

        }
        return self::error('All proxy servers are down !');
    }

    /**
     * Verify host is responding
     * @param $host_URL
     * @return bool
     */
    protected function check_host($host_URL) {
        if (!$this->isCheckHost())
            return true;

        if (substr($host_URL, 0, 4) != 'http')
            $host_URL = 'http:' . $host_URL;

        $host_URL = str_replace('@', IPFS_CHECK_HOST_URI, $host_URL);

        if ($content = self::get_http_content($host_URL))
            if (strpos($content, IPFS_CHECK_HOST_VERIFY_STRING) !== FALSE)
                return true;

        return false;
    }

    /**
     * Return HTTP(S) content of an URL
     * @param $url
     * @return mixed
     */
    protected function get_http_content($url) {
        if  (!in_array  ('curl', get_loaded_extensions()))
            self::error('cURL need to be installed');

		$url = self::clean_url(str_replace('@', '', $url));

        $ch = curl_init($url);
		if ($ch) {
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch,CURLOPT_TIMEOUT, $this->timeout);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $this->ssl_verify_host?2:0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this->ssl_verify_peer);
			$content = curl_exec($ch);
			curl_close($ch);
		}
		else
			self::error('Unable to load cURL');

        return $content;
    }

    /**
     * Clean URL illegal characters
     * @param $url
     * @return bool|string
     */
	protected static function clean_url($url) {

		if (substr($url, strlen($url) - 2, strlen(PHP_EOL)) == PHP_EOL)
			$url = substr($url, 0, -2);
        if (substr($url, strlen($url) - 1, 1) == "\n")
            $url = substr($url, 0, -1);

		return $url;
	}

    /**
     * Return response from a template
     * @param $template
     * @param array $vars
     */
	protected static function template($template, array $vars = null) {
        if (is_readable(dirname(__FILE__). DIRECTORY_SEPARATOR . $template) && ($file = file_get_contents(dirname(__FILE__) . DIRECTORY_SEPARATOR . $template))) {
            if ($vars)
                foreach ($vars as $key=>$value)
                    $file = str_replace('{$'.$key.'}', $value, $file);
            self::response($file);
        }
        else
            self::error('Template '.$template.' does not exist');
    }

    /**
     * Response user request
     * @param $content
     */
	protected static function response($content) {
	    print($content);
    }

    /**
     * Show error
     * @param $message
     * @param bool $error404
     */
	protected static function error($message, $error404 = false) {
	    if ($error404)
            header('HTTP/1.0 404 Not Found');
	    die($message);
    }

    /**
     * Set checking host before sending URL
     *
     * @param bool $bool
     */
    public function setCheckHost($bool) {
	    $this->check_host = $bool;
    }

    /**
     * Get Checking host
     *
     * @return bool
     */
    public function isCheckHost() {
	    return $this->check_host;
    }

    /**
     * @param int $timeout
     */
    public function setTimeOut($timeout) {
        $this->timeout = $timeout;
    }

    public function setSSLverifyHost($bool) {
        $this->ssl_verify_host = $bool;
    }

    public function setSSLverifyPeer($bool) {
        $this->ssl_verify_peer = $bool;
    }
}