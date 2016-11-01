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

                    <h2>產品分類</h2>
                </header>

                <div>
                    <form method="post" action="<?= site_url('bkproducts') ?>">
                        <div class="widget-body no-padding">

                            <div class="widget-body-toolbar">
                                <div class="row">
                                    <div class="col-xs-6 text-left">
                                        <button class="btn btn-success"><span>修改排序</span></button>
                                        <a class="btn btn-primary" onclick="location.href='<?= site_url("bkproducts/add_products") ?>';"><i class="fa fa-plus"></i> <span>新增分類</span></a>
                                    </div>

                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="table">
                                    <thead>
                                    <tr>
                                        <th width="3%">顯示首頁</th>
                                        <th width="5%">顯示產品首頁</th>
                                        <th width="4%">排序</th>
                                        <th width="6%">產品系列</th>
                                        <th width="10%">圖片預覽</th>
                                        <th width="10%">分類名稱</th>
                                        <th width="12%">編輯</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <? if ($product) { ?>
                                        <? foreach ($product as $row) { ?>
                                            <tr>
                                                <td><?= ($row->is_home == 1) ? '<i class="fa txt-color-green fa-check"></i>' : '<i class="fa txt-color-red fa-times"></i>' ?></td>
                                                <td><?= ($row->is_product_page == 1) ? '<i class="fa txt-color-green fa-check"></i>' : '<i class="fa txt-color-red fa-times"></i>' ?></td>
                                                <td><input class="form-control text-center" style="width: 100%;" min="1" type="number" name="order[<?= $row->PID ?>]" value="<?= $row->order ?>"></td>
                                                <td><?= $row->list_name ?></td>
                                                <td>
                                                    <? if (isset($row->pdimage)) { ?>
                                                        <div id="preview">
                                                            <img src="<?= base_url($row->pdimage) ?>">
                                                        </div>
                                                    <? } ?>
                                                </td>
                                                <td><?= $row->name ?></td>
                                                <td>
                                                    <a href="<?= site_url('bkproducts/edit_products/' . $row->PID) ?>" class="btn btn-default" style=""><i class="fa fa-gear"></i><span class="hidden-tablet"> 編輯 </span></a>
                                                    <a href="<?= site_url('bkproducts/spec_column/' . $row->PID) ?>" class="btn btn-success" style=""><i class="fa fa-gear"></i><span class="hidden-tablet"> 新增規格欄位 </span></a>
                                                    <!--                                                <a href="-->
                                                    <? //= site_url('bkproducts/add_spec/' . $row->PID) ?><!--" class="btn btn-success" style=""><i class="fa fa-gear"></i><span class="hidden-tablet"> 產品規格 </span></a>-->
                                                    <a href="<?= site_url('bkproducts/delete_products/' . $row->PID) ?>" class="btn btn-danger" onclick="return confirm('確定要刪除?');"><i class="glyphicon glyphicon-trash"></i><span class="hidden-tablet"> 刪除 </span></a>
                                                </td>
                                            </tr>
                                        <? } ?>
                                    <? } ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </form>
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