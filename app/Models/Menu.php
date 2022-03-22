<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'menus';

    /**
    * The database pri	mary key value.
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
                  'menu_id',
                  'name',
                  'controller',
                  'icon',
                  'url',
                  'sort_order',
                  'created_by',
                  'updated_by',
                  'mega',
				  'company_id'
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
     * Get the menu for this model.
     */
    public function menu()
    {
        return $this->belongsTo('App\Models\Menu','menu_id');
    }

        /**
     * Get the menu for this model.
     */
    public function children()
    {
        return $this->hasMany('App\Models\Menu','menu_id');
    }
    /**
     * Get the creator for this model.
     */
    public function creator()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function scopeBill($query)
    {
        return $query->where('company_id', 11);
    }

    /**
     * Get the updater for this model.
     */
    public function updater()
    {
        return $this->belongsTo('App\User','updated_by');
    }

    /**
     * Get the userMenuses for this model.
     */
    public function userMenuses()
    {
        return $this->hasMany('App\Models\UserMenu','menu_id','id');
    }


    /**
     * Get created_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getCreatedAtAttribute($value)
    {
        return \DateTime::createFromFormat('j/n/Y g:i A', $value);
    }

    /**
     * Get updated_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getUpdatedAtAttribute($value)
    {
        return \DateTime::createFromFormat('j/n/Y g:i A', $value);
    }

}
