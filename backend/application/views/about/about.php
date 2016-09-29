<style>
    table, th {
        text-align: center;
    }

    #previewBnaeer {
        width: 100%;
        height: 30px;
        overflow: hidden;
        position: relative;
    }

    #previewBnaeer img {
        width: 100%;
        padding: 3px;
        margin: -50% 0;
        background-color: white;
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

                        <h2>關於我們</h2>

                        <ul class="nav nav-tabs pull-right in">
                            <li>
                                <a data-toggle="tab" href="#tab"><span class="hidden-mobile hidden-tablet">區塊A</span></a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab1"><span class="hidden-mobile hidden-tablet">區塊B</span></a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab2"><span class="hidden-mobile hidden-tablet">區塊C</span></a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab3"><span class="hidden-mobile hidden-tablet">區塊D</span></a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab4"><span class="hidden-mobile hidden-tablet">區塊E</span></a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab5"><span class="hidden-mobile hidden-tablet">輪播圖</span></a>
                            </li>
                        </ul>

                    </header>

                    <div>
                        <div class="widget-body no-padding">
                            <form class="form-horizontal" method="post" action="<?= site_url('bkabout') ?>" enctype="multipart/form-data">
                                <div id="myTabContent" class="tab-content">

                                    <div class="tab-pane fade " id="tab">
                                        <div id="content">
                                            <fieldset>
                                                <legend>區塊A</legend>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">內文</label>

                                                    <div class="col-sm-6">
                                                        <textarea class="form-control" rows="30" name="contentA" required><?=($about)?$about->contentA:''?></textarea>
                                                    </div>
                                                </div>

                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="tab1">
                                        <div id="content">
                                            <fieldset>
                                                <legend>區塊B</legend>


                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">內文</label>

                                                    <div class="col-sm-6">
                                                        <textarea class="form-control" rows="5" name="contentB" required><?=($about)?$about->contentB:''?></textarea>
                                                    </div>
                                                </div>

                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="tab2">
                                        <div id="content">
                                            <fieldset>
                                                <legend>區塊C</legend>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">圖片</label>

                                                    <div class="col-sm-9">
                                                        <input type="file" class="btn btn-default" id="UploadImg" name="imageC">

                                                        <p class="help-block">
                                                            圖片最佳大小為850*175
                                                        </p>

                                                        <p class="help-block">
                                                            <img id="preview" src="<?=($about && file_exists($about->imageC))?base_url($about->imageC):''?>">
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">內文</label>

                                                    <div class="col-sm-6">
                                                        <textarea class="form-control" rows="30" name="contentC" required><?=($about)?$about->contentC:''?></textarea>
                                                    </div>
                                                </div>

                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="tab3">
                                        <div id="content">
                                            <fieldset>
                                                <legend>區塊D</legend>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">圖片</label>

                                                    <div class="col-sm-9">
                                                        <input type="file" class="btn btn-default" id="UploadImg" name="imageD">

                                                        <p class="help-block">
                                                            圖片最佳大小為850*175
                                                        </p>

                                                        <p class="help-block">
                                                            <img id="preview" src="<?=($about && file_exists($about->imageD))?base_url($about->imageD):''?>">
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">內文</label>

                                                    <div class="col-sm-6">
                                                        <textarea class="form-control" rows="30" name="contentD" required><?=($about)?$about->contentD:''?></textarea>
                                                    </div>
                                                </div>

                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="tab4">
                                        <div id="content">
                                            <fieldset>
                                                <legend>區塊E</legend>


                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">內文</label>

                                                    <div class="col-sm-6">
                                                        <textarea class="form-control" rows="5" name="contentE" required><?=($about)?$about->contentE:''?></textarea>
                                                    </div>
                                                </div>

                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="tab5">
                                        <section id="widget-grid" class="">
                                            <div id="content">
                                                <fieldset>
                                                    <legend>輪播圖</legend>
                                                    <div class="jarviswidget jarviswidget-color-darken" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false"
                                                         data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false">

                                                        <header>
                                                            <span class="widget-icon"><i class="fa fa-table"></i></span>
                                                            <h2>輪播圖</h2>
                                                        </header>

                                                        <div>
                                                            <div class="widget-body no-padding">
                                                                <div class="widget-body-toolbar">
                                                                    <div class="row">
                                                                        <div class="col-xs-12 text-right">
                                                                            <a class="btn btn-primary" href="<?=site_url('bkabout/add_banner')?>">
                                                                                <i class="fa fa-plus"></i> <span>新增輪播圖</span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="table-responsive">
                                                                    <table id="dt_basic" class="table table-bordered table-striped text-center">
                                                                        <thead>
                                                                        <tr>
                                                                            <th width="30%" class="text-center">圖片預覽</th>
                                                                            <th width="15%" class="text-center">功能</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <? if ($banner) { ?>
                                                                            <? foreach ($banner as $row) { ?>
                                                                                <tr>
                                                                                    <td>
                                                                                        <? if (isset($row->image)) { ?>
                                                                                            <div id="previewBnaeer">
                                                                                                <img src="<?= base_url($row->image) ?>">
                                                                                            </div>
                                                                                        <? } ?>
                                                                                    </td>

                                                                                    <td>
                                                                                        <a href="<?= site_url('bkabout/edit_banner/' . $row->ABID) ?>" class="btn btn-default" style=""><i class="fa fa-gear"></i><span class="hidden-tablet"> 編輯 </span></a>
                                                                                        <a href="<?= site_url('bkabout/delete_banner/' . $row->ABID) ?>" class="btn btn-danger" onclick="return confirm('確定要刪除?');"><i class="glyphicon glyphicon-trash"></i><span class="hidden-tablet"> 刪除 </span></a>
                                                                                    </td>
                                                                                </tr>
                                                                            <? } ?>
                                                                        <? } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </section>
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
    var hash = window.location.hash;
    $('ul.nav-tabs li').eq(hash.substr(1)).addClass('active');
    $('.tab-pane').eq(hash.substr(1)).addClass('active in');

    $(document).ready(function () {
        $("div#previewBnaeer").hover(
            function () {
                $(this).css("overflow", "visible").css("z-index", 99);
            },
            function () {
                $(this).css("overflow", "hidden").css("z-index", 1);
            }
        );
    });

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