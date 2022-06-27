<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Auth;

class LoginService
{
    /**
     * Authenticate service.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return  ArrayObject
     */
    public function authenticate($request)
    {
        $akun = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($akun)) {
            $status = true;
            $statusAlert = 'success';
            $message = 'Berhasil login !';
        } else {
            $status = false;
            $statusAlert = 'fail';
            $message = 'Gagal login !';
        }

        $result = (object) [
            'status' => $status,
            'statusAlert' => $statusAlert,
            'message' => $message,
        ];

        return $result;
    }
}
