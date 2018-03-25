<?php

namespace App\Containers\Sekolah\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class CreateSekolahRequest.
 */
class CreateSekolahRequest extends Request
{

    /**
     * The assigned Transporter for this Request
     *
     * @var string
     */
    

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'permissions' => '',
        'roles'       => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [
        // 'id',
    ];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [
        // 'id',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            // 'id' => 'required',
            'namasekolah' => 'required|max:50',
            'alamat' => 'required|max:200',
            'foto' => 'required'
        ];
    }

    /**
     * @return  bool
     */
    public function authorize()
    {
        return $this->check([
            
        ]);
    }
}
