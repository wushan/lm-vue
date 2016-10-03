<div id="content">
    <section id="widget-grid" class="">
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false"
                     data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false">

                    <header>
                        <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                        <h2>新增訂單詳細資料</h2>
                    </header>

                    <div>
                        <div class="widget-body no-padding">
                            <form class="form-horizontal" method="post" action="<?=site_url('bkagent/edit_order_detail/'.$order_detail->ODID)?>" enctype="multipart/form-data">
                                <div id="content">
                                    <fieldset>
                                        <legend>新增訂單詳細資料</legend>

<!--                                        <div class="form-group">-->
<!--                                            <label class="col-sm-2 control-label" >排序</label>-->
<!---->
<!--                                            <div class="col-sm-1">-->
<!--                                                <input class="form-control" min="1" type="number" name="order" value="--><?//=(!$order->order)?1:$order->order+1?><!--">-->
<!--                                            </div>-->
<!--                                        </div>-->

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">PDF</label>

                                            <div class="col-sm-9">
                                                <input type="file" class="btn btn-default" name="orderFile">

                                                <p class="help-block">
                                                    檔名:<?= ($order_detail->file_name) ? $order_detail->file_name : '無上傳檔案' ?>
                                                </p>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">日期</label>

                                            <div class="col-sm-2">
                                                <input class="form-control"  type="date" name="detail_date" value="<?=date('Y-m-d',strtotime($order_detail->detail_date))?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">聯絡人名稱</label>

                                            <div class="col-sm-2">
                                                <input class="form-control" maxlength="50" type="text" name="contact_name" value="<?=$order_detail->contact_name?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">零件</label>

                                            <div class="col-sm-2">
                                                <input class="form-control" maxlength="150" type="text" name="machine_part" value="<?=$order_detail->machine_part?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">項目</label>

                                            <div class="col-sm-2">
                                                <input class="form-control" maxlength="100" type="text" name="subject" value="<?=$order_detail->subject?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">描述</label>

                                            <div class="col-sm-6">
                                                <textarea class="form-control" rows="15" name="decription" required><?=$order_detail->decription?></textarea>
                                            </div>
                                        </div>

                                    </fieldset>
                                </div>

                                <div class="widget-footer">
                                    <button type="submit" class="btn btn-primary" id="submit">確定</button>
                                    <button type="button" class="btn btn-default" onclick="location.href='<?= site_url("bkagent/edit_order/".$order_detail->OID.'#1') ?>';">返回</button>
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
    $(document).ready(function () {
        $('input#UploadImg').change(function () {
            $this = $(this);
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function (e) {
                $this.siblings('p:last').children('img#preview').attr('src', e.target.result).show();
            }
        });
    });
</script>