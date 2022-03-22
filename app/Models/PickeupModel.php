<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PickeupModel extends Model
{
    protected $table = 'pickupdetails';

    protected $primaryKey = 'id';
	
	public $timestamps = false;
	
    protected $fillable = [
    	
    	'ClientID',
		'BranchID',
		'RefNo',
		'Quantity',
		'PickUpdate',
		'Assigned',
		'Completed',
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
	
	public function Client()
	{
		return $this->belongsTo('App\Models\ClientCodeModel','ClientID')->select(array('Name','id'));
	}
	
	public function BranchName()
	{
		return $this->belongsTo('App\Models\BranchModel','BranchID')->select(array('Name','id'));
	}
}

