<?php
/**
 * Created by PhpStorm.
 * User: sgarwood
 * Date: 21/03/19
 * Time: 11:50
 */

namespace HGF\Tika\Tika\TikaGuzzle\Endpoints;

use HGF\Tika\Tika\TikaGuzzle\Requests\MetaRequest;
use HGF\Tika\Tika\TikaGuzzle\Responses\MetaResponse;

class MetaEndpoint extends AbstractTikaGuzzleEndpoint
{
    protected $_requestClass = MetaRequest::class;
    protected $_responseClass = MetaResponse::class;
}
