<?php

namespace Stadnicki\Psync;

use Psr\Http\Message\UriInterface;
use Stadnicki\Psync\Transport\GuzzleHttpClient;
use Stadnicki\Psync\Transport\HttpClientInterface;

/**
 * @author tstadnicki
 */
class ApiClientBuilder
{
    /**
     * @var UriInterface
     */
    protected $publicUri;

    /**
     * @var UriInterface
     */
    protected $adminUri;
    
    /**
     * @var HttpClientInterface
     */
    protected $httpClient;

    /**
     * @param $publicUri
     * @return ApiClientBuilder
     */
    public function setPublicUri(UriInterface $publicUri)
    {
        $this->publicUri = $publicUri;
        return $this;
    }

    /**
     * ApiClientBuilder
     * @param UriInterface $adminUri
     * @return $this
     */
    public function setAdminUri(UriInterface $adminUri)
    {
        $this->adminUri = $adminUri;
        return $this;
    }

    /**
     * @param HttpClientInterface $httpClient
     * @return ApiClientBuilder
     */
    public function setHttpClient(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
        return $this;
    }

    /**
     * @return HttpClientInterface
     */
    public function getHttpClient()
    {
        if (empty($this->httpClient)) {
            //TODO Check if class exists. Throw error.
            return new GuzzleHttpClient();
        }
        
        return $this->httpClient;
    }

    /**
     * 
     */
    public function buildV14()
    {
    }
}