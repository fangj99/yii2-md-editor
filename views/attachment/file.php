<?php

use yii\helpers\Html;
?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">插入链接</h4>
</div>

<div class="modal-body" id="uploader">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#url" data-toggle="tab">链接地址</a></li>
        <li><a href="#upload" data-toggle="tab">上传文件</a></li>
        <li><a href="#history" data-toggle="tab">历史文件</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade in active" id="url">
            <div class="form-group">
                <label for="attachment-url">链接URL</label>
                <input type="text" class="form-control" id="attachment-url" placeholder="链接URL">
            </div>
            <div class="form-group">
                <label for="attachment-title">链接文本</label>
                <input type="text" class="form-control" id="attachment-title" placeholder="链接文本">
            </div>
        </div>
        <div class="tab-pane fade" id="upload">
            <?= Html::beginForm('', 'post', $options = ['id' => 'fileupload', 'enctype' => 'multipart/form-data']) ?>
            <div class="fileupload-buttonbar"> 
                <span class="btn btn-sm btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>添加文件...</span>
                    <?= Html::activeFileInput($model, 'file') ?>
                </span>
                <button type="submit" class="btn btn-sm btn-primary start">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>开始上传</span>
                </button>
                <button type="reset" class="btn btn-sm btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>取消上传</span>
                </button>
                <button type="button" class="btn btn-sm btn-danger delete">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>批量删除</span>
                </button>
                <input type="checkbox" class="toggle" />
            </div>
            <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
            <?= Html::endForm() ?>
            <script id="template-upload" type="text/x-tmpl">
            {% for (var i=0, file; file=o.files[i]; i++) { %}
                <tr class="template-upload fade">
                    <td>
                        <span class="preview"></span>
                    </td>
                    <td>
                        <p class="name">{%=file.name%}</p>
                        <strong class="error text-danger"></strong>
                    </td>
                    <td>
                        <p class="size">Processing...</p>
                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
                    </td>
                    <td>
                        {% if (!i && !o.options.autoUpload) { %}
                            <button class="btn btn-sm btn-primary start" disabled>
                                <i class="glyphicon glyphicon-upload"></i>
                                <span>开始</span>
                            </button>
                        {% } %}
                        {% if (!i) { %}
                            <button class="btn btn-sm btn-warning cancel">
                                <i class="glyphicon glyphicon-ban-circle"></i>
                                <span>取消</span>
                            </button>
                        {% } %}
                    </td>
                </tr>
            {% } %}
            </script>
            <script id="template-download" type="text/x-tmpl">
            {% for (var i=0, file; file=o.files[i]; i++) { %}
                <tr class="template-download fade">
                    <td>
                        <span class="preview">
                            {% if (file.thumbnailUrl) { %}
                                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                            {% } %}
                        </span>
                    </td>
                    <td>
                        <p class="name">
                            {% if (file.url) { %}
                                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                            {% } else { %}
                                <span>{%=file.name%}</span>
                            {% } %}
                        </p>
                        {% if (file.error) { %}
                            <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                        {% } %}
                    </td>
                    <td>
                        <span class="size">{%=o.formatFileSize(file.size)%}</span>
                    </td>
                    <td>
                        {% if (file.deleteUrl) { %}
                            <button class="btn btn-sm btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                                <i class="glyphicon glyphicon-trash"></i>
                                <span>删除</span>
                            </button>
                            <input type="checkbox" name="delete" value="1" class="toggle">
                        {% } else { %}
                            <button class="btn btn-sm btn-warning cancel">
                                <i class="glyphicon glyphicon-ban-circle"></i>
                                <span>取消</span>
                            </button>
                        {% } %}
                    </td>
                </tr>
            {% } %}
            </script>
        </div>
        <div class="tab-pane fade" id="history">
            <?php foreach($history as $data): ?>
            <div><?= $data->name ?></div>
            <?php endforeach; ?> 
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
    <button type="button" class="btn btn-success" data-dismiss="modal">插入</button>
</div>
