<?php
/**
 * Created by PhpStorm.
 * User: sgarwood
 * Date: 21/03/19
 * Time: 12:13
 */

namespace HGF\Tika\Tika\TikaGuzzle\Responses;


use GuzzleHttp\Psr7\Response;

abstract class AbstractTikaGuzzleResponse
{
    /* @var Response $_response */
    protected $_response;

    public function __construct(Response $guzzleResponse)
    {
        $this->_response = $guzzleResponse;
    }


    public static function buildResponse(Response $guzzleResponse)
    {

        $class = get_called_class();

        return new $class($guzzleResponse);
    }

    abstract public function default();

//    TODO Must implement to toString
}
