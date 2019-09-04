<?php
/**
 * Created by PhpStorm.
 * User: sgarwood
 * Date: 20/03/19
 * Time: 21:45
 */

namespace HGF\Tika\Tika\TikaGuzzle\Endpoints;
// TikaHTTP is what uses guzzle

use HGF\Tika\Tika\TikaGuzzle\Requests\TikaRequest;
use HGF\Tika\Tika\TikaGuzzle\Responses\TikaResponse;

class TikaEndpoint extends AbstractTikaGuzzleEndpoint
{

//    This class has the client
    protected $_requestClass = TikaRequest::class;
    protected $_responseClass = TikaResponse::class;

}
