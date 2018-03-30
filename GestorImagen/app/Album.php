<?php namespace GestorImagen;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Album extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'album';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id','nombre', 'descripcion', 'usuario_id'];

	public function fotos(){

		return $this->hasMany('GestorImagen\Foto');
	}

	public function usuario(){

		return $this->belongsTo('GestorImagen\Usuario');
	}
	
}
