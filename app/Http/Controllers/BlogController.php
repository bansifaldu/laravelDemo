<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Blog;
use DataTables;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use DB;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        
      $blog = Blog::all()->toArray();
      // echo "<pre>else"; print_r($category); exit;
       
      return view('blog.list', compact('blog'));
    }

    public function getBlogs(Request $request)
    {
       //$data = Blog::latest()->limit(10)->paginate(10);
             //  echo "<pre>else"; print_r($data); exit;
             /*return Datatables::of($data)
                ->addIndexColumn()
              
              
                ->addColumn('action', function($data){
                    $actionBtn = '<a href="/permission/permission_edit/'.$data->id.'"  id="getEditUserData" class="edit btn btn-success btn-sm">Edit</a> <a href="/permission/deleteData/'.$data->id.'"  class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                
                ->rawColumns(['action'])
                 ->make(true);*/
           // return $data;
        $length = $request->input('length');
        $sortBy = $request->input('column');
        $orderBy = $request->input('dir');
        $searchValue = $request->input('search');
 
        $query = Blog::eloquentQuery($sortBy, $orderBy, $searchValue, array());
 
        $data = $query->paginate($length);
 /*echo "<pre>"; print_r($res); exit;
*/        return new DataTableCollectionResource($data);
    }  
    public function create_blogs(){
        return view('blog.blog_create'); 
    } 
    public function create_blogs_save(Request $request)
      { 

        $this->validate($request, [
          'title' => ['required', 'string', 'max:255'],
          'category' => ['required', 'string', 'max:255'],
          'description' => ['required', 'string', 'max:255'],
           
        ]);
        $blogs = Blog::create([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
        ]);
         
        //    echo "<pre>  "; print_r($request->all()); exit;
         
         return redirect()->route('blogs.blogs_management')
            ->with('success', 'Blogs created successfully');

      }
      public function blogs_edit($id)
      { 
        $blog = Blog::find($id);
        $title=$blog->title;
/*        echo "<pre>"; print_r($title); exit;
*/ 
        return view('blog.blog_edit', compact('blog','title'));

      }
       public function blogs_edit_save(Request $request)
      { 
         
         $this->validate($request, [
          'title' => ['required', 'string', 'max:255'],
          'category' => ['required', 'string', 'max:255'],
          'description' => ['required', 'string', 'max:255'],
           
        ]);
        

        $data = DB::table('blogs')
                ->where('id', $request->id)
               ->update(['title'=> $request->title,'category'=> $request->category,'description'=> $request->description]);
         
        //    echo "<pre>  "; print_r($request->all()); exit;
         
         return redirect()->route('blogs.blogs_management')
            ->with('success', 'Blogs updated successfully');

      }
      public function deleteData(Request $request)
      {
        $id=$request->id;
        DB::table('blogs')->where('id', $id)->delete();
        
          
      }

} 