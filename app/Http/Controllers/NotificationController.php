<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * 
     */

    public function index()
    {
        
       $user_domain=Auth::user()->domain_organization;
    //    $d_name =  DB::table('organizations')->where('domain_organization' ,'=',$user_domain)->first();

       return view('dashboard', [
            'notifications' =>  DB::table('notifications')
                                    ->where('flag_display', '=', 1)
                                    ->where('domain_organization' ,'=',$user_domain)    // ドメインでの絞り込み
                                    ->orderBy('date_post', 'desc')
                                    ->paginate(config('maintenance.info_page_count')),
            // 'user_organaization' => $d_name->name_organization,            
        ]);
                
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Notification $notification)
    {
        
        return view('notification.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_organaization= Auth::user()->domain_organization;

        $notification = new Notification;
        $notification->flag_display = 1;
        $notification->domain_organization = $user_organaization;
        $notification->date_post = $request->date_post;
        $notification->text_title = $request->text_title;
        $notification->text_message = $request->text_message;
        $notification->save();
        
        return redirect('/admin/news')->with('status', '登録しました');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        $user_organaization = Auth::user()->domain_organization;
        return view('notification.create', [
            'notifications' => DB::table('notifications')->where('flag_display' ,'=',1)->where('domain_organization' ,'=',$user_organaization)->orderBy('date_post','desc')->paginate(10)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $notification = Notification::find($id);
        return view('notification.edit',['notification' =>$notification]);
   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $notification = Notification::find($request->id);
        $notification->date_post = $request->date_post;
        $notification->text_title = $request->text_title;
        $notification->text_message = $request->text_message;
        $notification->update();
        return redirect('/admin/news')->with('status', '更新が完了しました');
        
        
    }


    public function delete(Request $request)
    {
        $notification = Notification::find($request->id);
        return view('notification.delete',['notification' =>$notification]);
    }

    public function remove(Request $request)
    {
        Notification::find($request->id)->delete();
        return redirect('/admin/news')->with('status', '削除しました');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        //
    }

    
}
