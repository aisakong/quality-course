@extends('layouts.app')

@section('title', $topic->title)
@section('description', $topic->excerpt)

@section('content')
<div class="container">
    <div class="row">

        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
            <div class="panel panel-default creator-info">
                <div class="panel-body text-center">
                    <div class="creator-name">
                        作者：{{ $topic->user->name }}
                    </div>
                    
                    <hr>

                    <div class="creator-thumb">
                        <a href="{{ route('users.show', $topic->user->id) }}">
                            <img class="thumbnail img-responsive" src="{{ $topic->user->avatar }}">
                        </a>
                    </div>

                    <div class="text-white creator-role">
                        <span class="label label-success role" style="">
                            @if( $topic->user->hasRole('Teacher') )
                                教师
                            @else
                                学生
                            @endif
                        </span>
                    </div>

                    <span>{{ $topic->user->introduction }}</span>
                    
                    <hr>
                </div>
            </div>

            @if(count($creator_topics))
            <div class="panel panel-default creator-topics">
                <div class="panel-heading text-center">
                    TA 的话题
                </div>
                <div class="panel-body">
                    @foreach($creator_topics as $item)
                    <a class="media" href="{{ route('topics.show', $item) }}">
                        <div class="media-body">
                            <span class="media-heading" title="{{ $item->title }}">{{ $item->title }}</span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

        </div>

        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1 class="text-center article-title">
                        {{ $topic->title }}
                    </h1>

                    <div class="article-meta text-center">
                        <i class="fa fa-clock-o"></i> <span title="{{ $topic->created_at }}">{{ $topic->created_at->diffForHumans() }}</span>
                        ⋅
                        <i class="fa fa-eye"></i> {{ $topic->view_count + visits($topic)->count() }}
                        <!-- ⋅
                        <i class="fa fa-thumbs-o-up"></i> 118 -->
                        ⋅
                        <i class="fa fa-comments-o"></i> {{ $topic->reply_count }}
                    </div>

                    <div class="article-body">
                        {!! $topic->body !!}
                    </div>

                    @can('update', $topic)
                        <div class="operate">
                            <hr>
                            <a href="{{ route('topics.edit', $topic->id) }}" class="btn btn-default btn-xs pull-left" role="button">
                                <i class="glyphicon glyphicon-edit"></i> 编辑
                            </a>

                            <form action="{{ route('topics.destroy', $topic->id) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-default btn-xs pull-left" style="margin-left: 6px">
                                    <i class="glyphicon glyphicon-trash"></i>
                                    删除
                                </button>
                            </form>
                        </div>
                    @endcan

                </div>
            </div>

            {{-- 用户回复列表 --}}
            <div class="panel panel-default topic-reply" id="reply">
                <div class="panel-body">
                    @includeWhen(Auth::check(), 'topics._reply_box', ['topic' => $topic])
                    @include('topics._reply_list', ['replies' => $topic->replies()->with('user')->get()])
                </div>
            </div>

        </div>
    </div>
</div>
@stop
