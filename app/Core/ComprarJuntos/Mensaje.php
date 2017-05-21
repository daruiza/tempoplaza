<?php namespace App\Core\ComprarJuntos;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $table = 'clu_mailbox';
	
	protected $fillable = ['id','subject','body','message','date','object','object_id','user_sender_id','user_receiver_id','active'];
			
}