<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CheckItem;
use App\Models\Checklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ChecklistController extends Controller
{
    public function create_list(Request $request){
        $data = $request->all();
        
        if(Checklist::create($data)){
            return redirect()->back()->with('status','List was created successful');
        }
        else{
            return redirect()->back()->with('status','List was not created');
        }
    }

    public function add_item(Request $request){
        if(CheckItem::create($request->all())){

            $details = [
                'title' => 'Geekulcha',
                'body' => 'You assigned a task in <a href="">$request->title</a>',
                ];
            
               \Mail::to('stevens.monareng@gmail.com')->send(new \App\Mail\Checklists($details));
               
            return redirect()->back()->with('status','Item was added successful');
        }
        else{
            return redirect()->back()->with('status','Item was not added');
        }
    }

    public function item_complete($id) {
        $update = CheckItem::find($id);

        if($update){
            DB::update("update check_items set  status = '1' where id = '$id'");
            return redirect()->back()->with('status','Item Completed');
        }
    }

public function clonelist(Request $request)
{ 
   
    $request->validate([
        'title' => 'required',
        'category' => 'required',
       
    ]);

    $list = Checklist::where('id', $request->lid)->get();
        
    if(count($list) > 0) { 
        $items = CheckItem::where('lid', $request->lid)->get();
         $request["author"] = Auth::user()->id;
         
        if(Checklist::create($request->except(['lid']))) {
            //Get new list
            $newlist = Checklist::OrderByDesc('created_at')->where('title', $request->title)->get();
            
            foreach($items as $i) {
                CheckItem::create(['title'=>$i->title, 'lid'=>$newlist[0]->id, 'description'=>$i->description ,'priority'=>$i->priority ]);
              
            }
          
            return redirect()->back()->with('status','Checklist was cloned successfully ');
        }
        else {
            return redirect()->back()->with('status','Checklist was not cloned ');
           
        }
        
     }
}

public function edit_list($id){
    $edit = Checklist::find($id);

    return view('/edit',compact('edit'));
}

public function update_list(Request $request){
    $id = $request->input('lid');
    $title = $request->input('title');
    $category = $request->input('category');
    $description = $request->input('description');
    
    DB::update("update Checklists set title = '$title', category = '$category', description = '$description' where id = '$id'");
    return redirect()->back()->with('status','Checlist was successfully Updated');
}

public function delete($id){
    DB::table('checklists')->where('id',  $id)->delete();
    DB::table('check_items')->where('lid',  $id)->delete();
    return redirect()->back()->with('status','Checklist was successfully delete');
}


}
