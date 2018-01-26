<?php namespace App\Core\ComprarJuntos;

use Illuminate\Database\Eloquent\Model;

class ProveedorPago extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $table = 'clu_payment_method';
	
	protected $fillable = ['id','type','name','description','data','active','store_id'];
			
}