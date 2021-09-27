<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\userType;

use App\Models\Requesttype;
use App\Models\Request_work;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ControllerSystem extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $user = auth()->user()->usertype;
        if($user == 'Employee'){
            $Types = Requesttype::all();
            return view('request', ['Types' => $Types]);
        }
        else{
            return view('404');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $req = new Request_work();
        $req->type = $request->type;
        $req->name = $request->name;
        $req->email =auth()->user()->email;
        // dd($req->email);
        $req->justification=$request->justi;
        $file=$request->attach;
        if ($file){
            $req->attach =$request->attach->getClientOriginalName();
            $name=$file->getClientOriginalName();
            $file->move('files',$name);
        }
        if (empty($req->name ) ) {
            return "Write Your Name & Email at least to save your request as draft Or Complete it to send successfully" . "<br><a href='/request'> Return to Form</a>";
        }
        elseif (empty($req->attach)) {
                $req->status = 'draft';
                $req->hr='Not Started';
                $req->Accountant='Not Started';
                $req->Management='No Started';
                $req->save();
                return redirect ('/myRequests/{email}');
                // return "Your Request Save as Draft To Complete it <br><a href ='requests'>Back to request request</a>";
            }  
        else {

            if (empty($req->justification)) {
                $req->status = 'draft';
                $req->hr ='Not Started';
                $req->Accountant ='Not Started';
                $req->Management ='No Started';
                $req->save();
                return redirect ('/myRequests/{email}');
                // return "Your Request Save as Draft To Complete it <br><a href ='requests'>Back to request </a>";
            } else {
                if($req->type == 'HR'){
                    $req->hr = 'Active';
                    $req->Accountant='None';
                    $req->Management='Not Started';
                    $req->status = 'pending';
                    $req->save();
                    return redirect ('/myRequests/{email}');
                }
                if($req->type == 'Accountant'){
                    $req->status = 'pending';
                    $req->hr='Not Started';
                    $req->Accountant='Active';
                    $req->Management='Not Started';
                    $req->save();
                    return redirect ('/myRequests/{email}');
               }
                
                if($req->type == 'Management'){
                    $req->status = 'pending';                  
                    $req->hr='None';
                    $req->Accountant='None';
                    $req->Management='Active';
                    $req->save();
                    return redirect ('/myRequests/{email}');
                }
            }
        }
    }

  
    
    public function Myreq( Request $request)
    {
        $email = auth()->user()->email;
        $reqs = Request_work::where('email', $email)->get();
        
        if($reqs){
           
            return view('myRequests', ['reqs' => $reqs ]);
        }
        else{
            return "Not Found";
        }
    }
    public function MyApp($id , Request $request)
    {
        $Types = Requesttype::all();
        $req = Request_work::all()->find($id);


            return view('showRequest', ['req' => $req ,'Types'=>$Types]);
 
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $id = $request->id ;
        $mem =Request_work::findOrFail($id);
        $mem->name = $request->name;
        $mem->justification = $request->justi;
        $file=$request->attachment;
        if ($file){
            $mem->attach =$request->attachment->getClientOriginalName();
            $name=$file->getClientOriginalName();
            $file->move('files',$name);
        }
        else{
            $mem->attach=$mem->attach;
        }
       
        if (!$request->type== $mem->type){
            if($mem->type == 'HR'){
                $mem->hr = 'Active';
                $mem->Accountant='None';
                $mem->Management='Not Started';
                $mem->status = 'pending';
            }
            if($mem->type == 'Accountant'){
                $mem->status = 'pending';
                $mem->hr='Not Started';
                $mem->Accountant='Active';
                $mem->Management='Not Started';
           }
            
            if($mem->type == 'Management'){
                $mem->status = 'pending';                  
                $mem->hr='None';
                $mem->Accountant='None';
                $mem->Management='Active';
            }
        }
        $mem->status = 'pending';
        $mem->update();
        return redirect('/myRequests/{email}');
        
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
