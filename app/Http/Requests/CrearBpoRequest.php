<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CrearBPORequest extends Request {

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
			'proyecto'			=> 'required'
			,'cliente'			=> 'required'
			,'fecha_inicial_planeada'=> 'required'
			,'fecha_final_planeada'	=> 'required'
			,'fecha_inicial_real'=> 'required'
			,'fecha_final_real'	=> 'required'
			,'costo_proyecto'		=> 'required'
			,'costo_real_proyecto'		=> 'required'
	
				
		];
		
	}

}
