<?php

namespace NasaBundle\ApiBridge;

/**
 * Interface CurlInterface
 * @package ApiBridge
 */
interface TransportInterface
{
    /**
     * make a request to the specified URL
     * @param string $url
     * @return mixed
     */
    public function makeRequest($url);
}