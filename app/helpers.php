<?php
if (!function_exists('md_editor_config')) {
    function md_editor_config($editor_id = 'mdeditor', $height = 640)
    {
        return '<!--editor.md config-->
<script type="text/javascript">
var _' . $editor_id . ';
$(function() {
    //修正emoji图片错误
    editormd.emoji     = {
        path  : "//staticfile.qnssl.com/emoji-cheat-sheet/1.0.0/",
        ext   : ".png"
    };
    _' . $editor_id . ' = editormd({
        id : "' . $editor_id . '",
        width :"' . config('editor.width', '90%') . '",
        height : ' . $height . ',
        saveHTMLToTextarea : ' . config('editor.saveHTMLToTextarea') . ',
        emoji : ' . config('editor.emoji') . ',
        taskList : ' . config('editor.taskList') . ',
        tex : ' . config('editor.tex') . ',
        toc : ' . config('editor.toc') . ',
        tocm : ' . config('editor.tocm') . ',
        codeFold : ' . config('editor.codeFold') . ',
        flowChart: ' . config('editor.flowChart') . ',
        sequenceDiagram: ' . config('editor.sequenceDiagram') . ',
        path : "/vendor/editor.md/lib/",
        imageUpload : ' . config('editor.imageUpload') . ',
        imageFormats : ["jpg", "gif", "png"],
        imageUploadURL : "/laravel-editor-md/upload/picture?_token=' . csrf_token() . '&from=laravel-editor-md",
        toolbarIcons : function() {
            return editormd.toolbarModes["' . config('editor.toolbar', 'full') . '"]; // full, simple, mini
        },
        watch:' . config('editor.preview', 'false') . ',
        placeholder: "' . __(config('editor.placeholder', '')) . '",
    });
});
</script>';
    }
}
