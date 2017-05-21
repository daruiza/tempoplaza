<?php namespace App\Core\Security;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $table = 'seg_city';
	
	protected $fillable =['id','code','city','department_id'];
			
}

