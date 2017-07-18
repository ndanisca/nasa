<?php

namespace NasaBundle\ApiBridge;


class CurlTransport implements TransportInterface
{
    /**
     * @var array $curl_params
     */
    protected $curlParams;

    public function __construct()
    {
        //  init curlParams
        $this->curlParams = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => 0,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT        => 60,
//
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2
        );
    }

    /**
     * @param string $url
     * @return array
     */
    public function makeRequest($url)
    {
        //  cUrl init
        $curl = curl_init($url);
        //  setting options for cUrl transfer
        curl_setopt_array($curl, $this->curlParams);

        //  starting cUrl session
        $curlResponse = curl_exec($curl);

        //  check for unsuccessful cUrl response
        if ($curlResponse === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            die('Error occured during curl exec. Additioanl info: ' . var_export($info));
        }

        //  close cUrl sess
        curl_close($curl);

        //  return result data
        return $curlResponse;
    }
}