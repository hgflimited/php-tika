<?php
/**
 * Created by PhpStorm.
 * User: sgarwood
 * Date: 20/03/19
 * Time: 21:02
 */

namespace HGF\Tika\Tika;


use HGF\Tika\DocumentParserInterface;
use HGF\Tika\Tika\Core\TikaConstants;
use HGF\Tika\Tika\Http\TikaHttpInterface;
use HGF\Tika\Tika\TikaGuzzle\TikaGuzzleHttp;
use Illuminate\Support\Collection;
use SplFileInfo;

class Tika implements DocumentParserInterface
{
//    HTTP Client
    /* @var TikaHttpInterface $_tikaHttp */
    protected $_tikaHttp;

    protected $_host = TikaConstants::ENDPOINT;
    protected $_port = 9998;

    protected $_verifyConnectionOnInit = false;

    /* @var string $_endpoint default key to be looked up in endpoints array in Http Client concrete implementation */
    protected $_endpoint = null;

    /* @var array $documents TODO turn documents from array of strings to an array of Objects or Strings
     * that have their own meta info that can be used by other endpoints
     */
    protected $documents = [];

    /* @var array $options strictly options related to Tika, should have nothing to do with Http the Http Concrete
     * implementation should take care of parsing and converting to proper headers*/
    protected $options = [
        'ocr' => false
    ];

    public function __construct($host = null, $port = null, $tikaHttp = null)
    {
        if(is_array($host)){
            /* TODO array config */
        }

//        TODO move towards client config array
        if ($host) {
            $this->setHost($host);
        }

        if ($port) {
            $this->setPort($port);
        }

        if ($tikaHttp) {
            $this->_tikaHttp = $tikaHttp;
        } else {
            $this->_tikaHttp = new TikaGuzzleHttp($this->_host, $this->_port);
        }

        if ($this->_verifyConnectionOnInit) {
            $this->verifyConnection();
        }
    }

    /**
     * @param string|null $host
     * @return Tika
     */
    public function setHost(?string $host): Tika
    {
        $this->_host = $host;
        return $this;
    }

    /**
     * @param int|null $port
     * @return Tika
     */
    public function setPort(?int $port): Tika
    {
        if (!is_numeric($port)) {
//
        }
        $this->_port = $port;
        return $this;
    }

    /**
     * @param string $endpoint
     * @return Tika
     */
    public function setEndpoint(string $endpoint): Tika
    {
        $this->_endpoint = $endpoint;
        return $this;
    }

    protected function getDefaultEndpoint(): string
    {
//        Maybe move to use laravel config
        return TikaConstants::DEFAULT_ENDPOINT;
    }

    /**
     * @param string $doc | SplFileInfo $doc
     * @return $this
     */
    public function addDocument($doc)
    {
        if(is_string($doc)){
            $doc = new SplFileInfo($doc);
        }
        $this->documents = array_wrap($doc);
        return $this;
    }

    public function appendDocument($doc)
    {

        if(is_string($doc)){
            $doc = new SplFileInfo($doc);
        }

        $this->documents[] = $doc;
        return $this;
    }

    public function tika()
    {
        return $this->setEndpoint('tika');
    }

//    Syntactic sugar for setting endpoints
    public function meta()
    {
        return $this->setEndpoint('meta');
    }

    public function detector()
    {
        return $this->setEndpoint('director');
    }

    public function language()
    {
        return $this->setEndpoint('language');
    }

    public function translate()
    {
        return $this->setEndpoint('translate');
    }

    public function rmeta()
    {
        return $this->setEndpoint('rmeta');
    }

    public function ocr()
    {
        return $this->enableOcr();
    }

    public function withOcr()
    {
        return $this->enableOcr();
    }

    public function enableOcr()
    {
        $this->options['ocr'] = true;
        return $this;
    }

    public function disableOcr()
    {
        $this->options['ocr'] = false;
        return $this;
    }

    private function verifyConnection()
    {
        return $this->_tikaHttp->verifyConnection();
    }


    /**
     * @param array $headers
     * @return Collection | TikaGuzzle\Responses\AbstractTikaGuzzleResponse
     */
    public function get($headers = [])
    {
        $this->options['headers'] = $headers;

        return $this->parseAll($this->_endpoint, $this->documents, $this->options);
    }

//    TODO work on single doc
//    public function first()
//    {
//        return $this->parse($this->_endpoint, head($this->documents), $this->options);
//    }

    protected function parseAll($endpoint, $document, $options)
    {
//        TODO Validate files ie permissions and file existence before continuing
//        TODO map options and syntactic sugar into an interface that is consumed by TikaHttp/TikaService
        $endpoint = $endpoint ?: $this->getDefaultEndpoint();
        return $this->_tikaHttp->request($endpoint, $document, $options);
    }
// parseOne

}
