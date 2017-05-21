<?php namespace App\Core\Security;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $table = 'seg_user_profile';
	
	protected $fillable = ['id','identificacion','names','surnames','birtdate','adress','state','city','avatar','template','movil_number','fix_number','fix_number','user_id'];
	
	
}

