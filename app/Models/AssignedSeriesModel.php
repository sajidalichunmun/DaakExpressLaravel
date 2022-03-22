<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignedSeriesModel extends Model
{
    protected $table = 'userseriesmaster';

    protected $primaryKey = 'id';
	
	public $timestamps = false;
	
    protected $fillable = [
    	'SeriesID',
    	'UserID',
		'SeriesFrom',
		'SeriesTo',
		'CurrentNo',
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
	
	public function Creator()
	{
		return $this->belongsTo('App\User','UserID')->select(array('name','id'));
	}
	
	public function Series()
	{
		return $this->belongsTo('App\Models\SeriesModel','SeriesID')->select(['Prefix','id']);
	}
}
