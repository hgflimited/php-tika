<?php
/**
 * Created by PhpStorm.
 * User: sgarwood
 * Date: 21/03/19
 * Time: 12:13
 */

namespace HGF\Tika\Tika\TikaGuzzle\Requests;

class MetaRequest extends AbstractTikaGuzzleRequest
{
    protected $endpoint = '/meta';

    protected $headers = [
        'Accept' => 'application/json',
    ];

    protected function getBody($document, $tikaOptions)
    {
        return self::bodyFile($document);
    }

    protected function getHeaders($document, $tikaOptions)
    {
        return array_merge($this->headers, parent::getHeaders($document, $tikaOptions));
    }
}
