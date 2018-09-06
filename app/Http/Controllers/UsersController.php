<?php

/*
 * This file is part of the hui-ho/quality-course.
 *
 * (c) jiehui <hui-ho@outlook.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\UserRequest;
use App\User;
use HuiHo\Snail\Student;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'topics']]);
    }

    public function show(User $user)
    {
        $recent_topics = $user->topics()->with('category')->recent()->limit(8)->get();
        $recent_replies = $user->replies()->recent()->take(6)->with('topic')->get();

        return view('users.show', compact('user', 'recent_topics', 'recent_replies'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)
    {
        $this->authorize('update', $user);

        $data = $request->all();

        if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $user->id, 362);

            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);

        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功！');
    }

    public function verify(Request $request, User $user)
    {
        $this->authorize('verify', $user);

        if ($request->isMethod('post')) {
            $request->validate([
                'student_id' => 'required',
                'password' => 'required',
            ]);

            $result = User::where('student_id', $request->input('student_id'))->first();
            if ($result) {
                return back()->with('danger', '验证失败！该学号已被注册！');
            }

            $student = new Student($request->input('student_id'), $request->input('password'));
            $profile = $student->getProfile();

            if (empty($profile)) {
                return back()->with('danger', '验证失败！学号或密码错误！');
            }

            $user->student_id = $request->input('student_id');
            $user->name = $profile['name'];
            $user->college = $profile['college'];
            $user->major = $profile['major'];
            $user->class = $profile['class'];
            $user->sex = $profile['sex'];
            $user->validated = true;
            $user->save();

            return redirect()
                ->route('users.show', $user->id)
                ->with('success', '验证成功！');
        }

        return view('users.verify');
    }

    public function topics(User $user)
    {
        $topics = $user->topics()->with('category')->paginate(25);

        return view('users.topics', compact('topics', 'user'));
    }

    public function replies(User $user)
    {
        $replies = $user->replies()->with('topic')->paginate(25);

        return view('users.replies', compact('replies', 'user'));
    }
}
