<?php

namespace App\Controllers;

use App\Models\AuthModels;

class Auth extends BaseController
{
    protected $authmodel;

    public function __construct()
    {
        $this->authmodel = new AuthModels();
    }

    public function logon()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $user = $this->authmodel->where(['username' => $username])->first();
        // dd(password_verify($password, $user['password']));
        if(empty($user)){
            session()->setFlashdata('message', 'Username Salah');
	    	return redirect()->to('/');
	    }
	    if(!password_verify($password, $user['password'])){
	    	session()->setFlashdata('message', 'Password Salah');
	    	return redirect()->to('/');
	    }
	    session()->set('username',$username);
	    return redirect()->to('/dashboard');
    }

    public function registration()
    {
        $data = [
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
        ];
        $this->authmodel->save($data, false);
    }

    public function logout()
    {
        session()->destroy();
		return redirect()->to('/');
    }


    // Frontend
    public function register()
    {
        return view('register');
    }
    public function login()
    {
        return view('login');
    }
    public function contoh()
    {
        return view('data_karyawan');
    }
}
