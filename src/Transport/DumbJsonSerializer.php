<?php

namespace Stadnicki\Psync\Transport;

/**
 * @author tstadnicki
 */
class DumbJsonSerializer
    implements JsonSerializerInterface
{

    /**
     * Must return stdClass.
     *
     * @param $jsonString
     * @return object
     */
    public function deserialize($jsonString)
    {
        return json_decode($jsonString, false);
    }

    /**
     * @param $mixed
     * @return string
     */
    public function serialize($mixed)
    {
        return json_encode($mixed, JSON_PRETTY_PRINT);
    }
}