<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

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
    protected $fillable = ['name', 'description', 'code', 'buyPrice', 'sellPrice'];

    public static function scopeNamed($query,$name){
        return $query->where('name', $name);
    }

    public static function scopeIded($query,$id){
        return $query->where('id', $id);
    }

    public static function scopeTotalrows($query){
        return $query->count();
    }
    
}
