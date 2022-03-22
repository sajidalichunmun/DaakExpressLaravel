<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeriesModel extends Model
{
    protected $table = 'seriesmaster';

    protected $primaryKey = 'id';
	
	public $timestamps = false;
	
    protected $fillable = [
    	'BranchID',
		'Prefix',
		'Length',
		'SeriesFrom',
		'SeriesTo',
		'AllocationQty',
		'AllocatedSeries',
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
	
	public function BranchName()
	{
		return $this->belongsTo('App\Models\BranchModel','BranchID')->select(['Name','id']);
	}
}
