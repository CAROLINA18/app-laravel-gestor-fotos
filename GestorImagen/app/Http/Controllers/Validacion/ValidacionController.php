<?php namespace GestorImagen\Http\Controllers\Validacion;

use GestorImagen\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use GestorImagen\Http\Requests\IniciarSesionRequest;
use GestorImagen\Http\Requests\EditarPerfilRequest;
use GestorImagen\Http\Requests\RecuperarContrasenaRequest;
use GestorImagen\Usuario;
class ValidacionController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

		/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * The registrar implementation.
	 *
	 * @var Registrar
	 */
	protected $registrar;

	/**
	 * Show the application registration form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getSalida']);
	}

	public function getRegistro()
	{
		return view('validacion.registro');
	}

	/**
	 * Handle a registration request for the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postRegistro(Request $request)
	{
		$validator = $this->registrar->validator($request->all());

		if ($validator->fails())
		{
			$this->throwValidationException(
				$request, $validator
			);
		}

		$this->auth->login($this->registrar->create($request->all()));

		return redirect($this->redirectPath());
	}

	/**
	 * Show the application login form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getInicio()
	{
		return view('validacion.inicio');
	}

	/**
	 * Handle a login request to the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postInicio(IniciarSesionRequest $request)
	{
		

		$credentials = $request->only('email', 'password');

		if ($this->auth->attempt($credentials, $request->has('remember')))
		{
			return redirect()->intended($this->redirectPath());
		}

		return redirect($this->loginPath())
					->withInput($request->only('email', 'remember'))
					->withErrors([
						'email' => $this->getFailedLoginMessage(),
					]);
	}

	/**
	 * Get the failed login message.
	 *
	 * @return string
	 */
	protected function getFailedLoginMessage()
	{
		return 'Email o Contraseña incorrectos';
	}

	/**
	 * Log the user out of the application.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getSalida()
	{
		$this->auth->logout();

		return redirect('/');
	}

	/**
	 * Get the post register / login redirect path.
	 *
	 * @return string
	 */
	public function redirectPath()
	{
		if (property_exists($this, 'redirectPath'))
		{
			return $this->redirectPath;
		}

		return property_exists($this, 'redirectTo') ? $this->redirectTo : '/inicio';
	}

	/**
	 * Get the path to the login route.
	 *
	 * @return string
	 */
	public function loginPath()
	{
		return property_exists($this, 'loginPath') ? $this->loginPath : '/validacion/inicio';
	}

	public function getRecuperar(){

		return view('validacion.recuperar');

	}
	public function postRecuperar(RecuperarContrasenaRequest $request){
		$pregunta= $request->get('pregunta');
		$respuesta= $request->get('respuesta');
		$email= $request->get('email');
		$usuario = Usuario::where('email','=',$email)->first();

		if ($pregunta === $usuario->pregunta && $respuesta === $usuario->respuesta){

			$contrasena = $request->get('password');
			$usuario->password = bcrypt($contrasena);
			$usuario->save();
			
			return redirect('/validacion/inicio')->with(['recuperada'=>'La contraseña se cambió']);
		}
		return redirect('/validacion/recuperar')->withInput($request->only('email','pregunta'))->withErrors(['pregunta'=>'La pregunta y/o respuesta no coinciden']);

	}

	public function missingMethod($parameters = array())
	{
		abort(404);
	}

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	

}
