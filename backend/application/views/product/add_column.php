
<div id="content">
    <section id="widget-grid" class="">
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false"
                     data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false">

                    <header>
                        <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                        <h2>新增欄位</h2>
                    </header>

                    <div>
                        <div class="widget-body no-padding">
                            <form class="form-horizontal" method="post" action="<?=site_url('bkproductlist/add_column/'.$PLID)?>" enctype="multipart/form-data">
                                <div id="content">
                                    <fieldset>
                                        <legend>新增欄位</legend>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" >排序</label>

                                            <div class="col-sm-1">
                                                <input class="form-control" min="1" type="number" name="order" value="<?=(!$order->order)?1:$order->order+1?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">名稱</label>

                                            <div class="col-sm-3">
                                                <input class="form-control" maxlength="150" type="text" name="title" required>
                                            </div>
                                        </div>


                                    </fieldset>
                                </div>

                                <div class="widget-footer">
                                    <button type="submit" class="btn btn-primary" id="submit">確定</button>
                                    <button type="button" class="btn btn-default" onclick="location.href='<?= site_url("bkproductlist/spec_column/".$PLID) ?>';">返回</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>
</div>