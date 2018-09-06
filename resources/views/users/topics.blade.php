@extends('layouts.app')

@section('title', $user->name . ' 发起的话题')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
            @include('users._sidebar')
        </div>

        <div class="col-lg-9 col-md-3">
            <div class="panel panel-default all-topics">
                <div class="panel-heading text-center">
                    <i class="text-md fa fa-list-ul"></i> 发布的话题
                </div>

                <div class="panel-body">
                    <ul class="list-group">
                        @if(count($topics))
                            @foreach($topics as $topic)
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
                        @else
                            <p class="text-center">暂无数据 ~_~</p>
                        @endif
                    </ul>
                    <div class="text-center">
                        {!! $topics->appends(Request::except('page'))->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop