<?php

namespace Stadnicki\Psync\Transport;

use GuzzleHttp\Client;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * <put short description here>
 *
 * @author tstadnicki
 */
class GuzzleHttpClient
    implements HttpClientInterface
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * GuzzleHttpClient constructor.
     */
    public function __construct(Client $client = null)
    {
        $this->client = $client ?: new Client();
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function request(RequestInterface $request)
    {
        return $this->client->send(
            $request, 
            [
                // Do not throw exceptions. Return raw responses.
                'http_errors' => false
            ]
        );
    }
}