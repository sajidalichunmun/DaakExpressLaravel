<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Excel extends Model
{
	//protected $table = 'KCT_BlockContainers';

	protected $fillable = [
	  'ID',
	  'Cont_No',
	  'Ship_Line',
	  'Inst_BY',
	  'Inst_Mgs',
	  'Remarks',
	  'Block_Status',
	  'Inst_Date',
	  'CreatedBy',
	  'CreatedOn',
	  
	];
	
	public $timestamps = false;
/*
	protected $casts = [

		'user_added' => 'integer',
		'user_updated' => 'integer',
		'bill_date' => 'date',
		'dispatch_date' => 'date',
		'status' => 'string',
	];

    protected $fillable = [
        'cont_no',
    ];
	*/
	/**
     * Run the migrations.
     *
     * @return void
     */
	 /*
    public function up()
    {
        Schema::create('excels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cont_no');
            $table->timestamps();
        });
    }
	*/
}
