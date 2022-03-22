<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\LoadingPermit;
use App\Models\GatePass;
use Carbon\Carbon;

class PermitExpiry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permit:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command update loading permit status';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
   
           $gatePasses=     GatePass::pluck('loading_permit_id');
           $now =Carbon::today()->format('Y-m-d') .' 10:30:00';
           LoadingPermit::whereNotIn('id', $gatePasses)->where('loading_permit_status_id',1)->where('permit_out_date_time',    $now)->update(['loading_permit_status_id'=>3]);
            return true;
          
         
    }
}
