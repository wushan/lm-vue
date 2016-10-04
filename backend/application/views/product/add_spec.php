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

                    <h2>產品規格</h2>
                </header>


                <div>
                    <div class="widget-body no-padding">
                        <form method="post" action="<?= site_url('bkpd/add_spec/'.$PDID) ?>">
                            <div class="widget-body-toolbar">
                                <div class="row">
                                    <div class="col-xs-6 text-left">
                                        <a class="btn btn-warning" onclick="location.href='<?= site_url("bkpd") ?>';"><i class="fa fa-level-up"></i> <span>返回</span></a>
                                        <button class="btn btn-primary" type="submit"> <span>送出</span></button>
                                    </div>

                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table">
                                    <thead>
                                    <tr>
                                        <th>產品規格</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <? if ($column) {?>
                                        <? foreach ($column as $i=> $row) { ?>
                                            <tr>
                                                <td><?= $row->title ?></td>
                                                <td>
                                                    <input class="form-control" maxlength="150" type="text" name="spec[<?=$i?>][]" value="<?=($spec=json_decode($pd->spec))?$spec[$i][0]:''?>">
                                                </td>
                                            </tr>
                                        <? } ?>
                                    <? } ?>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </article>
    </div>
</section>

