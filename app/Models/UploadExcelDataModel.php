<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadExcelDataModel extends Model
{

	protected $table = 'ClientExcelData';
	
    protected $primaryKey = 'id';
	
	public $timestamps = false;
	
	protected $fillable = [
		'AwbNo',
		'ClientID',
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
	
    /*protected $fillable = [
		'AwbNo',
    	'Refno 1',
    	'Bacode No',
		'Customer Name',
		'Mobile_No',
		'Address 1',
		'address 2',
		'address 3',
		'CITY_NAME',
		'STATE_NAME',
		'PIN_CODE',
    	'CreatedBy',
    	'CreatedOn',
    	'UpdatedBy',
    	'UpdatedOn',
    	'IsActive'
    ];
*/
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
	
	public function client()
	{
		return $this->belongsTo('App\Models\ClientCodeModel','ClientID')
		->with('MajorResult')
		->select(array('Name','id','ClientMajorID'));
	}
}

