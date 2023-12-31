<?php

namespace App\Http\Modules;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\HasAuthErrorResult;
use App\Traits\HasAuthHooks;
use App\Traits\HasAuthPrepareQuery;
use App\Traits\HasAuthSuccessResult;
use App\Traits\HasDBSafe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class BaseAuth extends Controller
{

    use HasAuthSuccessResult, HasAuthErrorResult, HasAuthPrepareQuery, HasAuthHooks, HasDBSafe;

    public $user;

    public $validatorLogin;
    public $validatorRegister;
    public $validatorForgotPassword;
    public $validatorResetPassword;
    public $validatorVerifyResetPassword;
    public $validatorVerifyEmail;

    public $requestData;

    public $passwordInputField = 'password';

    public function login(Request $request)
    {

        $query = User::query();

        $req = app($this->validatorLogin);

        $this->requestData = $req;

        $this->__prepareQueryLogin($query);

        $row = $query->first();


        if ($row && Hash::check($req->input($this->passwordInputField), $row->password)) {

            $this->user = $row;

            if ($ress = $this->__beforeLogin()) {
                return $ress;
            }

            if($this->user->hasRole(\App\Constants\RoleConst::STAFF) AND $this->user->asrama == null) {
                return $this->__errorLogin();
            }

            Auth::login($this->user);
            
            if($this->user->hasRole(\App\Constants\RoleConst::STUDENT)) {
                return redirect('/landing');
            }

           
            return $this->__successLogin();
        }

        return $this->__errorLogin();
    }


    public function logout()
    {
        $row = Auth::user();

        if ($ress = $this->__beforeLogout()) {
            return $ress;
        }

        if ($row) {

            $this->user = $row;

            if (request()->get('_token')) {
                Auth::logout($row);
                return $this->__successLogout();
            }

            $row->token()->revoke();

            if ($ress = $this->__afterLogout()) {
                return $ress;
            }
        }

        return $this->__successLogout();
    }



    public function register(Request $request)
    {
        return $this->DBSafe(function () {

            $req = app($this->validatorRegister);

            $this->requestData = $req;

            $row = new User();

            $data = $req->validated();

            $data = $this->__prepareDataRegister($data);

            if ($ress = $this->__beforeRegister()) {
                return $ress;
            }

            $row->fill($data);

            $row->save();

            $this->user = $row;

            if ($ress = $this->__afterRegister()) {
                return $ress;
            }

            return $this->__successRegister();
        });
    }


    public function forgotPassword(Request $request)
    {
        $req = app($this->validatorForgotPassword);

        $this->requestData = $req;

        $query = User::query();

        $this->__prepareQueryForgotPassword($query);

        $row = $query->first();

        if ($ress = $this->__beforeForgotPassword()) {
            return $ress;
        }

        if ($row) {

            $this->user = $row;

            if ($ress = $this->__afterForgotPassword()) {
                return $ress;
            }

            return $this->__successForgotPassword();
        }

        return $this->__errorForgotPassword();
    }

    public function verifyResetPassword(Request $request)
    {
        $req = app($this->validatorVerifyResetPassword);

        $this->requestData = $req;

        $query = User::query();

        $this->__prepareQueryVerifyResetPassword($query);

        $row = $query->first();

        if ($ress = $this->__beforeVerifyResetPassword()) {
            return $ress;
        }

        if ($row) {

            $this->user = $row;

            if ($ress = $this->__afterVerifyResetPassword()) {
                return $ress;
            }

            return $this->__successVerifyResetPassword();
        }

        return $this->__errorVerifyResetPassword();
    }

    public function resetPassword(Request $request)
    {
        return $this->DBSafe(function () {

            $req = app($this->validatorResetPassword);

            $this->requestData = $req;

            $query = User::query();

            $this->__prepareQueryResetPassword($query);

            $row = $query->first();

            if ($row) {

                $this->user = $row;

                $data = $req->validated();

                $data = $this->__prepareDataResetPassword($data);

                if ($ress = $this->__beforeResetPassword()) {
                    return $ress;
                }

                $row->fill($data);

                $row->save();

                if ($ress = $this->__afterResetPassword()) {
                    return $ress;
                }

                return $this->__successResetPassword();
            }

            return $this->__errorResetPassword();
        });
    }


    public function verifyEmail(Request $request)
    {
        return $this->DBSafe(function () {

            $req = app($this->validatorVerifyEmail);

            $this->requestData = $req;

            $query = User::query();

            $this->__prepareQueryVerifyEmail($query);

            $row = $query->first();

            if ($row) {

                $this->user = $row;

                $data = $this->__prepareDataVerifyEmail();

                if ($ress = $this->__beforeVerifyEmail()) {
                    return $ress;
                }

                $row->fill($data);

                $row->save();

                if ($ress = $this->__afterVerifyEmail()) {
                    return $ress;
                }

                return $this->__successVerifyEmail();
            }

            return $this->__errorVerifyEmail();
        });
    }
}
