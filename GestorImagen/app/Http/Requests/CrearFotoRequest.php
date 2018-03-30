<?php namespace GestorImagen\Http\Requests;

use GestorImagen\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class CrearFotoRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$user= Auth::user();
		$id= $this->get('id');
		$album = $user->albums()->find($id);
		if($album)
		{
			return true;
		}
		return false;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'id' => 'required|exists:album,id',
			'nombre' => 'required',
			'descripcion' => 'required',
			'imagen' => 'required|image|max:20000'
			//
		];
	}

}
