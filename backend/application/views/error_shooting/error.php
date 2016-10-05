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

                    <h2>錯誤處理</h2>
                </header>

                <div>
                    <div class="widget-body no-padding">

                        <div class="widget-body-toolbar">
                            <div class="row">

                                <div class="col-xs-6 text-left">
                                    <?if($counterror<4){?>
                                    <a class="btn btn-primary" onclick="location.href='<?= site_url("bkerror/add_error/".$errorCodeID.'/'.$parentID) ?>';"><i class="fa fa-plus"></i> <span>新增錯誤處理</span></a>
                                    <?}?>
                                    <a class="btn btn-warning" onclick="location.href='<?= site_url("bkerror") ?>';"><i class="fa fa-mail-reply"></i> <span>返回錯誤代碼</span></a>
                                    <?if($parentID!=0){?>
                                    <a class="btn btn-success" onclick="location.href='<?= site_url("bkerror/error_solution/".$errorCodeID.'/'.$prev->parentID) ?>';"><i class="fa fa-level-up"></i> <span>回上一層</span></a>
                                    <?}?>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="table">
                                <thead>
                                <tr>
                                    <th width="15%">錯誤代碼</th>
                                    <th width="30%">圖片預覽</th>
                                    <th width="30%">標題</th>
                                    <th>編輯</th>
                                </tr>
                                </thead>
                                <tbody>
                                <? if ($error) { ?>
                                    <? foreach ($error as $row) { ?>
                                        <tr>
                                            <td><?= $row->errorCode ?></td>
                                            <td>
                                                <? if (isset($row->image)) { ?>
                                                    <div id="preview">
                                                        <img src="<?= base_url($row->image) ?>">
                                                    </div>
                                                <? } ?>
                                            </td>
                                            <td><?= $row->title ?></td>
                                            <td>
                                                <a href="<?= site_url('bkerror/edit_error/' .$errorCodeID.'/'. $row->EID.'/'.$parentID) ?>" class="btn btn-default" style=""><i class="fa fa-gear"></i><span class="hidden-tablet"> 編輯 </span></a>
                                                <a href="<?= site_url('bkerror/error_solution/' . $errorCodeID.'/'.$row->EID.'/'.$row->parentID) ?>" class="btn btn-success" style=""><i class="fa fa-gear"></i><span class="hidden-tablet"> 錯誤處理 </span></a>
                                                <a href="<?= site_url('bkerror/delete_error/' .$errorCodeID.'/'. $row->EID.'/'.$parentID) ?>" class="btn btn-danger" onclick="return confirm('確定要刪除?');"><i class="glyphicon glyphicon-trash"></i><span class="hidden-tablet"> 刪除 </span></a>
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