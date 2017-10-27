<?php

namespace Stadnicki\Psync\Protocol;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use GuzzleHttp\Psr7\Request;
use Stadnicki\Psync\Protocol\Error\NotFound;
use Stadnicki\Psync\Transport\DumbJsonSerializer;
use Stadnicki\Psync\Transport\HttpClientInterface;
use Stadnicki\Psync\Transport\JsonSerializerInterface;

/**
 * @author tstadnicki
 */
abstract class AbstractApi
{
    /**
     * @var HttpClientInterface
     */
    protected $httpClient;

    /**
     * @var UriInterface
     */
    protected $baseUri;
    /**
     * @var JsonSerializerInterface
     */
    protected $jsonSerializer;

    /**
     * AbstractApi constructor.
     * @param HttpClientInterface $httpClient
     * @param UriInterface $baseUri
     * @param JsonSerializerInterface $jsonSerializer
     */
    public function __construct(
        HttpClientInterface $httpClient,
        UriInterface $baseUri,
        JsonSerializerInterface $jsonSerializer = null
    ) {
        $this->httpClient = $httpClient;
        $this->baseUri = $baseUri;
        $this->jsonSerializer = $jsonSerializer ?: new DumbJsonSerializer();
    }

    /**
     * @param string $method
     * @param string $path
     * @param array|null $payload
     * @return RequestInterface
     */
    protected function createRequest(
        $method,
        $path,
        $payload = null
    ) {
        $uri = $this->baseUri->withPath(
            $this->appendPath($this->baseUri->getPath(), $path)
        );

        $headers = [];
        if ($payload) {
            $headers[] = 'Content-type: application/json';

            if (!is_string($payload)) {
                $payload = $this->jsonSerializer->serialize($payload);
            }
        }


        return new Request($method, $uri, $headers, $payload);
    }

    /**
     * @param $request
     * @return ResponseInterface
     */
    protected function sendRequest($request)
    {
        $response = $this->httpClient->request($request);
        $code = $response->getStatusCode();

        if ($code < 200 || $code >= 300) {
            switch ($response->getStatusCode()) {
                case 404:
                    throw new NotFound();
                default:
                    //TODO Make proper exceptions
                    throw new \RuntimeException();
            }
        }
        
        return $response;
    }

    /**
     * @param $path
     * @return string
     */
    protected function appendPath($base, $path): string
    {
        return rtrim($base, '/') . '/' . ltrim($path, '/');
    }

    /**
     * @param string $path
     * @return object
     */
    protected function sendGetRequest($path)
    {
        $request = $this->createRequest('get', $path);
        $response = $this->sendRequest($request);
        return $this->objFromResponse($response);
    }

    /**
     * @param $path
     * @param $payload
     * @return object
     */
    protected function sendPostRequest($path, $payload)
    {
        $request = $this->createRequest('post', $path, $payload);
        $response = $this->sendRequest($request);


    }

    /**
     * @param $obj
     * @param $instance
     * @return mixed
     */
    protected function objToClass($obj, $instance)
    {
        $class = new \ReflectionClass($instance);
        foreach ($class->getProperties() as $property) {
            $propertyName = $property->getName();
            if (property_exists($obj, $propertyName)) {
                $property->setValue($instance, $obj->{$propertyName});
            }
        }
        return $instance;
    }

    /**
     * @param ResponseInterface $response
     * @return \stdClass
     */
    protected function objFromResponse(ResponseInterface $response): \stdClass
    {
        $stream = $response->getBody();
        $stream->rewind();
        $jsonString = $stream->getContents();
        return $this->jsonSerializer->deserialize($jsonString);
    }
}