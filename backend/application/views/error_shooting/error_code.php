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

                    <h2>錯誤代碼</h2>
                </header>

                <div>
                    <div class="widget-body no-padding">

                        <div class="widget-body-toolbar">
                            <div class="row">

                                <div class="col-xs-6 text-left">
                                    <a class="btn btn-primary" onclick="location.href='<?= site_url("bkerror/add_error_code") ?>';"><i class="fa fa-plus"></i> <span>新增錯誤代碼</span></a>
                                </div>

                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="table">
                                <thead>
                                <tr>
                                    <th>錯誤代碼</th>
                                    <th>編輯</th>
                                </tr>
                                </thead>
                                <tbody>
                                <? if ($error_code) { ?>
                                    <? foreach ($error_code as $row) { ?>
                                        <tr>
                                            <td><?= $row->errorCode ?></td>
                                            <td>
                                                <a href="<?= site_url('bkerror/edit_error_code/' . $row->ECID) ?>" class="btn btn-default" style=""><i class="fa fa-gear"></i><span class="hidden-tablet"> 編輯 </span></a>
                                                <a href="<?= site_url('bkerror/error_solution/' . $row->ECID) ?>" class="btn btn-success" style=""><i class="fa fa-gear"></i><span class="hidden-tablet"> 錯誤處理 </span></a>
                                                <a href="<?= site_url('bkerror/delete_error_code/' . $row->ECID) ?>" class="btn btn-danger" onclick="return confirm('確定要刪除?');"><i class="glyphicon glyphicon-trash"></i><span class="hidden-tablet"> 刪除 </span></a>
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
        $('#table').dataTable({
            "pageLength": 10,
            "ordering": false
        });
    });
</script>