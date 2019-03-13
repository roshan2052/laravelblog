<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Post;



class PostController extends Controller
{    
     public function __construct()
    {
        $this->middleware('auth',['except' => ['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     
          //$posts=Post::all();
          //$posts=post::orderBY('title','desc')->take(1)->get();
          $posts=post::orderBY('created_at','desc')->get();
          return view ('post.index')->with('pos',$posts);
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    } 

    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=> ['required', 'string', 'max:25'],
            'body'=> ['required', 'string','min:6'],
            'cover_image'=>'image|nullable|max:1999'
        ]);

          if ($request->hasFile('cover_image')) 
          {
            // get the file name with extension
            $filenameWithExt= $request->file('cover_image')->getClientOriginalName();
            // get just file name
            $filename= pathinfo( $filenameWithExt,PATHINFO_FILENAME);
            // get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension(); 
            //file name to store
            $fileNameToStore = $filename.''.time() . '.' . $extension;
            //upload the image
            $path= $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
          }

            else 
            {
                $fileNameToStore='noimage.jpg';
            }
            

            

         $post= new post;
         $post->title=$request->input('title');
         $post->body=$request->input('body');
         $post->user_id=auth()->user()->id;
         $post->cover_image = $fileNameToStore;

         $post->save();

         return redirect('/posts')->with('status','Post has been created');
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post= post::find($id);
        return view('post.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    

         $post= post::find($id);
         // check for correct user
         if(auth()->user()->id !== $post->user_id){
             return redirect('/posts')->with('status','You have no permission for this operation');
         }
         return view('post.edit')->with('post',$post);
         

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
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
        ]);

         $post= post::find($id);
         $post->title=$request->input('title');
         $post->body=$request->input('body');
         $post->save();

         return redirect('/posts')->with('status','post updated');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $post= post::find($id);
         if($post->cover_image != 'noimage.jpg')
         {
            Storage::delete('Public/cover_images/'.$post->cover_image);
         }
         $post->delete();
         return redirect('/posts')->with('status','post deleted');
    }

    
}
