<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadPreAssinedPodExcelDataModel extends Model
{
	protected $table = 'ClientExcelData';
	
    protected $primaryKey = 'id';
	
	protected $keyType = 'string';
	
	public $timestamps = false;
	
	protected $fillable = [
		'AwbNo',
    	'RefNo1',
    	'BarcodeNo',
		'CustomerName',
		'MobileNo',
		'Address1',
		'address2',
		'address3',
		'CityName',
		'StateName',
		'Pincode',
		'Status',
		'DataType',
		'UploadDT',
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
	
	public function ClientExcelData()
	{
		return $this->belongsTo('App\Models\AwbMasterModel','AwbNo')->select(array('CustomerName'));
	}
}
