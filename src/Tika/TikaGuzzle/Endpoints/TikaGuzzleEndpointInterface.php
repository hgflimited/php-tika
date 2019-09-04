<?php
/**
 * Created by PhpStorm.
 * User: sgarwood
 * Date: 21/03/19
 * Time: 12:06
 */

namespace HGF\Tika\Tika\TikaGuzzle\Endpoints;


use HGF\Tika\Tika\TikaGuzzle\Responses\AbstractTikaGuzzleResponse;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

interface TikaGuzzleEndpointInterface
{
    public function request($document, $tikaOptions = []): Request;

    public function response(Response $guzzleResponse): AbstractTikaGuzzleResponse;

}
