<div id="content">
    <section id="widget-grid" class="">
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false"
                     data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false">

                    <header>
                        <span class="widget-icon"> <i class="fa fa-edit"></i> </span>

                        <h2>新增訂單</h2>

                        <ul class="nav nav-tabs pull-right in">
                            <li>
                                <a data-toggle="tab" href="#tab"><span class="hidden-mobile hidden-tablet">新增訂單</span></a>
                            </li>

                            <li>
                                <a data-toggle="tab" href="#tab2"><span class="hidden-mobile hidden-tablet">訂單詳細資料</span></a>
                            </li>
                        </ul>

                    </header>

                    <div>
                        <div class="widget-body no-padding">
                            <form class="form-horizontal" method="post" action="<?=site_url('bkagent/edit_order/'.$order->OID)?>" enctype="multipart/form-data">
                                <div id="myTabContent" class="tab-content">

                                    <div class="tab-pane fade" id="tab">
                                        <div id="content">
                                            <fieldset>
                                                <legend>新增訂單</legend>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">訂單號</label>

                                                    <div class="col-sm-3">
                                                        <input class="form-control" maxlength="30" type="text" name="serial_number" value="<?=$order->serial_number?>" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">日期</label>

                                                    <div class="col-sm-3">
                                                        <input class="form-control datepicker" data-dateformat="yy-mm-dd" type="text" name="order_date" value="<?=$order->order_date?>" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">保固日期</label>

                                                    <div class="col-sm-3">
                                                        <input class="form-control datepicker" data-dateformat="yy-mm-dd" type="text" name="warranty_date" value="<?=$order->warranty_date?>" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">產品序號</label>

                                                    <div class="col-sm-3">
                                                        <input class="form-control" maxlength="150" type="text" name="machine_model" value="<?=$order->machine_model?>" required>
                                                    </div>
                                                </div>

                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="tab2">
                                        <section id="widget-grid" class="">
                                            <div id="content">
                                                <fieldset>
                                                    <legend>訂單詳細資料</legend>
                                                    <div class="jarviswidget jarviswidget-color-darken" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false"
                                                         data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false">

                                                        <header>
                                                            <span class="widget-icon"><i class="fa fa-table"></i></span>
                                                            <h2>訂單詳細資料</h2>
                                                        </header>

                                                        <div>
                                                            <div class="widget-body no-padding">
                                                                <div class="widget-body-toolbar">
                                                                    <div class="row">
                                                                        <div class="col-xs-12 text-right">
                                                                            <a class="btn btn-primary" href="<?=site_url('bkagent/add_order_detail/'.$order->OID)?>">
                                                                                <i class="fa fa-plus"></i> <span>新增訂單詳細資料</span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="table-responsive">
                                                                    <table id="dt_basic" class="table table-bordered table-striped text-center">
                                                                        <thead>
                                                                        <tr>
                                                                            <th width="10%" class="text-center">日期</th>
                                                                            <th width="15%" class="text-center">聯絡人</th>
                                                                            <th width="15%" class="text-center">功能</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <? if ($order_detail) { ?>
                                                                            <? foreach ($order_detail as $row) {?>
                                                                                <tr>
                                                                                    <td> <?=date('Y-m-d',strtotime($row->detail_date))?> </td>
                                                                                    <td> <?=$row->contact_name?> </td>
                                                                                    <td>
                                                                                        <a href="<?= site_url('bkagent/edit_order_detail/' . $row->ODID) ?>" class="btn btn-default" style=""><i class="fa fa-gear"></i><span class="hidden-tablet"> 編輯 </span></a>
                                                                                        <a href="<?= site_url('bkagent/delete_order_detail/' . $row->ODID) ?>" class="btn btn-danger" onclick="return confirm('確定要刪除?');"><i class="glyphicon glyphicon-trash"></i><span class="hidden-tablet"> 刪除 </span></a>
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
                                                </fieldset>
                                            </div>
                                        </section>
                                    </div>
                                    <div class="widget-footer">
                                        <button type="submit" class="btn btn-primary" id="submit">確定</button>
                                        <button type="button" class="btn btn-default" onclick="location.href='<?= site_url("bkagent/edit_agent/".$order->AID.'#1') ?>';">返回</button>
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
    var hash = window.location.hash;
    $('ul.nav-tabs li').eq(hash.substr(1)).addClass('active');
    $('.tab-pane').eq(hash.substr(1)).addClass('active in');
</script>
