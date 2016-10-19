<style>
    table, th {

        text-align: center;
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
                    <form method="post" action="<?= site_url('bkpd') ?>">
                        <div class="widget-body no-padding">

                            <div class="widget-body-toolbar">
                                <div class="row">
                                    <div class="col-xs-6 text-left">
                                        <button class="btn btn-success"><span>修改排序</span></button>
                                        <a class="btn btn-primary" onclick="location.href='<?= site_url("bkpd/add_pd") ?>';"><i class="fa fa-plus"></i> <span>新增</span></a>
                                    </div>

                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="table">
                                    <thead>
                                    <tr>
                                        <th width="8%">排序</th>
                                        <th>分類</th>
                                        <th>名稱</th>
                                        <th>編輯</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <? if ($pd) { ?>
                                        <? foreach ($pd as $row) { ?>
                                            <tr>
                                                <td><input class="form-control text-center" style="width: 100%;" min="1" type="number" name="order[<?= $row->PDID ?>]" value="<?= $row->order ?>"></td>
                                                <td><?= $row->cate_name ?></td>
                                                <td><?= $row->model ?></td>
                                                <td>
                                                    <a href="<?= site_url('bkpd/edit_pd/' . $row->PDID) ?>" class="btn btn-default" style=""><i class="fa fa-gear"></i><span class="hidden-tablet"> 編輯 </span></a>
                                                    <a href="<?= site_url('bkpd/add_spec/' . $row->PDID) ?>" class="btn btn-success" style=""><i class="fa fa-gear"></i><span class="hidden-tablet"> 產品規格 </span></a>
                                                    <a href="<?= site_url('bkpd/delete_pd/' . $row->PDID) ?>" class="btn btn-danger" onclick="return confirm('確定要刪除?');"><i class="glyphicon glyphicon-trash"></i><span class="hidden-tablet"> 刪除 </span></a>
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
        $('#table').dataTable({
            "pageLength": 10,
            "ordering": false
        });
    });
</script>