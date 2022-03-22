<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//use App\Filters\Users\UsersFilter;
//use Illuminate\Database\Eloquent\Builder;

class User extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'name',
                  'company_id',
                  'email',
                  'password',
                  'remember_token'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
    


    /**
     * Get created_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getCreatedAtAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
    }

    /**
     * Get updated_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getUpdatedAtAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
    }


    public function scopeBillAFRA($query)
    {
        return $query->where('company_id', 11);
    }

      public function user_menus()
    {
        return $this->hasMany('App\Models\UserMenu', 'user_id','id');
    }

      public function roles()
    {
        return $this->belongsToMany('App\Models\Role')->withTimestamps();
    }
	
	public function creator()
    {
        return $this->belongsTo('App\Models\User','created_by');
    }

    public function updater()
    {
        return $this->belongsTo('App\Models\User','updated_by');
    }
}