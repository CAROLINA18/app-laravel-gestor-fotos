<?php namespace GestorImagen\Http\Requests;

use GestorImagen\Http\Requests\Request;

class RecuperarContrasenaRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
		'email' => 'required|email|exists:usuario,email', 
		'password' => 'required|min:6|confirmed',
		'pregunta' => 'required',
		'respuesta' => 'required',
			//
		];
	}

}
