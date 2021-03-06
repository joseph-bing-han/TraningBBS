<?php

/**
 * editor.md 配置选项，请查阅官网：https://pandao.github.io/editor.md/ 了解具体设置项
 * 这里只列出一些比较重要的可配置项
 * 请注意，这里的配置项值必须为字符串型的 `ture` 或 `false`
 */
return [
    "width" => '100%',
    'emoji' => 'false',  //emoji表情
    'toc' => 'false',  //目录
    'tocm' => 'false',  //目录下拉菜单
    'taskList' => 'false',  //任务列表
    'flowChart' => 'false',  //流程图
    'tex' => 'false',  //开启科学公式TeX语言支持，默认关闭
    'imageUpload' => 'true',  //图片上传支持
    'saveHTMLToTextarea' => 'false',  //保存 HTML 到 Textarea
    'codeFold' => 'true',  //代码折叠
    'sequenceDiagram' => 'false',  //开启时序/序列图支持，默认关闭
    'toolbar' => 'simple', //工具栏样式
    'preview' => 'false', //默认开启预览开关
    'placeholder' => 'post.md_placeholder',
];
