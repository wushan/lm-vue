<style type="text/css">
    #preview {
        width: auto;
        max-width: 90%;
        max-height: 300px;
        margin-bottom: 6px;
        padding: 3px;
        display: none;
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
                        <h2>新增</h2>
                    </header>

                    <div>
                        <div class="widget-body no-padding">
                            <form class="form-horizontal" method="post" action="<?=site_url('bkinventory/add_inventory')?>" enctype="multipart/form-data">
                                <div id="content">
                                    <fieldset>
                                        <legend>新增</legend>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">產品圖片</label>

                                            <div class="col-sm-9">
                                                <input type="file" class="btn btn-default" id="UploadImg" name="image" required>

                                                <p class="help-block">
                                                    圖片最佳大小為300*300
                                                </p>

                                                <p class="help-block">
                                                    <img id="preview" src="">
                                                </p>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">產品名稱</label>

                                            <div class="col-sm-6">
                                                <input class="form-control" maxlength="150" type="text" name="name" required>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">內文</label>

                                            <div class="col-sm-6">
                                                <textarea class="form-control" rows="8" name="content" required></textarea>
                                            </div>
                                        </div>

                                    </fieldset>
                                </div>

                                <div class="widget-footer">
                                    <button type="submit" class="btn btn-primary" id="submit">確定</button>
                                    <button type="button" class="btn btn-default" onclick="location.href='<?= site_url("bkinventory") ?>';">返回</button>
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