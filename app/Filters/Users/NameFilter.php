<?php
namespace App\Filters\Users;
class NameFilter{
    public function filter($builder, $value)
    {
    	// /dd('sdsd');
    	//dd($value);
        return $builder->where('name','like',$value);
    }

}



