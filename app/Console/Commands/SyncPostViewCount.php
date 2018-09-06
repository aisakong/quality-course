<?php

/*
 * This file is part of the hui-ho/quality-course.
 *
 * (c) jiehui <hui-ho@outlook.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Topic;

class SyncPostViewCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tips:sync-post-view-count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '同步话题点击量到数据库中';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Topic::chunk(100, function ($topics) {
            foreach ($topics as $topic) {
                $topic->view_count = $topic->view_count + visits($topic)->count();
                $topic->save();
            }
        });

        visits(Topic::class)->reset();

        $this->info('同步成功！');
    }
}
