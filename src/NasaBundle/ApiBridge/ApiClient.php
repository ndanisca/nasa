<?php

namespace NasaBundle\ApiBridge;


class ApiClient
{
    /**
     * Config filename
     */
    const API_CONFIG_FILENAME = 'config.ini';

    /**
     * url to NASA API
     *
     * @var $url string
     */
    private $url;

    /**
     * @var $key string
     */
    private $apiKey;

    /**
     * @var $transport mixed
     */
    private $transport;

    /**
     * ApiClient constructor.
     */
    public function __construct()
    {
        //  init path to main configuration file
        $configFilePath = __DIR__.DIRECTORY_SEPARATOR.self::API_CONFIG_FILENAME;

        //  check config file if is readable
        if(!is_readable($configFilePath))
            throw new \Exception('Config  file does\'nt exists or is not readable');

        $config = parse_ini_file($configFilePath);

        //  init vars -> url to NASA API, NASA api key
        $this->url = $config['url'];
        $this->apiKey = $config['key'];

        //  init cUrl transport class
        $this->transport = new CurlTransport();
    }

    /**
     * @param string $url
     * @param array $params
     * @return string
     */
    private function prepareQueryString($url, array $params)
    {
        $url = join('/', [$this->url, trim($url, '/')]);

        $getParams = $params ? join('&', [http_build_query($params), 'api_key='.$this->apiKey]) : 'api_key='.$this->apiKey;
        return join('?', [$url, $getParams]);
    }

    /**
     * @param string $requestUrl
     * @param bool $returnRawReply
     * @return mixed|string
     */
    protected function executeApiRequest($requestUrl, $returnRawReply = false)
    {
        $response = $this->transport->makeRequest($requestUrl);

        return $returnRawReply ? $response : json_decode($response, true);
    }

    /**
     * @param $url
     * @param array $params
     * @return mixed|string
     */
    public function makeApiRequest($url, array $params = [])
    {
        //  prepare query string
        $requestUrl = $this->prepareQueryString($url, $params);

        //  return response from NASA API
        return $this->executeApiRequest($requestUrl);
    }
}