<?php

/**
 * @apiGroup           Sekolah
 * @apiName            SekolahController
 *
 * @api                {DELETE} /v1/sekolah/delete Endpoint title here..
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
$router->post('sekolah/delete', [
    'as' => 'api_sekolah_sekolah_controller',
    'uses'  => 'SekolahController@deleteSekolah',
]);
