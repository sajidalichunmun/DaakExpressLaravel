<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EDIEmails extends Mailable
{
    use Queueable, SerializesModels;
	
	public $CONT_ID;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
		
		set_time_limit(300);
        /****GENERAL PDF FILE*/
        $pdf =\PDF::loadview('emails.proforma',['proformaInvoice'=>$this->proformaInvoice]);
        /***GENERATE EXCEL FILE**/
        $proformaInvoice=$this->proformaInvoice;
        $ex=\Excel::create('container summary',function($excel) use($proformaInvoice){
            $excel->sheet('container charges',function($sheet) use($proformaInvoice){
                $sheet->loadview('emails.containers')->with('proformaInvoice',$proformaInvoice);
            });
        });
		
    }
}
