<?php namespace App\Core\Security;

use Illuminate\Database\Eloquent\Model;

class Conector extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $table = 'seg_conectors';
	
	protected $fillable = ['id','conector'];
			
}

