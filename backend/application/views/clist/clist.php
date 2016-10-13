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
                    <h2>聯絡表單</h2>
                </header>

                <div>
                    <div class="widget-body no-padding">

                            <div class="table-responsive">
                                <table class="table table-bordered" id="banner">
                                    <thead>
                                    <tr>
                                        <th>標題</th>
                                        <th>聯絡人</th>
                                        <th>Email</th>
                                        <th>電話</th>
                                        <th>功能</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <? if ($clist) { ?>
                                        <? foreach ($clist as $row) { ?>
                                            <tr>
                                                <td><?= $row->subject ?></td>
                                                <td><?= $row->name ?></td>
                                                <td><?= $row->email ?></td>
                                                <td><?= $row->phone ?></td>
                                                <td>
                                                    <a href="<?= site_url('bkclist/view_contact_list/' . $row->CLID) ?>" class="btn btn-default" style=""><i class="fa fa-gear"></i><span class="hidden-tablet"> 編輯 </span></a>
                                                    <a href="<?= site_url('bkclist/delete_contact_list/' . $row->CLID) ?>" class="btn btn-danger" onclick="return confirm('確定要刪除?');"><i class="glyphicon glyphicon-trash"></i><span class="hidden-tablet"> 刪除 </span></a>
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
        $('#banner').dataTable({
            "pageLength": 10,
            "ordering": false
        });
    });
</script>