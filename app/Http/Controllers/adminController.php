<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\userType;
use App\Models\Request_work;
use App\Models\Requesttype;

class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */


    public function index()
    {
        $user = auth()->user()->usertype;
        if($user == 'Admin'){
        $types = userType::all();
        $members =  User::all();
        return view('mainadmin', ['types' => $types, 'members' => $members]);}
        else{
            return view('404');
        }
    }


    public function indexPart()
    {

        $email = auth()->user()->email;
        $admin = User::where('email', $email)->first();

        if ($admin->usertype == 'Accountant') {
            $accapp = Request_work::all()->where('type', $admin->usertype)->where('status', 'pending');
            return view('partadmin', ['admin' => $admin, 'accapp' => $accapp]);
        } elseif ($admin->usertype == 'HR') {
            // $accapp = Request_work::all()->where('type', $admin->usertype );
            $accapp = Request_work::where(function ($q) {
                $q->where('hr', 'Active');
            })->get();
            return view('partadmin', ['admin' => $admin, 'accapp' => $accapp]);
        } elseif ($admin->usertype == 'Management') {
            // $accapp = Request_work::all()->where('type',$admin->usertype || 'Accountant'||'HR' );
            $accapp = Request_work::where(function ($q) {
                $q->where('Management', 'Active');
            })->get();
            return view('partadmin', ['admin' => $admin, 'accapp' => $accapp]);
        } else {
            return view('404');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $myUser)
    {
        $users = new User();
        $users->name = $myUser->userName;
        $users->usertype = $myUser->userType;
        $users->email = $myUser->userEmail;
        $users->password = Hash::make($myUser->userPassword);
        if (empty($users->name) || empty($users->usertype) || empty($users->email) || empty($users->password)) {
            return response()->json([' status ' => false, 'msg ' => "the user hasn't been added"]);
        } else {
            $users->save();
           return redirect('/mainadmin');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function show($id)
    {

        $req = Request_work::all()->find($id);
        $user = User::where('email', $req->email)->first();
        // dd($user->name);
        return view('adminShow', ['req' => $req, 'user' => $user]);
    }

    public function showUser($id)
    {
        $types = userType::all();
        $members =  User::findOrFail($id);
        return view('editUser', ['types' => $types, 'members' => $members]);
    }

    public function updateUser(Request $request)
    {
        $id = $request->id;
        // dd($id);
        // $affected = DB::table('users')
        // ->where('id', 1)
        // ->update(['votes' => 1]);
        $mem = User::findOrFail($id);
        $mem->name = $request->userName;
        $mem->email = $request->userEmail;
        $mem->usertype = $request->userType;
        $mem->password = Hash::make($request->userPassword);
        $mem->update();

        return redirect('/mainadmin');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = User::findOrFail($id);
        // dd($delete);
        $delete->delete();
        return redirect('mainadmin');
    }


    /*******************************  GET Requests **********************/


    // // Approval
    // public function approvehr($id)
    // {
    //     $aprove = WorkFlow::findOrFail($id);
    //     $req = Requests::all()->find($id);
    //     $req->status = 'In a Process';
    //     // dd($aprove);
    //     // DB::table('work_flows')
    //     //     ->where('id', $id)
    //     //     ->update(['hr' => "Approved"]);
    //     $aprove->hr = 'Approved';

    //     $aprove->Management = 'Active';
    //     $req->save();
    //     $aprove->save();
    //     return redirect('adminpart/hr');
    // }

    public function approved($id)
    {
        $email = auth()->user()->email;
        $date = User::where('email', $email)->first();
        $aprove = Request_work::findOrFail($id);

        if ($date->usertype == 'HR') {
            $aprove->status = 'In a Process';
            $aprove->hr = 'Approved';
            $aprove->Management = 'Active';
        } elseif ($date->usertype == 'Accountant') {
            $aprove->status = 'In a Process';
            $aprove->Accountant = 'Approved';
            $aprove->hr = 'Active';
        } elseif ($date->usertype == 'Management') {
            $aprove->Management = 'Approved';
            $aprove->status = 'Approved';
        }
        $aprove->update();
        // dd($aprove);
        return redirect('partadmin');
    }

    //Rejection

    public function rejection($id)
    {
        $email = auth()->user()->email;
        $reject = Request_work::findOrFail($id);
        $date = User::where('email', $email)->first();

        if ($date->usertype == 'HR') {
            $reject->hr = 'Rejected';
            $reject->Management = '--';
            $reject->status = 'Rejected';
        } elseif ($date->usertype == 'Accountant') {
            $reject->Accountant = 'Rejected';
            $reject->hr = '--';
            $reject->Management = '--';
            $reject->status = 'Rejected';
        } elseif ($date->usertype == 'Management') {
            $reject->Management = 'Rejected';
            $reject->status = 'Rejected';
        }
        $reject->update();
        return redirect('partadmin');
    }
}
