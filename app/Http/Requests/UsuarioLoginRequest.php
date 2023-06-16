<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class UsuarioLoginRequest extends FormRequest
{
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'correo'=>'required',
            'password' => 'required',
        ];
    }

    public function getCredentials(){
        $correo = $this->get('correo');
            return [
                'correo' => $correo,
                'password' => $this->get('password'),
            ];
    }

    public function isEmail($value){
        $factory = $this->container->make(ValidationFactory::class);

        return !$factory->make(['correo'=>$value])->fails();
    }
}
