<?php

/*
 * This file is part of the hui-ho/quality-course.
 *
 * (c) jiehui <hui-ho@outlook.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Admin\Extensions;

use Encore\Admin\Form\Field;

class Editor extends Field
{
    protected $view = 'admin.editor';

    protected static $css = [
        'css/simplemde.min.css',
    ];

    protected static $js = [
        'js/simplemde.min.js',
        'js/inline-attachment.js',
        'js/codemirror-4.inline-attachment.js',
        'js/input.inline-attachment.js',
    ];

    public function render()
    {
        $name = $this->formatName($this->column);

        $imgUploadUrl = route('topics.upload_image');
        $csrfToken = csrf_token();

        $this->script = <<<EOT

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
            uploadUrl: '$imgUploadUrl',
            extraParams: { _token: '$csrfToken' },
            uploadFieldName: 'upload_file',
            jsonFieldName: 'filename',
            urlText: "![Image]({filename})"
        });

EOT;

        return parent::render();
    }
}
