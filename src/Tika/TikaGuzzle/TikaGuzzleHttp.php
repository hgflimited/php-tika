<?php
/**
 * Created by PhpStorm.
 * User: sgarwood
 * Date: 21/03/19
 * Time: 11:29
 */

namespace HGF\Tika\Tika\TikaGuzzle;


use HGF\Tika\Exceptions\TikaException;
use HGF\Tika\Tika\Http\TikaHttpInterface;
use HGF\Tika\Tika\TikaGuzzle\Endpoints\{AbstractTikaGuzzleEndpoint,
    MetaEndpoint,
    RMetaEndpoint,
    TikaEndpoint};
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use function GuzzleHttp\Psr7\str;
use SplFileInfo;


class TikaGuzzleHttp implements TikaHttpInterface
{

    /* @var Client $_client */
    protected $_client;
    protected $_port;

    protected $_clientName = 'TikaGuzzle';

    protected $_endpoints = [
        'tika' => TikaEndpoint::class,
        'meta' => MetaEndpoint::class,
        'rmeta' => RMetaEndpoint::class,
        'version' => ''
    ];
    private $container;

    public function __construct($uri, $port)
    {
        $this->container = [];
        $history = Middleware::history($this->container);

        $stack = HandlerStack::create();
// Add the history middleware to the handler stack.
        $stack->push($history);

        $this->_client = new Client([
//            TODO look into port here???
            'base_uri' => $uri . ':' . $port,
            'handler' => $stack
        ]);
        $this->_port = $port;
    }

    /**
     * {@inheritdoc}
     * //     * @throws ClientException
     */
    public function request($endpoint, $documents = null, $options = [])
    {
        $responses = [];

        foreach ($documents as $document) {
            $responses[] = $this->parse($endpoint, $document, $options);
        }

        return collect($responses);
    }

    public function parse($endpoint, SplFileInfo $document = null, $options = [])
    {
        $endpointClass = array_get($this->_endpoints, $endpoint);
        if ($endpointClass === null) {
//            throw endpoint not supported exception for {$clientName}
        }

        /* @var AbstractTikaGuzzleEndpoint $endpoint */
        $endpoint = new $endpointClass();

        $request = $endpoint->request($document, $options);

//        dump($request);

        try {
            $response = $this->_client->send($request);
            // Iterate over the requests and responses
//            foreach ($this->container as $transaction) {
//                dump($transaction['request']->getBody());
//            }

            return $endpoint->response($response);
        } catch (BadResponseException $e) {
//            TODO fix error handling
            dump($e->getRequest());
//            echo str($e->getRequest());
            if ($e->hasResponse()) {
                dump($e->getResponse());
                dump((string)$e->getResponse()->getBody());
            }
            throw  $e;
        }
    }

    public function verifyConnection()
    {
        // TODO: Implement verifyConnection() method.
        // TODO use the version api as a test and throw exception if failed, listen for GuzzleException
        try {

//            TODO maybe a new function that will make a request without having to pass a document
            return $this->request('version');
        } catch (ConnectException $e) {
            throw new TikaException('No connection to client');
        }
    }
}
