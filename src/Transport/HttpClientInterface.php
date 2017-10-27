<?php

namespace Stadnicki\Psync\Transport;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @author tstadnicki
 */
interface HttpClientInterface
{
    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function request(RequestInterface $request);
}