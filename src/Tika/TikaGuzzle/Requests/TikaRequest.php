<?php
/**
 * Created by PhpStorm.
 * User: sgarwood
 * Date: 21/03/19
 * Time: 12:13
 */

namespace HGF\Tika\Tika\TikaGuzzle\Requests;

class TikaRequest extends AbstractTikaGuzzleRequest
{
    protected $endpoint = '/tika';

    protected $headers = [
    ];

    protected function getBody($document, $tikaOptions)
    {
        return self::bodyFile($document);
    }

    protected function getHeaders($document, $tikaOptions)
    {
        $ocrHeaders = self::ocrHeaders($tikaOptions);

        return array_merge($this->headers, $ocrHeaders, parent::getHeaders($document, $tikaOptions));
    }
}
