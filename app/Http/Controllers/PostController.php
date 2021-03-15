<?php

namespace App\Http\Controllers;

use App\Models\{Language,PostsTranslation, Post};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($userid)
    {
        //
        // $posts = Post::with('user')->paginate(10);
        // return view('posts.index')->with([
        //     'posts' => $posts

        // ]);
        
        // $posts = Post::all();

        $langs= Language::all();
        // dd($langs->toArray());

        $posts=Post::where('user_id','=',$userid)->get();

        // $posts=DB::table('posts')->where(['user_id'=>$userid])->get();


        return view('postlist', [ 'posts'=> $posts , 'id'=>$userid, 'langs' =>$langs ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $req)
    {
        // $request->merge(['user_id' => 3]);
        // $this->validate($request, [
        //     'userId' => 'required',
        //     'name' => 'required',
        //     'content' => 'required'

        // ]);
        // Post::create($request->all());
        // return redirect('postlist')->with('successMsg', 'Post successfully added');

        $this->validate($req,[
            'userId'=>'required',
            'name'=>'required',
            'content'=>'required'
        ]);

        $post = new Post();
        // $post->id = $req->input('id');
        $post->user_id = $req->input('userId');
        $post->name = $req->input('name');
        $post->content = $req->input('content');
     
        $userid=$req->input('userId');
        $post->save();
        
        
        $posts=Post::where('user_id','=',$userid)->get();

        $count=Post::where('user_id','=',$userid)->count();

        // echo($count);

        // $posts=DB::table('users')->where(['email'=>$username,'password'=>$password])->get();

        $lang=new PostsTranslation();

        // $lang->id=$req->lang;
        $lang->post_id=$posts[$count-1]->id;
        $lang->language_id=$req->language;
        $lang->code="EN";
        $lang->save();
        // $lang->name=;
        
        

        

        return redirect("postlist/$userid");
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // $post=Post::where('id',$id)->first();
        $post=Post::find($id);
        // $posts = Post::all();
        return view('postlist',compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::find($id);
        return view('postlist', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'userId'=>'required',
            'name'=>'required',
            'content'=>'required'
        ]);
        $ids=$request->id;
        $post=Post::find($ids);
        // $post->id=$request->id;
        $post->user_id=$request->userId;
        $post->name=$request->name;
        $post->content=$request->content;
        $post->save();

        $userid=$request->userId;
        
        return redirect("postlist/$userid");
        // return redirect('postlist')->with('successMsg', 'Post successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //

        $posts=Post::where('id','=',$id)->get();
        Post::find($id)->delete();
        
        $userid=$posts[0]->user_id;
        echo($posts);

        return redirect("postlist/$userid");

        // return redirect('postlist')->with('successMsg', 'Post successfully deleted');
    }
}
