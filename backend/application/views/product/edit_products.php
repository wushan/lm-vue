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

                        <h2>編輯產品</h2>

                        <ul class="nav nav-tabs pull-right in">
                            <li class="active">
                                <a data-toggle="tab" href="#tab"><span class="hidden-mobile hidden-tablet">產品資料</span></a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab1"><span class="hidden-mobile hidden-tablet">產品圖片&影片輪播</span></a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab2"><span class="hidden-mobile hidden-tablet">產品特色</span></a>
                            </li>
                        </ul>

                    </header>

                    <div>
                        <div class="widget-body no-padding">
                            <form class="form-horizontal" method="post" action="<?= site_url('bkproducts/edit_products/'.$product->PID) ?>" enctype="multipart/form-data">
                                <div id="myTabContent" class="tab-content">

                                    <div class="tab-pane fade active in" id="tab">
                                        <div id="content">
                                            <fieldset>
                                                <legend>產品資料</legend>

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">顯示首頁</label>

                                                    <div class="col-md-10">
                                                        <div class="checkbox">
                                                            <label class="col-md-2">
                                                                <input type="checkbox" name="is_home" value="1" <?= ($product->is_home == 1) ? 'checked' : '' ?>>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">顯示產品列表首頁</label>

                                                    <div class="col-md-10">
                                                        <div class="checkbox">
                                                            <label class="col-md-2">
                                                                <input type="checkbox" name="is_product_page" value="1" <?= ($product->is_product_page == 1) ? 'checked' : '' ?>>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">排序</label>

                                                    <div class="col-sm-1">
                                                        <input class="form-control" min="1" type="number" name="order" value="<?= $product->order ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">產品背景圖</label>

                                                    <div class="col-sm-9">
                                                        <input type="file" class="btn btn-default" id="UploadImg" name="image">

                                                        <p class="help-block">
                                                            圖片最佳大小為850*175
                                                        </p>

                                                        <p class="help-block">
                                                            <img id="preview" src="<?= ($product && file_exists($product->bgimage)) ? base_url($product->bgimage) : '' ?>">
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">產品圖</label>

                                                    <div class="col-sm-9">
                                                        <input type="file" class="btn btn-default" id="UploadImg" name="imageA">

                                                        <p class="help-block">
                                                            圖片最佳大小為850*175
                                                        </p>

                                                        <p class="help-block">
                                                            <img id="preview" src="<?= ($product && file_exists($product->pdimage)) ? base_url($product->pdimage) : '' ?>">
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">產品型錄</label>

                                                    <div class="col-sm-9">
                                                        <input type="file" class="btn btn-default" name="catalogFile">

                                                        <p class="help-block">
                                                            檔名:<?= ($product->catalog_name) ? $product->catalog_name : '無上傳檔案' ?>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">名稱</label>

                                                    <div class="col-sm-6">
                                                        <input class="form-control" maxlength="150" type="text" name="name" value="<?= $product->name ?>" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">介紹</label>

                                                    <div class="col-sm-6">
                                                        <textarea class="form-control" rows="15" name="intro" required><?= $product->intro ?></textarea>
                                                    </div>
                                                </div>

                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="tab1">
                                        <div id="content">
                                            <fieldset>
                                                <legend>第一筆</legend>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">輪播方式</label>

                                                    <div class="col-sm-1">
                                                        <input type="radio" name="carouselA_option" value="0" <?= ($product->carouselA_option == 0) ? 'checked' : '' ?>><span>圖片</span>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <input type="radio" name="carouselA_option" value="1" <?= ($product->carouselA_option == 1) ? 'checked' : '' ?>><span>影片</span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">圖片</label>

                                                    <div class="col-sm-3">
                                                        <input type="file" class="btn btn-default" id="UploadImg" name="imageB">

                                                        <p class="help-block">
                                                            圖片最佳大小為850*175
                                                        </p>

                                                        <p class="help-block">
                                                            <img id="preview" src="<?= ($product && file_exists($product->carouselA_image)) ? base_url($product->carouselA_image) : '' ?>">
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">影片</label>

                                                    <div class="col-sm-4">
                                                        <input class="form-control" maxlength="255" type="text" name="carouselA" value="<?= $product->carouselA ?>">
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <legend>第二筆</legend>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">輪播方式</label>

                                                    <div class="col-sm-1">
                                                        <input type="radio" name="carouselB_option" value="0" <?= ($product->carouselB_option == 0) ? 'checked' : '' ?>><span>圖片</span>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <input type="radio" name="carouselB_option" value="1" <?= ($product->carouselB_option == 1) ? 'checked' : '' ?>><span>影片</span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">圖片</label>

                                                    <div class="col-sm-3">
                                                        <input type="file" class="btn btn-default" id="UploadImg" name="imageC">

                                                        <p class="help-block">
                                                            圖片最佳大小為850*175
                                                        </p>

                                                        <p class="help-block">
                                                            <img id="preview" src="<?= ($product && file_exists($product->carouselB_image)) ? base_url($product->carouselB_image) : '' ?>">
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">影片</label>

                                                    <div class="col-sm-4">
                                                        <input class="form-control" maxlength="255" type="text" name="carouselB" value="<?= $product->carouselB ?>">
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <legend>第三筆</legend>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">輪播方式</label>

                                                    <div class="col-sm-1">
                                                        <input type="radio" name="carouselC_option" value="0" <?= ($product->carouselC_option == 0) ? 'checked' : '' ?>><span>圖片</span>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <input type="radio" name="carouselC_option" value="1" <?= ($product->carouselC_option == 1) ? 'checked' : '' ?>><span>影片</span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">圖片</label>

                                                    <div class="col-sm-3">
                                                        <input type="file" class="btn btn-default" id="UploadImg" name="imageD">

                                                        <p class="help-block">
                                                            圖片最佳大小為850*175
                                                        </p>

                                                        <p class="help-block">
                                                            <img id="preview" src="<?= ($product && file_exists($product->carouselC_image)) ? base_url($product->carouselC_image) : '' ?>">
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">影片</label>

                                                    <div class="col-sm-4">
                                                        <input class="form-control" maxlength="255" type="text" name="carouselC" value="<?= $product->carouselC ?>">
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="tab2">
                                        <div id="content">
                                            <fieldset>
                                                <legend>產品特色</legend>
                                                <a class="btn btn-primary" id="add_features" href="javascript:;"><i class="fa fa-plus"></i> <span>新增特色</span></a>
                                                <? $features = json_decode($product->features) ?>
                                                <div id="features">
                                                    <? if ($features) { ?>
                                                        <? for ($i = 0; $i < count($features->title); $i++) { ?>
                                                            <div class="form-group">
                                                                <label class="col-sm-2 control-label">名稱</label>

                                                                <div class="col-sm-4">
                                                                    <input class="form-control" maxlength="150" type="text" name="features[title][]" value="<?=$features->title[$i]?>">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-sm-2 control-label">介紹</label>

                                                                <div class="col-sm-4">
                                                                    <textarea class="form-control" rows="8" name="features[intro][]"><?=$features->intro[$i]?></textarea>
                                                                </div>
                                                            </div>
                                                        <? } ?>
                                                    <? } ?>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="widget-footer">
                                        <button type="submit" class="btn btn-primary" id="submit">確定</button>
                                        <button type="button" class="btn btn-default" onclick="location.href='<?= site_url("bkproducts") ?>';">返回</button>
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

    $(function () {
        $('#add_features').click(function () {
            $("#features").append('<div class="form-group"><label class="col-sm-2 control-label">名稱</label><div class="col-sm-4"><input class="form-control" maxlength="150" type="text" name="features[title][]" required></div></div><div class="form-group"><label class="col-sm-2 control-label">介紹</label><div class="col-sm-4"><textarea class="form-control" rows="8" name="features[intro][]" required></textarea></div></div>');
        });
    });

</script>