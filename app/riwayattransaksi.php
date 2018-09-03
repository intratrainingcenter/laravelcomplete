<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class riwayattransaksi extends Model
{
    use SoftDeletes;
    protected $fillable = ['nama', 'id'];
    protected $casts = [
        'nama' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public $rules = [
        'nama' => 'required'
    ];
}
