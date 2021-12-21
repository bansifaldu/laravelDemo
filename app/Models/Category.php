<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;
use DB;
 
class Category extends Model
{
    use HasFactory,LaravelVueDatatableTrait;
    protected $table = 'category';

    protected $fillable = [
        'name'       
     ];
    protected $dataTableColumns = [
        'id' => [
            'searchable' => false,
        ],
        'name' => [
            'searchable' => false,
        ],
         
    ];

    protected $dataTableRelationships = [
        //
    ];
    
    public function get_category_edit($id){
        $category = DB::table('category')
        ->where('id', $id)
        ->get();
        return $category;
    } 
    public function update_category($data){
        // echo "<pre>  "; print_r($data); exit;
        $category = DB::table('category')
                ->where('id', $data['id'])
               ->update(['name' =>$data['name'],'slug' =>$data['slug']]);
        return $category;
    } 

    // authentication

     
    
}
