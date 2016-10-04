<div id="content">
    <section id="widget-grid" class="">
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false"
                     data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false">

                    <header>
                        <span class="widget-icon"> <i class="fa fa-edit"></i> </span>

                        <h2>首頁管理</h2>

                        <ul class="nav nav-tabs pull-right in" id="myTab">
                            <li class="active">
                                <a data-toggle="tab" href="#tab"><span class="hidden-mobile hidden-tablet">圖片</span></a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab2"><span class="hidden-mobile hidden-tablet">內文</span></a>
                            </li>
                        </ul>

                    </header>

                    <div>
                        <div class="widget-body no-padding">
                            <form class="form-horizontal" method="post" action="<?= site_url('bkhome') ?>" enctype="multipart/form-data">
                                <div id="myTabContent" class="tab-content">

                                    <div class="tab-pane fade active in padding-10 no-padding-bottom" id="tab">
                                        <div id="content">
                                            <fieldset>
                                                <legend>上傳圖片</legend>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">圖片</label>

                                                    <div class="col-sm-9">
                                                        <input type="file" class="btn btn-default" id="UploadImg" name="image">

                                                        <p class="help-block">
                                                            圖片最佳大小為965*1080
                                                        </p>

                                                        <p class="help-block">
                                                            <img id="preview" src="<?=($home && file_exists($home->image))?base_url($home->image):''?>">
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">標題</label>

                                                    <div class="col-sm-6">
                                                        <input class="form-control" maxlength="150" type="text" name="title" value="<?=($home)?$home->title:''?>" required>
                                                    </div>
                                                </div>

                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="tab2">
                                        <div id="content">
                                            <fieldset>
                                                <legend>內文</legend>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">標題</label>

                                                    <div class="col-sm-6">
                                                        <input class="form-control" maxlength="150" type="text" name="content_title" value="<?=($home)?$home->content_title:''?>" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">內文</label>

                                                    <div class="col-sm-6">
                                                        <textarea class="form-control" rows="30" name="content" required><?=($home)?$home->content:''?></textarea>
                                                    </div>
                                                </div>

                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="widget-footer">
                                        <button type="submit" class="btn btn-primary" id="submit">確定</button>
                                    </div>
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