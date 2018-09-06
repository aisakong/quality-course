@extends('layouts.app')

@section('title', $user->name . ' 的个人中心')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
            @include('users._sidebar')
        </div>

        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

            <div class="panel panel-default recent-topic">
                <div class="panel-heading text-center">
                    <i class="text-md fa fa-book"></i> 最近发表的话题
                </div>
                
                <div class="panel-body">

                    @if(count($recent_topics))
                        <ul class="list-group">
                            @foreach($recent_topics as $topic)
                                <li class="list-group-item">
                                    <a href="{{ route('topics.show', $topic->id) }}" title="点击查看话题" class="title rm-link-color">
                                        {{ $topic->title }}
                                    </a>

                                    <span class="meta pull-right">
                                        <a href="{{ route('categories.show', $topic->category->id) }}}" title="{{ $topic->category->name }}">
                                            {{ $topic->category->name }}
                                        </a>
                                        
                                        <span> ⋅ </span>
                                            0 点赞
                                        <span> ⋅ </span>
                                            {{ $topic->reply_count }} 回复
                                        <span> ⋅ </span>
                                        <span class="timeago" title="{{ $topic->created_at }}">{{ $topic->created_at->diffForHumans() }}</span>
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-center">暂无数据 ~_~</p>
                    @endif
                </div>
            </div>

            <div class="panel panel-default recent-reply">
                <div class="panel-heading text-center">
                    <i class="text-md fa fa-comments"></i> 最近发表的评论
                </div>

                <div class="panel-body">
                    <ul class="list-group">
                        @if(count($recent_replies))
                            @foreach($recent_replies as $reply)
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
                </div>
            </div>
        </div>
    </div>
</div>
@stop