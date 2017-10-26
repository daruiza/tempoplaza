<?php namespace App\Core\ComprarJuntos;

use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $table = 'clu_store';
	
	protected $fillable = ['id','name','nit','department','city','adress','description','ubication','image','banner','color_one','color_two','status','order','template','metadata','web','fanpage','movil','stores','products','user_id'];
			
}