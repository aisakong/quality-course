@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-body">
                <h2 class="text-center">
                    <i class="glyphicon glyphicon-edit"></i>
                    @if($topic->id)
                        编辑话题
                    @else
                        新建话题
                    @endif
                </h2>

                <hr>

                @include('common.error')

                @if($topic->id)
                    <form action="{{ route('topics.update', $topic->id) }}" method="POST" accept-charset="UTF-8">
                        <input type="hidden" name="_method" value="PUT">
                @else
                    <form action="{{ route('topics.store') }}" method="POST" accept-charset="UTF-8">
                @endif

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <select class="form-control" name="category_id" required>
                                    <option value="" hidden disabled {{ $topic->id ? '' : 'selected' }}>请选择分类</option>
                                    @foreach ($categories as $value)
                                        <option value="{{ $value->id }}" {{ $topic->category_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input class="form-control" type="text" name="title" value="{{ old('title', $topic->title ) }}" placeholder="请填写标题" required/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group topic-notice">
                        <ul>
                            <li>请注意单词拼写，以及中英文排版，<a href="https://github.com/sparanoid/chinese-copywriting-guidelines">参考此页</a></li>
                            <li>支持 Markdown 格式, <strong>**粗体**</strong>、~~删除线~~、<code>`单行代码`</code>, 更多语法请见这里 <a href="https://github.com/riku/Markdown-Syntax-CN/blob/master/syntax.md">Markdown 语法</a></li>
                            <li>上传图片, 支持拖拽上传, 格式限制 - jpg, png, gif</li>
                        </ul>
                    </div>

                    <div class="form-group">
                        <textarea name="body" class="form-control" id="editor" rows="3" placeholder="请填入至少三个字符的内容，可拖拽上传图片。" required>{{ old('body', $topic->body ) }}</textarea>
                    </div>

                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/simplemde.min.css') }}">
@stop

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/simplemde.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/inline-attachment.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/codemirror-4.inline-attachment.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/input.inline-attachment.js') }}"></script>

    <script>
        var simplemde = new SimpleMDE({ element: $("#editor")[0] });
        simplemde.codemirror.on("change", function () {
            $("#editor").val(simplemde.value());
        });

        inlineAttachment.editors.codemirror4.attach(simplemde.codemirror, {
            onFileUploadResponse: function (xhr) {
                var result = JSON.parse(xhr.responseText),
                    filename = result[this.settings.jsonFieldName];
                console.log(filename);
                console.log(this.filenameTag);
                if (result && filename) {
                    var newValue;
                    if (typeof this.settings.urlText === 'function') {
                        newValue = this.settings.urlText.call(this, filename, result);
                    } else {
                        newValue = this.settings.urlText.replace(this.filenameTag, filename);
                    }
                    console.log(newValue);
                    var text = this.editor.getValue().replace(this.lastValue, newValue);
                    this.editor.setValue(text);
                    this.settings.onFileUploaded.call(this, filename);
                }
                return false;
            },
            uploadUrl: '{{ route('topics.upload_image') }}',
            extraParams: { _token: '{{ csrf_token() }}' },
            uploadFieldName: 'upload_file',
            jsonFieldName: 'filename',
            urlText: "![Image]({filename})"
        });
    </script>

@stop