<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AwbMasterHistModel extends Model
{
    protected $table = 'AWBMASTER_HIST';
	
    protected $primaryKey = 'PodSlNo';
	
	//protected $keyType = 'string';
	
	//public $incrementing = false;
	
	public $timestamps = false;
	
	protected $fillable = [
		'PodSlNo',
		'AwbNo',
		'HistDate',
		'HistStatus',
		'CreatedBy',
		'CreatedOn'
		
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
	
}
