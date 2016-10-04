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
<?date_default_timezone_set("Asia/Shanghai");?>
<div id="content">
    <section id="widget-grid" class="">
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false"
                     data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false">

                    <header>
                        <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                        <h2>編輯新聞</h2>
                    </header>

                    <div>
                        <div class="widget-body no-padding">
                            <form class="form-horizontal" method="post" action="<?=site_url('bknews/edit_news/'.$news->NID)?>" enctype="multipart/form-data">
                                <div id="content">
                                    <fieldset>
                                        <legend>編輯新聞</legend>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">日期</label>

                                            <div class="col-sm-3">
                                                <input class="form-control"  type="date" name="date" value="<?=date('Y-m-d',strtotime($news->date))?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">代表圖</label>

                                            <div class="col-sm-9">
                                                <input type="file" class="btn btn-default" id="UploadImg" name="imageF" >

                                                <p class="help-block">
                                                    圖片最佳大小為850*175
                                                </p>

                                                <p class="help-block">
                                                    <img id="preview" src="<?=($news && file_exists($news->thumbnail))?base_url($news->thumbnail):''?>">
                                                </p>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">新聞背景圖</label>

                                            <div class="col-sm-9">
                                                <input type="file" class="btn btn-default" id="UploadImg" name="image">

                                                <p class="help-block">
                                                    圖片最佳大小為850*175
                                                </p>

                                                <p class="help-block">
                                                    <img id="preview" src="<?=($news && file_exists($news->bgimage))?base_url($news->bgimage):''?>">
                                                </p>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">新聞輪播圖A</label>

                                            <div class="col-sm-9">
                                                <input type="file" class="btn btn-default" id="UploadImg" name="imageA">

                                                <p class="help-block">
                                                    圖片最佳大小為850*175
                                                </p>

                                                <p class="help-block">
                                                    <img id="preview" src="<?=($news && file_exists($news->newsimageA))?base_url($news->newsimageA):''?>">
                                                </p>
                                            </div>
                                            <label class="col-sm-2 control-label">新聞輪播圖B</label>

                                            <div class="col-sm-9">
                                                <input type="file" class="btn btn-default" id="UploadImg" name="imageB" >

                                                <p class="help-block">
                                                    圖片最佳大小為850*175
                                                </p>

                                                <p class="help-block">
                                                    <img id="preview" src="<?=($news && file_exists($news->newsimageB))?base_url($news->newsimageB):''?>">
                                                </p>
                                            </div>
                                            <label class="col-sm-2 control-label">新聞輪播圖C</label>

                                            <div class="col-sm-9">
                                                <input type="file" class="btn btn-default" id="UploadImg" name="imageC" >

                                                <p class="help-block">
                                                    圖片最佳大小為850*175
                                                </p>

                                                <p class="help-block">
                                                    <img id="preview" src="<?=($news && file_exists($news->newsimageC))?base_url($news->newsimageC):''?>">
                                                </p>
                                            </div>
                                            <label class="col-sm-2 control-label">新聞輪播圖D</label>

                                            <div class="col-sm-9">
                                                <input type="file" class="btn btn-default" id="UploadImg" name="imageD" >

                                                <p class="help-block">
                                                    圖片最佳大小為850*175
                                                </p>

                                                <p class="help-block">
                                                    <img id="preview" src="<?=($news && file_exists($news->newsimageD))?base_url($news->newsimageD):''?>">
                                                </p>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">標題</label>

                                            <div class="col-sm-6">
                                                <input class="form-control" maxlength="150" type="text" name="title" value="<?=$news->title?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">簡介</label>

                                            <div class="col-sm-6">
                                                <textarea class="form-control" rows="3" name="excerpt" required><?=$news->excerpt?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">內文</label>

                                            <div class="col-sm-6">
                                                <textarea class="form-control" rows="20" name="content" required><?=$news->content?></textarea>
                                            </div>
                                        </div>

                                    </fieldset>
                                </div>

                                <div class="widget-footer">
                                    <button type="submit" class="btn btn-primary" id="submit">確定</button>
                                    <button type="button" class="btn btn-default" onclick="location.href='<?= site_url("bknews") ?>';">返回</button>
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