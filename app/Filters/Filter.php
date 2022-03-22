<?php
namespace App\Filters;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
abstract class Filter{
    protected $request;
    protected $filters = [];
    public function __construct(Request $request)
    {
        
        $this->request = $request;

           //dd(  $this->request);
    }
    public function filter(Builder $builder)
    {  
        foreach($this->getFilters() as $filter => $value)
        {
            $this->resolveFilter($filter)->filter($builder, $value);
        }
      
        return $builder;
    }

    protected function getFilters()
    {
       //dd($this->request);
     //  dd(((array_keys($this->filters))));
        return array_filter($this->request->only(array_keys($this->filters)));
    }

    protected function resolveFilter($filter)
    {
       // dd( new $this->filters[$filter]);
        return new $this->filters[$filter];
    }
}