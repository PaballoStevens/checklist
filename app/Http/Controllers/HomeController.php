<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\todolist;
use App\Models\Checklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $users = User::all();
        $checklist = DB::table('users')
        ->join('checklists','users.id','=', 'checklists.userid')
        ->get();
        $list = todolist::select(['id','userid','list','listName','status'])->get();
       return view('home', compact('users','checklist','list')); 
    
      
    }

    public function store(Request $request)
    {
        $request->validate([
            'list' => 'required',
            'listName' => 'required',
            'userid' => 'required',

        ]);
        

            if(Checklist::create($request->except(['list','assign']))) {

                $rid = Auth::user()->id;
                $listName= $request->listName;
               
    
            if(count($request->list) > 0) {
                for ($x = 0; $x < count($request->list); $x++) {
                    todolist::create(['userid'=>$rid,'listName'=>$listName, 'list'=>$request->list[$x],'assign'=>$request->assign[$x]]);   
                }
            }
    
           $details = [
                'title' => 'Geekulcha',
                'body' => 'List of pending request',
                ];
            
               \Mail::to('stevens.monareng@gmail.com')->send(new \App\Mail\MyTestMail($details));
       
        }
  
        return redirect()->back()->with('status','Post was successfully Updated');             
}

    
}