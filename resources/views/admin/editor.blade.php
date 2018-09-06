<div class="form-group {!! !$errors->has($label) ?: 'has-error' !!}">

    <label for="editor" class="col-sm-2 control-label">{{$label}}</label>

    <div class="col-sm-8">
        <div class="form-group" style="padding: 0 15px;">
            @include('admin::form.error')

            <textarea name="body" class="form-control" id="editor" rows="3" placeholder="请填入至少三个字符的内容，可拖拽上传图片。" required>{{ old($column, $value) }}</textarea>
            <style>
                .editor-toolbar.fullscreen{
                    z-index: 9999;
                }
                .CodeMirror-fullscreen{
                    z-index: 9999;
                }
            </style>
        </div>
    </div>
</div>

