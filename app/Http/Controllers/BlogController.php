<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function create(Request $request){
        $blog = new  Blog();
        $blog->body = $request->content ;
        $blog->save();
        return response()->json(['data'=>'پست جدید ساخته شد', 'id'=>$blog->id]);
    }
}
