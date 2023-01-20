<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;


class AuthenticatedSessionController extends Controller
{
    private $now;
    private $period;

    function __construct(){
        $this-> now = new Carbon();
        $this->period();
	}

    public function period(){
        $today = $this->now->format('Y-m-d');
		$this->period = $this->now->subMonths(config('maintenance.period'))->format('Y-m-d');
	}

    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $notifications = DB::table('notifications')
                            ->where('flag_display' ,'===',0)
                            ->where('date_post','>=',$this->period)
                            ->orderBy('date_post','desc')
                            ->paginate(config('maintenance.info_page_count'));

        $if_exist = ($notifications->count() > 0) ? true : false;
        return view('auth.login', [
            'if_exist'=>$if_exist,
            'notifications' => $notifications,
        ]);


    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        if(Auth::user()->organization->flag_delete === 0){
            if ($request)
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        else{
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            throw ValidationException::withMessages([
                'email' => trans('auth.whoops'),
            ]);
            return redirect('login');
        };
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // return redirect('/');
        return redirect('login');
    }

}
