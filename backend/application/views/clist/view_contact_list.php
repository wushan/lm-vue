<section id="widget-grid" class="">
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false"
                 data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>

                    <h2>瀏覽</h2>
                </header>

                <div>
                    <div class="widget-body no-padding">
                        <form class="form-horizontal" method="post" enctype="multipart/form-data" action="">
                            <div id="content">
                                <fieldset>
                                    <legend>瀏覽</legend>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">是否同意接收訊息通知</label>

                                        <div class="col-lg-5">
                                            <label class="radio radio-inline">
                                                <input type="radio" class="radiobox" name="is_enable" value="1" <?=($clist->is_allow==1)?'checked':''?> disabled>
                                                <span>同意</span>
                                            </label>
                                            <label class="radio radio-inline">
                                                <input type="radio" class="radiobox" name="is_enable" value="0" <?=($clist->is_allow==0)?'checked':''?> disabled>
                                                <span>不同意</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">聯絡人</label>

                                        <div class="col-sm-4">
                                            <input class="form-control" maxlength="150" type="text"
                                                   name="company" value="<?= $clist->name ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Email</label>

                                        <div class="col-sm-4">
                                            <input class="form-control" maxlength="150" type="text"
                                                   name="company" value="<?= $clist->email ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">電話</label>

                                        <div class="col-sm-4">
                                            <input class="form-control" maxlength="150" type="text"
                                                   name="company" value="<?= $clist->phone ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">公司名稱</label>

                                        <div class="col-sm-4">
                                            <input class="form-control" maxlength="150" type="text"
                                                   name="company" value="<?= $clist->company ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">國家</label>

                                        <div class="col-sm-4">
                                            <input class="form-control" maxlength="150" type="text"
                                                   name="company" value="<?= $clist->country ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">標題</label>

                                        <div class="col-sm-4">
                                            <input class="form-control" maxlength="150" type="text"
                                                   name="company" value="<?= $clist->subject ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">訊息</label>

                                        <div class="col-sm-4">
                                            <textarea class="form-control" rows="8"  name="company" disabled ><?= $clist->message ?></textarea>
                                        </div>
                                    </div>


                                </fieldset>
                            </div>

                            <div class="widget-footer">
                                <button type="button" class="btn btn-default" onclick="location.href='<?= site_url("bkclist") ?>';">返回</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>