<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivered_Rto_By_Excel extends Model
{
    protected $table = 'delivered_rto_by_excel';

    protected $primaryKey = 'id';
	
	public $timestamps = false;
	
    protected $fillable = [
    	'AwbNo',
		'Status',
		'ReceiverName',
		'Relation',
		'MobileNo',
		'Reason',
        'RouteDate',
    	'CreatedBy',
    	'CreatedOn',
        'UpdatedBy',
        'UpdatedOn',
        'CurrentStatus'
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
