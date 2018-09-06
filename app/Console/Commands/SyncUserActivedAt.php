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

use App\User;
use Illuminate\Console\Command;

class SyncUserActivedAt extends Command
{
    protected $signature = 'tips:sync-user-actived-at';

    protected $description = '将用户最后登录时间从 Redis 同步到数据库中';

    public function handle(User $user)
    {
        $user->syncUserActivedAt();
        $this->info('同步成功！');
    }
}
