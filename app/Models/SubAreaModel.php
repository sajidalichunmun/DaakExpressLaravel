<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubAreaModel extends Model
{
    protected $table = 'subcitymaster';

    protected $primaryKey = 'id';
	
	public $timestamps = false;
	
    protected $fillable = [
		'CityID',
    	'Name',
    	'MainAreaName',
		'Pincode',
    	'CreatedBy',
    	'CreatedOn',
    	'UpdatedBy',
    	'UpdatedOn',
    	'IsActive'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
    


    /**
     * Get created_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getCreatedAtAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
    }

    /**
     * Get updated_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getUpdatedAtAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
    }
	
	public function City()
	{
		return $this->belongsTo('App\Models\CityModel','CityID')->with('State')->select(array('id','Name','StateID'));
	}
	
}

