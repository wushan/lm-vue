<!DOCTYPE html>
<html lang="en-us" id="extr-page">
<head>
    <meta charset="utf-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
    <title> LYMCO - 後台管理系統 </title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="<?=base_url("assets/backend/css/bootstrap.min.css")?>">
    <link rel="stylesheet" href="<?=base_url("assets/backend/css/font-awesome.min.css")?>">
    <link rel="stylesheet" href="<?=base_url("assets/backend/css/smartadmin-production.min.css")?>">
    <link rel="stylesheet" href="<?=base_url("assets/backend/css/smartadmin-skins.min.css")?>">
    <link rel="shortcut icon" href="<?=base_url("assets/backend/img/favicon/favicon.ico")?>" type="image/x-icon">
    <link rel="icon" href="<?=base_url("assets/backend/img/favicon/favicon.ico")?>" type="image/x-icon">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
</head>
<body class="animated fadeInDown">
<header id="header">
    <div id="logo-group">
        <span id="logo" style="margin: 5px;"><img src="<?=check_file_path("assets/images/logo_back.png")?>" alt="LYMCO"></span>
    </div>
</header>
<div id="main" role="main">
    <!-- MAIN CONTENT -->
    <div id="content" class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
                <div class="hero">
                    <div class="pull-left login-desc-box-l">
                        <h1 class="txt-color-red login-header-big">LYMCO</h1>
                        <h4 class="paragraph-header">
                            LYMCO
                        </h4>
                    </div>
                    <img src="<?=check_file_path("assets/backend/img/about-single.png")?>" class="pull-right hidden-md" alt="" style="max-width: 375px; max-height: 293px;">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
                <div class="well no-padding">
                    <?php echo form_open("panel/logindo", array("class" => "smart-form client-form", "id" => "login-form")) ?>
                    <header>
                        登入
                    </header>
                    <fieldset>
                        <section>
                            <label class="label">帳號</label>
                            <label class="input"> <i class="icon-append fa fa-user"></i>
                                <input type="text" name="username" value="" autofocus="autofocus">
                                <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> 帳號</b></label>
                        </section>
                        <section>
                            <label class="label">密碼</label>
                            <label class="input"> <i class="icon-append fa fa-lock"></i>
                                <input type="password" name="password">
                                <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> 密碼</b> </label>
                        </section>
                    </fieldset>
                    <footer>
                        <button type="submit" name="btnSubmit" class="btn btn-primary">
                            登入
                        </button>
                    </footer>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?=base_url("assets/backend/js/plugin/pace/pace.min.js")?>"></script>
<script type="text/javascript" src="<?=base_url("assets/backend/js/libs/jquery-2.1.1.min.js")?>"></script>
<script type="text/javascript" src="<?=base_url("assets/backend/js/libs/jquery-ui-1.10.3.min.js")?>"></script>
<script type="text/javascript" src="<?=base_url("assets/backend/js/bootstrap/bootstrap.min.js")?>"></script>
<script type="text/javascript" src="<?=base_url("assets/backend/js/plugin/jquery-validate/jquery.validate.min.js")?>"></script>
<script type="text/javascript" src="<?=base_url("assets/backend/js/plugin/masked-input/jquery.maskedinput.min.js")?>"></script>
<script type="text/javascript" src="<?=base_url("assets/backend/js/app.config.js")?>"></script>
<!--[if IE 8]>
<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
<![endif]-->
<script type="text/javascript" src="<?=base_url("assets/backend/js/app.min.js")?>"></script>
<script type="text/javascript" src="<?=base_url("assets/backend/js/speech/voicecommand.min.js")?>"></script>

<script type="text/javascript">
    runAllForms();
    $(function () {
        // Validation
        $("#login-form").validate({
            // Rules for form validation
            rules: {
                username: {
                    required: true
                },
                password: {
                    required: true,
                    minlength: 3,
                    maxlength: 20
                }
            },
            // Messages for form validation
            messages: {
                username: {
                    required: '請輸入帳號'
                },
                password: {
                    required: '請輸入密碼'
                }
            },
            // Do not change code below
            errorPlacement: function (error, element) {
                error.insertAfter(element.parent());
            }
        });
    });
</script>
</body>
</html>
