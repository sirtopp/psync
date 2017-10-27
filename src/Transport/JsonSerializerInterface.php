<?php

namespace Stadnicki\Psync\Transport;

/**
 * @author tstadnicki
 */
interface JsonSerializerInterface
{

    /**
     * Must return stdClass.
     * 
     * @param $jsonString
     * @return object
     */
    public function deserialize($jsonString);

    /**
     * @param $mixed
     * @return string
     */
    public function serialize($mixed);
}