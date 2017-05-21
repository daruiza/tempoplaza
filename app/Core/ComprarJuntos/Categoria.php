<?php namespace App\Core\ComprarJuntos;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $table = 'clu_category';
	
	protected $fillable = ['id','name','category_id'];
			
}