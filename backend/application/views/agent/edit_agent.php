<div id="content">
    <section id="widget-grid" class="">
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget" data-widget-colorbutton="false" data-widget-editbutton="false"
                     data-widget-togglebutton="false"
                     data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                     data-widget-custombutton="false" data-widget-sortable="false">

                    <header>
                        <span class="widget-icon"> <i class="fa fa-edit"></i> </span>

                        <h2>新增經銷商</h2>

                        <ul class="nav nav-tabs pull-right in">
                            <li>
                                <a data-toggle="tab" href="#tab"><span class="hidden-mobile hidden-tablet">經銷商資料</span></a>
                            </li>

                            <li>
                                <a data-toggle="tab" href="#tab2"><span class="hidden-mobile hidden-tablet">訂單列表</span></a>
                            </li>
                        </ul>

                    </header>

                    <div>
                        <div class="widget-body no-padding">
                            <form class="form-horizontal" method="post"
                                  action="<?= site_url('bkagent/edit_agent/' . $agent->AID) ?>"
                                  enctype="multipart/form-data">
                                <div id="myTabContent" class="tab-content">

                                    <div class="tab-pane fade" id="tab">
                                        <div id="content">
                                            <fieldset>
                                                <legend>經銷商資料</legend>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">帳號</label>

                                                    <div class="col-sm-2">
                                                        <input class="form-control" maxlength="50" type="text"
                                                               name="account" value="<?= $agent->account ?>" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">密碼</label>

                                                    <div class="col-sm-2">
                                                        <input class="form-control" maxlength="20" type="text"
                                                               name="password" value="<?= $agent->password ?>" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">公司名稱</label>

                                                    <div class="col-sm-4">
                                                        <input class="form-control" maxlength="150" type="text"
                                                               name="company" value="<?= $agent->company ?>" required>
                                                    </div>
                                                </div>

                                            </fieldset>

                                            <fieldset>
                                                <a class="btn btn-primary" id="add_machine" href="javascript:;"><i class="fa fa-plus"></i> <span>新增</span></a>
                                                <legend>已購買機台</legend>

                                                <div id="machines">
                                                    <? if ($buy = json_decode($agent->buy)) { ?>
                                                        <? foreach ($buy as $brow) { ?>
                                                            <? if ($brow != 0) { ?>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">機台名稱</label>

                                                                    <div class="col-sm-2">
                                                                        <select class="form-control" name="buy[]"
                                                                                required>
                                                                            <option value="0">請選擇</option>
                                                                            <? if ($product) { ?>
                                                                                <? foreach ($product as $row) { ?>
                                                                                    <option
                                                                                        value="<?= $row->PID ?>" <?= ($buy) ? ($row->PID == $brow) ? 'selected' : '' : '' ?>><?= $row->name ?></option>
                                                                                <? } ?>
                                                                            <? } ?>
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                            <? } ?>
                                                        <? } ?>
                                                    <? } ?>
                                                </div>
                                            </fieldset>

                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="tab2">
                                        <section id="widget-grid" class="">
                                            <div id="content">
                                                <fieldset>
                                                    <legend>訂單列表</legend>
                                                    <div class="jarviswidget jarviswidget-color-darken"
                                                         data-widget-colorbutton="false" data-widget-editbutton="false"
                                                         data-widget-togglebutton="false"
                                                         data-widget-deletebutton="false"
                                                         data-widget-fullscreenbutton="false"
                                                         data-widget-custombutton="false" data-widget-sortable="false">

                                                        <header>
                                                            <span class="widget-icon"><i class="fa fa-table"></i></span>

                                                            <h2>訂單列表</h2>
                                                        </header>

                                                        <div>
                                                            <div class="widget-body no-padding">
                                                                <div class="widget-body-toolbar">
                                                                    <div class="row">
                                                                        <div class="col-xs-12 text-right">
                                                                            <a class="btn btn-primary"
                                                                               href="<?= site_url('bkagent/add_order/' . $agent->AID) ?>">
                                                                                <i class="fa fa-plus"></i>
                                                                                <span>新增訂單</span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="table-responsive">
                                                                    <table id="dt_basic"
                                                                           class="table table-bordered table-striped text-center">
                                                                        <thead>
                                                                        <tr>
                                                                            <th width="10%" class="text-center">日期</th>
                                                                            <th width="15%" class="text-center">訂單號</th>
                                                                            <th width="15%" class="text-center">產品型號
                                                                            </th>
                                                                            <th width="15%" class="text-center">功能</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <? if ($order) { ?>
                                                                            <? foreach ($order as $row) { ?>
                                                                                <tr>
                                                                                    <td> <?= date('Y-m-d', strtotime($row->order_date)) ?> </td>
                                                                                    <td> <?= $row->serial_number ?> </td>
                                                                                    <td> <?= $row->machine_model ?> </td>
                                                                                    <td>
                                                                                        <a href="<?= site_url('bkagent/edit_order/' . $row->OID) ?>"
                                                                                           class="btn btn-default"
                                                                                           style=""><i
                                                                                                class="fa fa-gear"></i><span
                                                                                                class="hidden-tablet"> 編輯 </span></a>
                                                                                        <a href="<?= site_url('bkagent/delete_order/' . $row->OID) ?>"
                                                                                           class="btn btn-danger"
                                                                                           onclick="return confirm('確定要刪除?');"><i
                                                                                                class="glyphicon glyphicon-trash"></i><span
                                                                                                class="hidden-tablet"> 刪除 </span></a>
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
                                        <button type="button" class="btn btn-default"
                                                onclick="location.href='<?= site_url("bkagent") ?>';">返回
                                        </button>
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

    $(function () {
        $('#add_machine').click(function () {
            $("#machines").append(' <div class="form-group"><label class="col-sm-2 control-label">機台名稱</label><div class="col-sm-2"><select class="form-control" name="buy[]" required><option value="0">請選擇</option><? if ($product) { ?><? foreach ($product as $row) { ?><option value="<?=$row->PID?>"><?=$row->name?><? } ?><? } ?></select></div></div>');
        });
    });
</script>