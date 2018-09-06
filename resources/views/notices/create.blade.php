@extends('layouts.app')

@section('title', '公告')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h2 class="text-center">
                            <span class="glyphicon glyphicon-edit" style="vertical-align: top;"></span>
                            发布公告
                        </h2>
                        <hr>

                        @include('common.error')
                        
                        <form action="{{ route('notices.store') }}" method="POST" accept-charset="UTF-8">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="title" value="{{ old('title') }}" placeholder="请填写标题" required/>
                                    </div>

                                    <div class="form-group">
                                        <textarea name="content" class="form-control" id="editor" rows="3" placeholder="请填入至少三个字符的内容，可拖拽上传图片。" required>{{ old('content') }}</textarea>
                                    </div>

                                    <div class="well well-sm">
                                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 保存</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
@stop

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
            uploadUrl: '{{ route('notices.upload_image') }}',
            extraParams: { _token: '{{ csrf_token() }}' },
            uploadFieldName: 'upload_file',
            jsonFieldName: 'filename',
            urlText: "![Image]({filename})"
        });
    </script>

@stop