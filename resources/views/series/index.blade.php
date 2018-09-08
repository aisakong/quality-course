@extends('layouts.app')

@section('title', '课程')

@section('content')
<div class="top" style="padding: 40px 0 80px 0;">
    <div class="container text-center">
        <h1>所有课程</h1>
        <p style="font-size: 22px">共 {{ $series->count() }} 门课程，其中 {{ $series->where('archived', true)->count() }} 门已完结</p>
    </div>
</div>

<div class="body" style="padding: 50px 0;background: #fff;">
    <div class="container">
        <div class="row">
            @foreach($series as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 series-card">
                    <a href="{{ route('series.show', $item) }}">
                        <div clss="series-card-thumbnail">
                            <img src="{{ asset('/uploads/' . $item->thumb) }}" alt="{{ $item->title }}" class="img-responsive">
                        </div>
                        
                        <div class="series-card-details">
                            @if($item->archived)
                                <div class="series-card-status archived">
                                    已完结
                                </div>
                            @else
                                <div class="series-card-status updating">
                                    更新中
                                </div>
                            @endif

                            <h3 class="series-card-title">
                                {{ $item->title }}
                            </h3>

                            <div class="series-card-smallest">
                                <p>
                                    {{ $item->video_count }} lessons
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@stop