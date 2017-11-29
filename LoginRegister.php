<?php
include_once './include/controller.php';
if(isset($_POST['add_user']))
{
    addUser();
   
}
if(isset($_POST['login']))
{
    login();
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>متجرنا الإلكترونى | للبيع والشراء</title>
        <link href="images/swlogo.ico" rel="icon">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-rtl.css" rel="stylesheet">
        <link href="css/bootstrap-rtl.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
        <script src="js/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!--- Start NavBar--->
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#axit-nav" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="index.html"><img src="images/logo.png" width="50%" alt=""></a>
                </div>
                <div class="collapse navbar-collapse" id="axit-nav">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.html">الرئيسية <i class="fa fa-home fa-lg" aria-hidden="true"></i></a></li>
                        <li><a href="#">المتجر <i class="fa fa-shopping-basket" aria-hidden="true"></i></a></li>
                        <li><a href="myaccount.html">حسابي <i class="fa fa-user fa-lg" aria-hidden="true"></i></a></li>
                        <li><a href="#">الدعم الفنى <i class="fa fa-question-circle fa-lg" aria-hidden="true"></i></a></li>
                        <li><a href="shopping.html">سلة المشتريات <i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
          </div>
        </nav>
        <!--- End NavBar --->
        <section class='section' id='login-register-page'>
            <div class="container">
                <h1 class="text-center">إنشاء حساب جديد او تسجيل الدخول</h1>
                <hr style="width:75px;border:2px solid #930223;margin-top:0" class="text-center">
                <div class="row">
                    <form class="login-form" method="post" action="LoginRegister.php">
                        <div class="col-sm-6">
                            <div class="title-line">
                                <h3>تسجيل الدخول</h3>
                                <p>مرحبا، اهلا بك في حسابك</p>
                            </div>
                            <div class="form-group">
                                <label>البريد الالكتروني *</label>
                                <input name="email" type="email" class="form-control" placeholder="البريد الالكتروني *" required>
                            </div>
  
                            <div class="form-group">
                                <label>كلمة المرور *</label>
                                <input type="password" name="password" class="form-control" placeholder="كلمة المرور *" required>
                            </div>

                            <div class="form-group">
                                
                                <a href="#!" class="pull-left" style="color:#930223">نسيت كلمة المرور؟</a>
                            </div>

                            <div class="form-group">
                                <button name="login" class="btn btn-danger">تسجيل الدخول</button>
                            </div>
                        </div>
                    </form>
                    <div></div>
                    <form class="register-form" method="post" action="LoginRegister.php">
                        <div class="col-sm-6">
                            <div class="title-line">
                                <h3>انشاء حساب جديد</h3>
                                <p>انشئ الحساب الخاص بك في ثواني</p>
                            </div>

                            <div class="form-group">
                                <label>اسم المستخدم *</label>
                                <input type="text" name="username" class="form-control" placeholder="اسم المستخدم *" required>
                            </div>

                            <div class="form-group">
                                <label>البريد الالكتروني *</label>
                                <input type="email" name="email" class="form-control" placeholder="البريد الالكتروني *" required>
                            </div>
<div class="form-group">
                                <label>رقم الهاتف *</label>
                                <input name="mobile" type="text" class="form-control" placeholder="رقم الهاتف *" required>
                            </div>
                            <div class="form-group">
                                <label>كلمة المرور *</label>
                                <input type="password" name="password" class="form-control" placeholder="كلمة المرور *" required>
                            </div>

                        

                            <div class="form-group">
                                <button name="add_user" class="btn btn-danger">تسجيل</button>
                            </div>
                        </div>
                    </form>				
                </div><!-- /.row -->
            </div>
        </section>
        <footer class="footer">
            <div class="container text-center">
                <div class="row">
                    <p>
                        <a>المدونة</a>
                        <a>بائعون</a>
                        <a>الأسئلة الشائعة</a>
                        <a>الكوكيز</a>
                        <a>سياسة الإسترجاع</a>
                        <a>سياسة الخصوصية</a>
                        <a>إتفاق المستعمل</a>
                    </p>
                </div>
                <div class="TextUnder">
                    <hr>
                    <p>Copyright &copy; 2017 <a href="#"><strong>gygy.com</strong></a>. All Rights Reserved.</p>
                    <p>Powered By <a href="#"><strong>BY</strong></a></p>
                </div>
            </div>
        </footer>
        <script src="js/jquery-1.12.4.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.nicescroll.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>

