<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * list posts
     * @param  Request  $request
     * @param  null  $category_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $category_id = null)
    {
        $posts = Post::with(['category', 'creator'])->where('is_top', 1)->whereNull('parent_id')
            ->when(!empty($category_id) && Category::whereId($category_id)->exists(), function ($query) use ($category_id) {
                $query->where('category_id', $category_id);
            })
            ->orderByDesc('updated_at')->paginate(config('app.page_size'));
        return view('post.list', ['posts' => $posts]);
    }

    /**
     * display post create page
     * @param $category_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($category_id = null)
    {
        return view('post.edit');
    }


    /**
     * display a post detail page
     * @param $category_id
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
     * @return \Illuminate\Http\Response
     */
    public function save(PostRequest $request)
    {
        $post = Post::create(array_replace($request->all(), [
            'user_id' => auth()->id(),
            'is_top' => true,
            'parent_id' => null,
        ]));
        return redirect(route('posts.show', ['category_id' => $post->category_id, 'id' => $post->id]));
    }

    public function update(CommentRequest $request)
    {
        $post = Post::create(array_replace($request->all(), [
            'user_id' => auth()->id(),
            'is_top' => false,
        ]));
        $pages = Post::with(['creator'])->where('parent_id', $post->parent_id)->orderBy('created_at')
            ->paginate(config('app.page_size'));
        return redirect(route('posts.show',
            ['category_id' => $post->category_id, 'id' => $post->parent_id, 'page' => $pages->lastPage()]));
    }


}
