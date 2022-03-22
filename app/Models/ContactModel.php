<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ContactModel extends Model
{
    protected $table='contacts';

    protected $primaryKey = 'id';
	
	public $timestamps = false;
	
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'country',
        'subject',
    ];
}
