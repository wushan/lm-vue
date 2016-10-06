
<div id="content">
    <section id="widget-grid" class="">
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false"
                     data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false">

                    <header>
                        <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                        <h2>新增錯誤代碼</h2>
                    </header>

                    <div>
                        <div class="widget-body no-padding">
                            <form class="form-horizontal" method="post" action="<?=site_url('bkerror/add_error_code')?>" enctype="multipart/form-data">
                                <div id="content">
                                    <fieldset>
                                        <legend>新增錯誤代碼</legend>

                                        <a class="btn btn-primary" id="add_product" href="javascript:;"><i class="fa fa-plus"></i> <span>加入</span></a>

                                        <div id="products">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">產品名稱</label>

                                                <div class="col-sm-2">
                                                    <select class="form-control" name="modelID[]"
                                                            required>
                                                        <option value="0">請選擇</option>
                                                        <? if ($pd) { ?>
                                                            <? foreach ($pd as $row) { ?>
                                                                <option
                                                                    value="<?= $row->PDID ?>"><?= $row->model ?></option>
                                                            <? } ?>
                                                        <? } ?>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">錯誤代碼</label>

                                            <div class="col-sm-3">
                                                <input class="form-control" maxlength="100" type="text" name="errorCode" required>
                                            </div>
                                        </div>


                                    </fieldset>
                                </div>

                                <div class="widget-footer">
                                    <button type="submit" class="btn btn-primary" id="submit">確定</button>
                                    <button type="button" class="btn btn-default" onclick="location.href='<?= site_url("bkerror") ?>';">返回</button>
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

    $(function () {
        $('#add_product').click(function () {
            $("#products").append('<div class="form-group"><label class="col-sm-2 control-label">產品名稱</label><div class="col-sm-2"><select class="form-control" name="modelID[]"  required><option value="0">請選擇</option> <? if ($pd) { ?> <? foreach ($pd as $row) { ?>  <option  value="<?= $row->PDID ?>" ><?= $row->model ?></option>   <? } ?>  <? } ?>  </select> </div>  </div>');
        });
    });
</script>