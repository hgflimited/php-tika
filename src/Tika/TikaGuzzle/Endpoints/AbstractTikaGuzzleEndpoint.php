<?php
/**
 * Created by PhpStorm.
 * User: sgarwood
 * Date: 20/03/19
 * Time: 21:48
 */

namespace HGF\Tika\Tika\TikaGuzzle\Endpoints;

use GuzzleHttp\Psr7\{Request, Response};
use HGF\Tika\Tika\TikaGuzzle\Responses\AbstractTikaGuzzleResponse;

abstract class AbstractTikaGuzzleEndpoint implements TikaGuzzleEndpointInterface
{
    protected $_responseClass;
    protected $_requestClass;

    public function request($document, $tikaOptions = []): Request
    {
        return (new $this->_requestClass)->buildRequest($document, $tikaOptions);
    }

    public function response(Response $guzzleResponse): AbstractTikaGuzzleResponse
    {
        return $this->_responseClass::buildResponse($guzzleResponse);
    }
}
