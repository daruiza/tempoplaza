<?php namespace App\Core\ComprarJuntos;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $table = 'clu_order';
	
	protected $fillable = ['id','date','name_client','adress_client','email_client','number_client','resenia','resenia_test','resenia_active','client_id','active','stage_id','store_id'];
			
}