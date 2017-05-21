<?php namespace App\Core\Security;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $table = 'seg_department';
	
	protected $fillable =['id','code','department'];
			
}

