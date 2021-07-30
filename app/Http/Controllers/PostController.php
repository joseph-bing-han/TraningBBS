<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $category_id = null)
    {
        $posts = Post::with(['category', 'creator'])->where('is_top', 1)->whereNull('parent_id')
            ->when(!empty($category_id) && Post::whereId($category_id)->exists(), function ($query) use ($category_id) {
                $query->where('category_id', $category_id);
            })
            ->orderByDesc('updated_at')->paginate(config('app.page_size'));
        return view('post.list', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($category_id, $id)
    {
        $post = Post::with(['creator', 'category'])->findOrFail($id);
        $comments = Post::with(['creator'])->where('parent_id', $id)->orderBy('created_at')
            ->paginate(config('app.page_size'));
        return view('post.detail', compact('post', 'comments'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
