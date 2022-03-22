<?php
namespace App\Filters\Users;
use App\Filters\Filter;
class UsersFilter extends Filter{
    protected $filters =[
             'name'=>NameFilter::class,  
             'email'=>EmailFilter::class,  
             //'contact'=>ContactNoFilter::class,  
             //'tin'=>TinNoFilter::class,  
             
    ];
}

//shipingagent
//ship arived
//nominated