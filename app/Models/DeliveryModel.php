<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryModel extends Model
{
    protected $table = 'delivery';

    protected $primaryKey = 'id';
	
	public $timestamps = false;
	
    protected $fillable = [
    	'AwbNo',
		'StatusID',
		'dlvdt',
		'RecName',
		'RelationID',
		'DPhoneNo',
    	'CreatedBy',
    	'CreatedOn',
        'dlvoption'
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
	
    public function relation()
	{
        return $this->belongsTo('App\Models\RelationModel','RelationID','ID')
                ->select(array('ID', 'Name'));
	}
    public function deliverystatus()
	{
        return $this->belongsTo('App\Models\PacketStatusModel','StatusID','ID')
			->select(array('Name','ID'));
	}
}
