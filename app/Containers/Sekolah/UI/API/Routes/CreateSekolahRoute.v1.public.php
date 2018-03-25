<?php

/**
 * @apiGroup           Sekolah
 * @apiName            createSekolah
 *
 * @api                {POST} /v1/sekolah/store Endpoint title here..
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
$router->post('sekolah/create', [
    'as' => 'api_sekolah_create_sekolah',
    'uses'  => 'SekolahController@createSekolah',
    /*'middleware' => [
      'auth:api',
    ],*/
]);
