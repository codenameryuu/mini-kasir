<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

use App\Services\Auth\LoginService;

class LoginController extends Controller
{
    /**
     * Service instance.
     *
     * @var \App\Services\Auth\LoginService
     */
    protected $loginService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    /**
     * Index.
     */
    public function index()
    {
        return view('auth.login.index', [
            'title' => 'Mini Kasir',
            'description' => '',
            'keywords' => '',
        ]);
    }

    /**
     * Authenticate.
     *
     * @param  \App\Http\Requests\Request  $request
     */
    public function authenticate(Request $request)
    {
        $result = $this->loginService->authenticate($request);

        if ($result->status) {
            $request->session()->regenerate();
            return redirect()->intended('/menu');
        }

        return redirect()->back()->with($result->statusAlert, $result->message);
    }

    /**
     * Logout.
     *
     * @param  \App\Http\Requests\Request  $request
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
