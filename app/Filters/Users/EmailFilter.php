<?php
namespace App\Filters\Users;
class EmailFilter{
    public function filter($builder, $value)
    {
    	// /dd('sdsd');
    	//dd($value);
        return $builder->where('email','like',$value);
    }

}




