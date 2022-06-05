<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AwbMasterModel extends Model
{
	protected $table = 'AwbMaster';
	
    protected $primaryKey = 'AwbNo';
	
	protected $keyType = 'string';
	
	public $incrementing = false;
	
	public $timestamps = false;
	
	protected $fillable = [
		'PickupID',
		'AwbNo',
		'RefNo',
		'BarcodeNo',
		'PodDate',
		'ClientCodeID',
		'CustomerName',
		'MobileNo',
		'Address1',
		'Address2',
		'Pincode',
		'SubAreaName',
		'CityName',
		'StateName',
		'SubCityID',
		'CityID',
		'StateID',
		'FranID',
		'RouteDate',
		'ExpectedDelDate',
		'Status',
		'UnDeliveredReasonID',
		'AssignedType',
		'ClientCodeName',
		'CreatedBy',
    	'CreatedOn',
    	'UpdatedBy',
    	'UpdatedOn',
    	'IsActive',
		'shipmentno',
		'awbbarcode',
		'barcode_src'
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
	
	public function Franchisee()
	{
		return $this->belongsTo('App\Models\FranchiseeModel','FranID')
		->select(Array('Name','id'));
	}
	
	public function ClientData()
	{
		return $this->belongsTo('App\Models\UploadExcelDataModel','AwbNo','AwbNo');
	}

	public function ClientExcelData()
	{
		return $this->belongsTo('App\Models\UploadPreAssinedPodExcelDataModel','AwbNo','AwbNo')
		->select(Array('RefNo1','BarcodeNo','ID'));
	}
	
	public function ClientCode()
	{
		return $this->belongsTo('App\Models\ClientCodeModel','ClientCodeID')->with('MajorResult')->select(array('Name','id','ClientMajorID'));
	}
	
	public function SubCityName()
	{
		return $this->belongsTo('App\Models\SubAreaModel','SubCityID')
		->with('City')
		->select(array('MainAreaName','Name','id','CityID','Pincode'));
	}

	public function scanin()
	{
		return $this->belongsTo('App\Models\ScanInPodModel','AwbNo','AwbNo');
		//->select(array('ScanIndt'));
	}
	
	public function scanout()
	{
		return $this->belongsTo('App\Models\ScanOutPodModel','AwbNo','AwbNo')
		->with('Delivery');
		//->select(array('AwbNo','ScanOutdt','dlvBoyID'));
	}
		
	public function rto()
	{
		return $this->belongsTo('App\Models\RTOModel','AwbNo','AwbNo')->with('rtoreason','rtostatus')->select(array('RTODT','StatusID','ReasonID','AwbNo'));
	}

	public function delivered()
	{
		return $this->belongsTo('App\Models\DeliveryModel','AwbNo','AwbNo')->with('relation','deliverystatus')
			->select(array('StatusID','dlvdt','RecName','RelationID','DPhoneNo','AwbNo'));
	}
}
