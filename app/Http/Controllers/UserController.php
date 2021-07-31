<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function profile()
    {
        return view('user.profile', ['user' => auth()->user()]);
    }

    public function update(UserRequest $request)
    {
        $user = auth()->user();
        $avatar = $user->avatar;
        if ($request->hasFile('avatar')) {
            Storage::delete($avatar);
            $avatar = $request->file('avatar')->store('public/avatar');
        }
        $user->update([
            'name' => $request->input('name', $user->name),
            'avatar' => $avatar,
        ]);
        return redirect(route('users.profile'))->with('success', __('user.success'));
    }

    public function member($id)
    {
        $user = User::find($id);
        if ($user) {
            $posts = $user->posts()->paginate(config('app.page_size') / 2, ['*'], 'p_page');
            $comments = $user->comments()->paginate(config('app.page_size') / 2, ['*'], 'c_page');
            return view('user.member', compact('user', 'posts', 'comments'));
        } else {
            return redirect(RouteServiceProvider::HOME);
        }
    }
}
