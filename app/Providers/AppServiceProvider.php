<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use App\Http\Controllers\Api\ApiAwbMasterController;
use App\Repositories\CountryBusinessLogic;
use App\Interfaces\IBusinessLogic;
use App\Repositories\BusinessLogic;
use App\Interfaces\IDownload;
use App\Interfaces\IReportData;
use App\Repositories\ReportRepository;
use App\Repositories\StateBusinessLogic;
use App\Repositories\CityBusinessLogic;
use App\Repositories\PacketStatusBusinessLogic;
use App\Repositories\ReasonBusinessLogic;
use App\Repositories\RelationBusinessLogic;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       
		if ($this->app->runningInConsole()) {
            $this->app->register('CrestApps\CodeGenerator\CodeGeneratorServiceProvider');
        }
        
        // $this->app->when('App\Interfaces\IBusinessLogic')
        //     ->needs('App\Repositories\CountryBusinessLogic')
        //     ->give('App\Http\Controllers\Api\ApiCountryController');

        $this->app->bind(SmsInterface::class,TwilioSms::class);

        $this->app->bind(IDownload::class,ReportRepository::class);
        $this->app->bind(IReportData::class,ReportRepository::class);
        $this->app->bind(IBusinessLogic::class,BusinessLogic::class);
        $this->app->bind(IBusinessLogic::class,CountryBusinessLogic::class);
        $this->app->bind(IBusinessLogic::class,StateBusinessLogic::class);
        $this->app->bind(IBusinessLogic::class,CityBusinessLogic::class);
        $this->app->bind(IBusinessLogic::class,PacketStatusBusinessLogic::class);
        $this->app->bind(IBusinessLogic::class,ReasonBusinessLogic::class);
        $this->app->bind(IBusinessLogic::class,RelationBusinessLogic::class);
        $this->app->bind(IBusinessLogic::class,DeliveryBusinessLogic::class);
        $this->app->bind(IBusinessLogic::class,PacketTypeBusinessLogic::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->app->singleton(CountryBusinessLogic::class, IBusinessLogic::class);
    }
}
