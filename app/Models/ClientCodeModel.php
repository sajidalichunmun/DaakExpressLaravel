<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ClientCodeModel extends Model
{
    protected $table = 'clientcodemaster';

    protected $primaryKey = 'id';
	
	public $timestamps = false;
	
    protected $fillable = [
		'ClientMajorID',
    	'Name',
    	'Description',
		'ContactPerson',
		'ContactMNo',
		'ContactPhNo',
		'PacketTypeID',
		'GSTNO',
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

	public function MajorResult()
	{
		
		//return $this->belongsTo('App\Models\MajorCodeModel','ClientMajorID');
		return $this->belongsTo('App\Models\MajorCodeModel','ClientMajorID')->select(array('id', 'Name'));
	}
	
	public function PacketResult()
	{
		return $this->belongsTo('App\Models\PacketTypeModel','PacketTypeID')->select(array('id', 'Name'));
		//return $this->belongsTo('App\Models\PacketTypeModel','PacketTypeID');
	}
}
