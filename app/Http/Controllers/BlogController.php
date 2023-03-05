<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    protected $BLOGS_PER_PAGE = 5;

    public function __construct()
    {
        $path = fn($id) => '/images/'.$id .'.jpg';
        $this->image_url_path = fn($id) => env('APP_URL').$path($id);
        $this->image_full_path = fn($id) => public_path($path($id));
 
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){
        // pagination
        $current_page = $request->input('page', 1);
        // search
        $search_query = $request->query('title');

        $blogs = Blog::with('user')
        ->orderBy('created_at', 'desc')
        ->where('title', 'like', '%'.$search_query.'%')
        ->paginate($this->BLOGS_PER_PAGE, ['*'], 'page', $current_page);
        
        return view('blog-index')->with('blogs', $blogs)
        ->with('total_pages', $blogs->lastPage())
        ->with('current_page', $current_page);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('blog-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $blog = new Blog();
        
        $blog->title = $request->title;
        $blog->body = $request->body;
        $blog->user_id = $request->user()->id;
        $id = Blog::count() + 1;
        
        // use file put contents to store the image
  
        file_put_contents(($this->image_full_path)($id), $request->file('image')->get());
        $blog->featured_image_path = ($this->image_url_path)($id);
  
        $blog->save();
        return redirect()->route('blog.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog = Blog::with('user')->find($id);
        return view('blog-show')->with('blog', $blog);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = Blog::find($id);
    
        return view('blog-create')->with('blog',$blog);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $blog = Blog::find($id);
        $blog->title = $request->title;
        $blog->body = $request->body;
  
        if($request->file('image'))
        file_put_contents(($this->image_full_path)($id), $request->file('image')->get());
        $blog->save();
        return redirect()->route('blog.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
        if (Blog::find($id)->user_id != auth()->user()->id) {
            return redirect()->back();
        }
        Blog::destroy($id);
        return redirect()->route('blog.index');
    }
}
