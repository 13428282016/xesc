<?php namespace xesc\Services;


use Symfony\Component\HttpFoundation\Request;
use xesc\Admin;
use xesc\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
        $rules=[
            'name'=>'required|max:16|min:3|unique:admins',
            'password'=>'required|max:16|min:6|confirmed',
            'password_confirmation'=>'required'
        ];

        if(strpos($data['emailOrCellphone'],'@')==-1)
        {
            $rules['emailOrCellphone']='required|regex:/^1[0-9]{10}$/';

        }
        else
        {
            $rules['emailOrCellphone']='required|email';

        }

		return Validator::make($data,$rules);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
        if(strpos($data['emailOrCellphone'],'@')==-1) {
            $data['cellphone']=$data['emailOrCellphone'];
            $data['email']=null;
        }
        else
        {
            $data['email']=$data['emailOrCellphone'];
            $data['cellphone']=null;
        }
		return Admin::create([
			'name' => $data['name'],
			'email' => $data['email'],
            'cellphone'=>$data['cellphone'],
			'password' => bcrypt($data['password']),
            'account'=>$data['emailOrCellphone']

		]);
	}

}
