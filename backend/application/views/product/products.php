<style>
    table, th {

        text-align: center;
    }

    #preview {
        width: 100%;
        height: 30px;
        overflow: hidden;
        position: relative;
    }

    #preview img {
        width: 100%;
        padding: 3px;
        margin: -50% 0;
        background-color: white;
    }
</style>

<section id="widget-grid" class="">
    <div class="row">
        <article class="col-xs-12">

            <div class="jarviswidget jarviswidget-color-darken" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false"
                 data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false">

                <header>
                    <span class="widget-icon"><i class="fa fa-table"></i></span>

                    <h2>產品列表</h2>
                </header>

                <div>
                    <div class="widget-body no-padding">

                        <div class="widget-body-toolbar">
                            <div class="row">
                                <div class="col-xs-6 text-left">
                                    <a class="btn btn-primary" onclick="location.href='<?= site_url("bkproduct/add_product_list") ?>';"><i class="fa fa-plus"></i> <span>新增產品</span></a>
                                </div>

                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="table">
                                <thead>
                                <tr>
                                    <th>排序</th>
                                    <th width="50%">圖片預覽</th>
                                    <th width="30%">名稱</th>
                                    <th>編輯</th>
                                </tr>
                                </thead>
                                <tbody>
                                <? if ($plist) { ?>
                                    <? foreach ($plist as $row) { ?>
                                        <tr>
                                            <td><?= $row->order ?></td>
                                            <td>
                                                <? if (isset($row->image)) { ?>
                                                    <div id="preview">
                                                        <img src="<?= base_url($row->image) ?>">
                                                    </div>
                                                <? } ?>
                                            </td>
                                            <td><?= $row->name ?></td>
                                            <td>
                                                <a href="<?= site_url('bkproduct/edit_product_list/' . $row->PLID) ?>" class="btn btn-default" style=""><i class="fa fa-gear"></i><span class="hidden-tablet"> 編輯 </span></a>
                                                <a href="<?= site_url('bkproduct/delete_product_list/' . $row->PLID) ?>" class="btn btn-danger" onclick="return confirm('確定要刪除?');"><i class="glyphicon glyphicon-trash"></i><span class="hidden-tablet"> 刪除 </span></a>
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
        </article>
    </div>
</section>

<script src="<?= base_url("assets/backend/js/plugin/datatables/jquery.dataTables.min.js") ?>"></script>
<script src="<?= base_url("assets/backend/js/plugin/datatables/dataTables.tableTools.min.js") ?>"></script>
<script src="<?= base_url("assets/backend/js/plugin/datatables/dataTables.bootstrap.min.js") ?>"></script>
<script src="<?= base_url("assets/backend/js/plugin/datatable-responsive/datatables.responsive.min.js") ?>"></script>

<script>
    $(document).ready(function () {
        $("div#preview").hover(
            function () {
                $(this).css("overflow", "visible").css("z-index", 99);
            },
            function () {
                $(this).css("overflow", "hidden").css("z-index", 1);
            }
        );
    });

    $(document).ready(function () {
        $('#table').dataTable({
            "pageLength": 10,
            "ordering": false
        });
    });
</script>