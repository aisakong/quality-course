<?php

/*
 * This file is part of the hui-ho/quality-course.
 *
 * (c) jiehui <hui-ho@outlook.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Tests\Feature;

use App\Category;
use App\Reply;
use App\Topic;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 用户可以查看登录页面.
     */
    public function test_a_user_can_browse_login()
    {
        $this->get(route('login'))->assertStatus(200);
    }

    /**
     * 用户可以查看注册页面.
     */
    public function test_a_user_can_browse_register()
    {
        $this->get(route('register'))->assertStatus(200);
    }

    /**
     * 用户可以查看其他用户的个人主页.
     */
    public function test_a_user_can_browse_other_users_homepage()
    {
        // 如果有一个 User
        $user = factory(User::class)->create();

        // 该 User 有 Topic
        $category = factory(Category::class)->create();
        $topic = factory(Topic::class)
            ->create([
                'user_id' => $user->id,
                'category_id' => $category->id,
            ]);

        // 该 User 有 Reply
        $reply = factory(Reply::class)
            ->create([
                'user_id' => $user->id,
                'topic_id' => $topic->id,
            ]);

        // 页面能否正常访问
        $response = $this->get(route('users.show', $user));
        $response->assertStatus(200);

        // 查看个人信息
        $response->assertSee($user->name);

        // 查看 ta 的话题
        $response->assertSee($topic->title);

        // 查看 ta 的回复
        $response->assertSee($reply->content);
    }
}
