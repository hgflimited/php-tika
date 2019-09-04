<?php
/**
 * Created by PhpStorm.
 * User: sgarwood
 * Date: 21/03/19
 * Time: 12:13
 */

namespace HGF\Tika\Tika\TikaGuzzle\Responses;


class RMetaResponse extends AbstractTikaGuzzleResponse
{
    public function default()
    {
        $body = (string) $this->_response->getBody();

        //        Add magic methods to this class for syntactic niceness too
        return json_decode($body);
    }
}
