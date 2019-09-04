<?php
/**
 * Created by PhpStorm.
 * User: sgarwood
 * Date: 21/03/19
 * Time: 12:14
 */

namespace HGF\Tika\Tika\TikaGuzzle\Requests;


use GuzzleHttp\Psr7\Request;

abstract class AbstractTikaGuzzleRequest
{
    protected $method = 'PUT';
    protected $headers = [
    ];

    protected $endpoint;

//    Maybe this should be more like a factory/strategy pattern
    public function buildRequest($document, $tikaOptions)
    {
//        TODO change URI if its a form type

        $headers = $this->getHeaders($document, $tikaOptions);

        $body = $this->getBody($document, $tikaOptions);

        return new Request($this->method, $this->endpoint, $headers, $body);
    }

    abstract protected function getBody($document, $tikaOptions);

    protected function getHeaders($document, $tikaOptions)
    {
        return $this->headers;
    }

    protected static function multipartFile($document)
    {
        return [
            'multipart' => [
                'name' => 'file',
                'contents' => fopen($document->getRealPath(), 'rb')
            ]
        ];
    }

    protected static function bodyFile($filename)
    {
        return fopen($filename->getRealPath(), 'rb');
    }

    protected static function ocrHeaders($options)
    {
        if (array_key_exists('ocr', $options) && $options['ocr'] === true) {
            return array_merge(static::extractPdfToImages());
        }

        return [];
    }

    protected function pdf()
    {
        return static::contentType('application/pdf');
    }

    protected function csv()
    {
        return static::contentType('applications/csv');
    }

    protected function docx()
    {
        return static::contentType('application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    }

    protected static function extractPdfToImages()
    {
        return [
            'X-Tika-PDFextractInlineImages' => 'true'
        ];
    }

    protected static function mimeHeaders($document){
        return self::contentType(mime_content_type($document->getRealPath()));
    }

//    TODO use a MetaResponse to attach more information
    protected static function contentType($contentType)
    {
        return [
            'Content-Type' => $contentType
        ];
    }

}
