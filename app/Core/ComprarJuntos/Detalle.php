<?php namespace App\Core\ComprarJuntos;

use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $table = 'clu_order_detail';
	
	protected $fillable = ['id','product','price','volume','description','product_id','order_id'];
			
}