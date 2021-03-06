<?php

/*
 * This file is part of the hui-ho/quality-course.
 *
 * (c) jiehui <hui-ho@outlook.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Observers;

use App\Jobs\TranslateSlug;
use App\Topic;

class TopicObserver
{
    public function created(Topic $topic)
    {
        $category = $topic->category;
        $category->increment('post_count', 1);
    }

    public function saving(Topic $topic)
    {
        // Markdown 转 Html
        $parsedown = new \Parsedown();
        $topic->body = $parsedown->text($topic->body);

        // XSS 过滤
        $topic->body = clean($topic->body, 'user_topic_body');

        // 生成话题摘录
        $topic->excerpt = make_excerpt($topic->body);
    }

    public function saved(Topic $topic)
    {
        // 如 slug 字段无内容，即使用翻译器对 title 进行翻译
        if (!$topic->slug) {
            // 推送任务到队列
            dispatch(new TranslateSlug($topic));
        }
    }

    public function deleted(Topic $topic)
    {
        // 删除回复
        \DB::table('replies')->where('topic_id', $topic->id)->delete();

        // 给分类的话题数减一
        $topic->category->decrement('post_count', 1);
    }
}
