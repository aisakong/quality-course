@extends('layouts.app')

@section('title', isset($category) ? $category->name : '话题列表')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9 col-md-9 topic-list">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <ul class="list-inline topic-filter">
                        <li title="所有话题">
                            <a href="{{ route('topics.index') }}?order=default" class="{{ active_class( if_route('topics.index') ) }}">全部</a>
                        </li>
                        <li title="分享创造，分享发现">
                            <a href="{{ route('categories.show', 1) }}?order=default" class="{{ active_class((if_route('categories.show') && if_route_param('category', 1))) }}">分享</a>
                        </li>
                        <li title="开发技巧、推荐扩展包等">
                            <a href="{{ route('categories.show', 2) }}?order=default" class="{{ active_class((if_route('categories.show') && if_route_param('category', 2))) }}">教程</a>
                        </li>
                        <li title="请保持友善，互帮互助">
                            <a href="{{ route('categories.show', 3) }}?order=default" class="{{ active_class((if_route('categories.show') && if_route_param('category', 3))) }}">问答</a>
                        </li>

                        <li title="最后回复排序" class="pull-right">
                            <a href="{{ Request::url() }}?order=default" class="{{ active_class( ! if_query('order', 'recent') ) }}">活跃</a>
                        </li>
                        <li title="发布时间排序" class="pull-right">
                            <a href="{{ Request::url() }}?order=recent" class="{{ active_class( if_query('order', 'recent') ) }}">最近</a>
                        </li>
                        
                    </ul>

                    <div class="clearfix"></div>
                </div>

                <div class="panel-body">
                    {{-- 话题列表 --}}
                    @include('topics._topic_list', ['topics' => $topics])
                    {{-- 分页 --}}
                    <div class="text-center">
                        {!! $topics->appends(Request::except('page'))->render() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 sidebar">
            @include('topics._sidebar')
        </div>
    </div>
</div>
@endsection