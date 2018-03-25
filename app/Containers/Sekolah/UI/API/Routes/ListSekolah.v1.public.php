<?php

/**
 * @apiGroup           Sekolah
 * @apiName            getAllSekolahs
 *
 * @api                {GET} /v1/sekolah/list Endpoint title here..
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

/** @var Route $router */
$router->get('sekolah/list', [
    'as' => 'api_sekolah_get_all_sekolahs',
    'uses'  => 'SekolahController@getAllSekolahs',
    /*'middleware' => [
      'auth:api',
    ],*/
]);
