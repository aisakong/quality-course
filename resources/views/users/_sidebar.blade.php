<div class="panel panel-default">
    <div class="panel-body">
        <div class="media user-info">
            <div class="media-left">
                <a href="{{ route('users.show', $user->id) }}">
                    <img class="thumbnail" src="{{ $user->avatar }}" alt="{{ $user->name }}的头像">
                </a>
            </div>
            <div class="media-body">
                <h3 class="media-heading">
                    {{ $user->name }}
                </h3>
                <div class="item">
                    第 {{ $user->id }} 位会员
                </div>
                <div class="item">
                    注册于 <span class="timeago" title="{{ $user->created_at }}">{{ $user->created_at->diffForHumans() }}</span>
                </div>
                <div class="item">
                    活跃于 <span class="timeago" title="{{ $user->last_actived_at }}">{{ $user->last_actived_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>

        @if($user->validated)
            <hr>

            <div class="text-center">
                {{ $user->major }} @ {{ $user->college }}
            </div>
        @endif

        <hr>

        <div class="follow-info row">
            <div class="col-xs-5 col-xs-offset-1">
                <a class="counter" href="">{{ $user->replies()->count() }}</a>
                <a class="text" href="">讨论</a>
            </div>
            <div class="col-xs-5">
                <a class="counter" href="{{ route('users.topics', $user) }}">{{ $user->topics()->count() }}</a>
                <a class="text" href="{{ route('users.topics', $user) }}">话题</a>
            </div>
        </div>

        <hr>

        @if( $user->id == Auth::id() && !$user->validated)
            <a class="btn btn-danger btn-block" href="{{ route('users.verify', $user->id) }}">
                <i class="fa fa-edit"></i> 正方验证
            </a>
        @endif

        @can('update', $user)
            <a class="btn btn-success btn-block" href="{{ route('users.edit', $user->id) }}">
                <i class="fa fa-edit"></i> 编辑资料
            </a>
        @endcan

    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <ul class="list-group text-center">

            <a href="{{ route('users.topics', $user) }}" class="{{ active_class( if_route('users.topics') ) }}">
                <li class="list-group-item"><i class="text-md fa fa-list-ul"></i> Ta 发布的话题</li>
            </a>

            <a href="{{ route('users.replies', $user) }}" class="{{ active_class( if_route('users.replies') ) }}">
                <li class="list-group-item"><i class="text-md fa fa-comment"></i> Ta 发表的回复</li>
            </a>

            <!-- <a href="">
                <li class="list-group-item"><i class="text-md fa fa-thumbs-up"></i> Ta 赞过的话题</li>
            </a> -->

        </ul>
    </div>
</div>