<?php

/*
 * This file is part of the hui-ho/quality-course.
 *
 * (c) jiehui <hui-ho@outlook.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Middleware;

use Auth;
use Closure;

class RecordLastActivedTime
{
    public function handle($request, Closure $next)
    {
        // 如果是登录用户的话
        if (Auth::check()) {
            // 记录最后登录时间
            Auth::user()->recordLastActivedAt();
        }

        return $next($request);
    }
}
