@extends('layouts.app')

@section('title', $user->name . ' 发表的话题')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
            @include('users._sidebar')
        </div>

        <div class="col-lg-9 col-md-3">
            <div class="panel panel-default all-replies">
                <div class="panel-heading text-center">
                    <i class="text-md fa fa-list-ul"></i> 发布的话题
                </div>

                <div class="panel-body">
                    <ul class="list-group">
                        @if(count($replies))
                            @foreach($replies as $reply)
                                <li class="list-group-item">
                                    <a href="{{ route('topics.show', $reply->topic->id) }}#reply{{ $reply->id }}" title="点击查看">
                                        {{ $reply->topic->category->name }}：{{ $reply->topic->title }}
                                        
                                        <span class="meta pull-right">
                                            <span class="timeago" title="{{ $reply->topic->created_at }}">{{ $reply->topic->created_at->diffForHumans() }}</span>
                                        </span>
                                    </a>

                                    <div class="reply-content">
                                        {!! $reply->content !!}
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <p class="text-center">暂无数据 ~_~</p>
                        @endif
                    </ul>
                    <div class="text-center">
                        {!! $replies->appends(Request::except('page'))->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop