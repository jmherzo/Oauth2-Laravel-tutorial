<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'policies';

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
    protected $fillable = ['policy', 'section_id', 'role1', 'role2', 'role3', 'role4', 'role5', 'role6', 'role7', 'role8', 'role9', 'role10', 'role11', 'role12', 'role13', 'role14', 'role15', 'role16', 'role17', 'role18', 'role19', 'role20', 'role21', 'role22'];

    
}
