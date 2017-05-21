<?php namespace App\Core\ComprarJuntos;

use Illuminate\Database\Eloquent\Model;

class Anotacion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $table = 'clu_order_annotation';
	
	protected $fillable = ['id','user_name','date','description','active','order_id'];
			
}