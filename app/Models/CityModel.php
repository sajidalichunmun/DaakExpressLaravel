<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityModel extends Model
{
    protected $table = 'citymaster';

    protected $primaryKey = 'id';
	
	public $timestamps = false;
	
    protected $fillable = [
    	'Name',
    	'StateID',
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
	
	public function State()
	{
		return $this->belongsTo('App\Models\StateModel','StateID')->with('Country')->select(array('id','Name','CountryID'));
	}
}

