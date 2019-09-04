<?php
/**
 * Created by PhpStorm.
 * User: sgarwood
 * Date: 21/03/19
 * Time: 12:13
 */

namespace HGF\Tika\Tika\TikaGuzzle\Requests;

class RMetaRequest extends AbstractTikaGuzzleRequest
{
    protected $endpoint = '/rmeta/text';

    protected $headers = [
    ];

    protected function getBody($document, $tikaOptions)
    {
        return self::bodyFile($document);
    }

    protected function getHeaders($document, $tikaOptions)
    {
        $ocrHeaders = self::ocrHeaders($tikaOptions);

        dump(self::mimeHeaders($document));

        return array_merge($tikaOptions['headers'], $this->headers, $ocrHeaders, parent::getHeaders($document, $tikaOptions));
    }
}
