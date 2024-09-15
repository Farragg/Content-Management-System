<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['gallery', 'category'])->get();
        return view('auth.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('auth.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {

            DB::beginTransaction();

            if ($request->has('file')){
                $file = $request->file;
                // adding time to generate unique name
                $fileName =time() . $file->getClientOriginalName();
                $imagePath = public_path('images/posts/');
                $file->move($imagePath, $fileName);

                $gallery = Gallery::create([
                    'image' => $fileName,
                ]);
            }

            Post::create([
                'title' => $request->title,
                'description' => $request->description,
                'category_id' => $request->category,
                'gallery_id' => $gallery->id,
                'is_published' => $request->is_published,
            ]);
            DB::commit();

        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

        $request->session()->flash('alert-success', 'Post Created Successfully');
        return to_route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        $post = Post::findOrFail($id);
        return view('auth.posts.edit', compact( 'categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $post = Post::findOrFail($id);

            if ($request->has('file')){

                // Delete old photo
                if ($post->gallery->image) {
                    $old_img = $post->gallery->image;
                    $old_img_path = public_path().$old_img;
                    unlink($old_img_path);
                }

                $file = $request->file;
                // adding time to generate unique name
                $fileName =time() . $file->getClientOriginalName();
                $imagePath = public_path('images/posts/');

                $file->move($imagePath, $fileName);

                Gallery::where('id', $post->gallery->id)->update([
                    'image' => $fileName,
                ]);
            }

            $post->update([
                'title' => $request->title,
                'description' => $request->description,
                'category_id' => $request->category,
                'is_published' => $request->is_published,
            ]);

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

        $request->session()->flash('alert-success', 'Post Updated Successfully');
        return to_route('posts.index');
    }


    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        // delete image locally
        $file = $post->gallery->image;
        $imagePath = public_path().$file;
        unlink($imagePath);

        // delete it in gallery model
        if ($post->gallery) {
            $post->gallery->delete();
        }

        $post->delete();
        session()->flash('alert-danger', 'Post Deleted Successfully');
        return to_route('posts.index');

    }
}
