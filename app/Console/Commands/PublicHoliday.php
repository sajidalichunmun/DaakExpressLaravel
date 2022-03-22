<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CalendarEvent;
use Carbon\Carbon;

class PublicHoliday extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'public:holiday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        //


   $calendarEvents=CalendarEvent::all();



if(count($calendarEvents)>0){

foreach ($calendarEvents as $calendarEvent) {
    $dt= Carbon::createFromFormat('d/m/Y',$calendarEvent->start_date);
    $holidayDay= $dt->toDateString();
    $today= Carbon::today()->toDateString();
    if(Carbon::parse($holidayDay)->lt(Carbon::parse($today)) ){
        /**update new event for the coming year*/
       // dd($dt->timezone('Africa/Dar_es_Salaam')->addYear()->format('d/m/Y'));
    //$calendarEvent->update(['start_date'=>$dt->timezone('Africa/Dar_es_Salaam')->addYear()->format('d/m/Y')]);
    $calendarEvent->update(['start_date'=>$dt->addYear()->format('d/m/Y')]);
    }
  
}
}

      return true;
      

    }
}
