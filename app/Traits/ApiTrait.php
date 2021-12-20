<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait ApiTrait{

    public function scopeIncluded(Builder $query)
    {

        if ( empty($this->allowIncluded) ||empty(request('included'))) {
            return;
        }

        $relations = explode(',',request('included')); //posts

        //lo convertimos en una colleccion 
        $allowIncluded=collect($this->allowIncluded);


        //recorremos la colleccion de relaciones permitidas y eliminamos las que no esten en el array de relaciones
        foreach($relations as $key=>$relationship){
            if(!$allowIncluded->contains($relationship)){
                unset($relations[$key]);
            }
        }



        $query->with($relations);
        
    }

    public function scopeFilter(Builder $query)
    {
        if ( empty($this->allowFilter) || empty(request('filter'))) {
            return;
        }

        $filters = request('filter');
        
        $allowFilter=collect($this->allowFilter);

        foreach($filters as $filter=>$value){
            if($allowFilter->contains($filter)){
               $query->where($filter, 'LIKE', '%'.$value.'%');
            }
        }

    }

    public function scopeSort(Builder $query)
    {
        if ( empty($this->allowFilter) || empty(request('sort'))) {
            return;
        }

        $sortField = explode(',',request('sort'));
        $allowSort=collect($this->allowSort);



        foreach($sortField as $field){

            $direction = 'asc';

            if(substr($field,0,1)=='-'){
                $direction = 'desc';
                $field=substr($field,1);
            }

            if($allowSort->contains($field)){
                $query->orderBy($field,$direction);
            }


        }

    }


    public function scopeGetOrPaginate(Builder $query)
    {
        if(request('perPage')){

            $perPage=intval(request('perPage'));

            if($perPage){
                return $query->paginate($perPage);
            }
            
        }

        return $query->get();


    }


}