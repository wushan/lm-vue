<style type="text/css">
    #preview {
        width: auto;
        max-width: 90%;
        max-height: 300px;
        margin-bottom: 6px;
        padding: 3px;
        /*display: none;*/
    }
</style>
<div id="content">
    <section id="widget-grid" class="">
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false"
                     data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false">

                    <header>
                        <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                        <h2>編輯</h2>
                    </header>

                    <div>
                        <div class="widget-body no-padding">
                            <form class="form-horizontal" method="post" action="<?=site_url('bkerror/edit_error/'.$errorCodeID.'/'.$error->EID.'/'.$parentID)?>" enctype="multipart/form-data">
                                <div id="content">
                                    <fieldset>
                                        <legend>編輯</legend>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">圖片</label>

                                            <div class="col-sm-9">
                                                <input type="file" class="btn btn-default" id="UploadImg" name="image">

                                                <p class="help-block">
                                                    圖片最佳大小為850*175
                                                </p>

                                                <p class="help-block">
                                                    <img id="preview" src="<?=($error && file_exists($error->image))?base_url($error->image):''?>">
                                                </p>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">PDF</label>

                                            <div class="col-sm-9">
                                                <input type="file" class="btn btn-default" name="errorFile">

                                                <p class="help-block">
                                                    <?=($error && file_exists($error->file_path))?'檔名:'.$error->file_name:''?>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">標題</label>

                                            <div class="col-sm-6">
                                                <input class="form-control" maxlength="150" type="text" name="title" value="<?=$error->title?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">內文</label>

                                            <div class="col-sm-6">
                                                <textarea class="form-control" rows="10" name="content" required><?=$error->content?></textarea>
                                            </div>
                                        </div>

                                    </fieldset>
                                </div>

                                <div class="widget-footer">
                                    <button type="submit" class="btn btn-primary" id="submit">確定</button>
                                    <button type="button" class="btn btn-default" onclick="location.href='<?= site_url("bkerror/error_solution/".$errorCodeID.'/'.$parentID) ?>';">返回</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>
</div>


<script>
    $(document).ready(function () {
        $('input#UploadImg').change(function () {
            $this = $(this);
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function (e) {
                $this.siblings('p:last').children('img#preview').attr('src', e.target.result).show();
            }
        });
    });

</script>