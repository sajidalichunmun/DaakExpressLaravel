<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FranchiseeModel extends Model
{
    protected $table = 'franchiseemaster';

    protected $primaryKey = 'id';
	
	public $timestamps = false;
	
    protected $fillable = [
		'Name',
    	'GSTNO',
    	'PANNO',
		'CONTACT1',
		'CONTACT2',
		'EMAILID',
		'Pincode',
		'Address1',
		'Address2',
		'SubCityID',
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
		return $this->belongsTo('App\Models\CityModel','SubCityID')->select(array('id','Name'));
	}
}
