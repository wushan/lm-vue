<div id="content">
    <section id="widget-grid" class="">
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false"
                     data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false">

                    <header>
                        <span class="widget-icon"> <i class="fa fa-edit"></i> </span>

                        <h2>新增產品規格表</h2>
                    </header>

                    <div>
                        <div class="widget-body no-padding">
                            <form class="form-horizontal" method="post" action="<?= site_url('bkspec/add_spec_form/' . $PID) ?>" enctype="multipart/form-data">
                                <div id="content">
                                    <fieldset>
                                        <legend>新增產品規格表</legend>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">產品系列</label>

                                            <div class="col-sm-1">
                                                <input class="form-control" type="text" value="<?= $product->name ?>" disabled>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">表格排序</label>

                                            <div class="col-sm-1">
                                                <input class="form-control" min="1" type="number" name="order" value="<?= (!$order->order) ? 1 : $order->order + 1 ?>">
                                            </div>
                                        </div>

                                        <legend>加入產品</legend>
                                        <a class="btn btn-primary" id="add_product" href="javascript:;"><i class="fa fa-plus"></i> <span>加入</span></a>

                                        <div id="products">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">產品名稱</label>

                                                <div class="col-sm-2">
                                                    <select class="form-control pd" id="pd" onchange="get_data()" name="PDID[]">
                                                        required>
                                                        <option value="0">請選擇</option>
                                                        <? if ($pd) { ?>
                                                            <? foreach ($pd as $row) { ?>
                                                                <option value="<?= $row->PDID ?>"><?= $row->model ?></option>
                                                            <? } ?>
                                                        <? } ?>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>

                                        <legend>規格表預覽</legend>

                                        <section id="spec_form" class="hidden">
                                            <div id="content">
                                                <fieldset>

                                                    <div class="jarviswidget jarviswidget-color-darken" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false"
                                                         data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false">
                                                        <div>
                                                            <div class="widget-body no-padding">

                                                                <div class="table-responsive">
                                                                    <table id="dt_basic" class="table table-bordered table-striped text-center">

                                                                        <tbody>
                                                                        <? if ($column) { ?>
                                                                            <tr id="add_th">
                                                                                <td></td>
                                                                            </tr>
                                                                            <? foreach ($column as $i => $row) { ?>
                                                                                <tr id="add_td<?= $i ?>">
                                                                                    <td><?= $row->title ?></td>
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

                                    </fieldset>

                                </div>

                                <div class="widget-footer">
                                    <button type="submit" class="btn btn-primary" id="submit">確定</button>
                                    <button type="button" class="btn btn-default" onclick="location.href='<?= site_url("bkspec/spec_form/" . $PID) ?>';">返回</button>
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

    function get_data() {
        var i;
        $('.addth').remove();
        $('.addtd').remove();
        $('#spec_form').attr('class','');
        var PDID = $('.pd').map(function () {
            return $(this).val()
        }).toArray();

        $.ajax({
            url: '<?= site_url('bkspec/get_spec_form_th') ?>',
            type: 'post',
            data: {PDID: jQuery.unique(PDID)},
            dataType: 'html',
            success: function (html) {
                $("#add_th").append(html);
            }
        });

        $.ajax({
            url: '<?= site_url('bkspec/get_spec_form_td') ?>',
            type: 'post',
            data: {PDID: jQuery.unique(PDID),column:'<?=json_encode($column)?>'},
            dataType: 'json',
            success: function (html) {
                if (html) {
                    for (i = 0; i < html.length; i++) {
                        $('#add_td' + i%<?=count($column)?>).append('<td class="addtd">'+html[i]+'</td>');
                    }
                }
            }
        });
    }

    $(function () {
        $('#add_product').click(function () {
            $("#products").append('<div class="form-group"><label class="col-sm-2 control-label">產品名稱</label><div class="col-sm-2"><select onchange="get_data()"  class="form-control pd" name="PDID[]"  required><option value="0">請選擇</option> <? if ($pd) { ?> <? foreach ($pd as $row) { ?>  <option  value="<?= $row->PDID ?>" ><?= $row->model ?></option>   <? } ?>  <? } ?>  </select> </div>  </div>');
        });
    });
</script>