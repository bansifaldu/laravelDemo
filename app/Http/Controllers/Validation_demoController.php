<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use DataTables;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use DB;
 use App\Models\Role;
use App\Models\User;
class Validation_demoController extends Controller
{
     
    public function index()
    {
      
      // echo "<pre>else"; print_r($category); exit;
       
      return view('validation_demo');
    }
    public function getcategory(Request $request)
     {
        $length = $request->input('length');
        $sortBy = $request->input('column');
        $orderBy = $request->input('dir');
        $searchValue = $request->input('search');
 
        $query = Category::eloquentQuery($sortBy, $orderBy, $searchValue, array());

        $data = $query->paginate($length);
 /*echo "<pre>"; print_r($res); exit;
*/        return new DataTableCollectionResource($data);
      
     }
     
    // public function getcategory(Request $request)
    // {
     
    //      if ($request->ajax()) {
    //          $data = Category::latest()->get();
    //         //  echo "<pre>else"; print_r($data); exit;
    //          return Datatables::of($data)
    //             ->addIndexColumn()
              
              
    //             ->addColumn('action', function($data){
    //                 $actionBtn = '<a href="/category/category_edit/'.$data->id.'"  id="getEditUserData" class="edit btn btn-success btn-sm">Edit</a> <a href="/category/deleteData/'.$data->id.'"  class="delete btn btn-danger btn-sm">Delete</a>';
    //                 return $actionBtn;
    //             })
                
    //             ->rawColumns(['action'])
    //              ->make(true);
    //     }
    // }
    public function create_category()
    { 
       return view('category.category_create');

    }
    public function create_category_save(Request $request)
      { 
        $this->validate($request, [
          'name' => ['required', 'string', 'max:255'],
           
        ]);

         
        $category = Category::create([
            'name' => $request->name,
         ]);
         
        //    echo "<pre>  "; print_r($request->all()); exit;
         
         return redirect()->route('category.category_management')
            ->with('success', 'Category created successfully');

      }
      public function category_edit($id)
      { 
         $category = Category::find($id);
        
        return view('category.category_edit', compact('category'));

      }
      public function category_edit_save(Request $request)
      { 
         
        // echo "<pre>  "; print_r($request->status); exit;
        $request->validate([
          'name' => ['required', 'string', 'max:255'],
         
        ]);
        
         $data = DB::table('category')
                ->where('id', $request->id)
               ->update(['name'=> $request->name]);
        
        //    echo "<pre>  "; print_r($request->all()); exit;
         
         return redirect()->route('category.category_management')
            ->with('success', 'Category updated successfully');

      }
      public function deleteData(Request $request)
      {
        $id=$request->id;
        DB::table('category')->where('id', $id)->delete();
        
          
      }
       
 
      
}
