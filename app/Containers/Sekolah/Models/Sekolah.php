<?php

namespace App\Containers\Sekolah\Models;

use App\Ship\Parents\Models\Model;

class Sekolah extends Model
{
    protected $table = "sekolah";
    protected $primaryKey = "idsekolah"; 
    public $timestamps = false;
    protected $keyType = 'int';
    public $incrementing = true;
    protected $fillable = [
        'namasekolah',
        'alamat',
        'foto'
    ];

    /*
    protected $attributes = [

    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];*/

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'sekolah';

    public function checkNamaSekolah($namasekolah){
        $query = self::selectRaw("namasekolah")->whereRaw("namasekolah = ?",[$namasekolah])->count();
        return $query;
    }
}
