<?php

namespace App\Model\Configuration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sizes extends Model
{
    use SoftDeletes;
    protected $table = 'sizes';

    protected $fillable = [
    	'name','status','category','first_category',
    ];
    protected $primaryKey = 'id';

     public function Category()
    {
    	return $this->hasOne('App\Category','id','category');
    }
    public function firstCategory()
    {
    	return $this->hasOne('App\FirstCategory','id','first_category');
    }
}
