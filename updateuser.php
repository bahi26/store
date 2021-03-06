<?php
include_once './include/controller.php';
$data= get_information();
if (isset($_POST['edit']))
{
    update();
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
                        <li><a href="store.html">المتجر <i class="fa fa-shopping-basket" aria-hidden="true"></i></a></li>
                        <li><a href="myaccount.html">حسابي <i class="fa fa-user fa-lg" aria-hidden="true"></i></a></li>
                        <li><a href="support.html">الدعم الفنى <i class="fa fa-question-circle fa-lg" aria-hidden="true"></i></a></li>
                        <li><a href="shopping.html">سلة المشتريات <i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
          </div>
        </nav>
        <!--- End NavBar --->
        <div class="container myaccount">
            <div class="row">
                <div class="col-lg-4">
                    <h2>حسابي</h2>
                    <hr style="float:right;width:75px;border:2px solid #930223;margin-top:0" class="text-center"><br>
                    <ul>
                        <li><a href="#">لوحة التحكم الرئيسية</a></li>
                        <li><a href="#">الطلبات</a></li>
                        <li><a href="#">التنزيلات</a></li>
                        <li><a href="#">العناوين</a></li>
                        <li><a href="#">تفاصيل الحساب</a></li>
                        <li><a href="#">Transactions History</a></li>
                        <li><a href="deposit.html">Make a Deposit</a></li>
                        <li><a href="#">تسجيل الخروج</a></li>
                    </ul>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-8">
                    <form action="updateuser.php" method="post" class="updateUser">
					<div class="col-md-12 box">
						<h2 class="title">معلوماتك الشخصية</h2>
					  	<div class="form-group row">
						    <div class="col-md-6">
						    	<label>اسم المستخدم *</label>
						    	<input type="text" name="username" class="form-control" placeholder="اسم المستخدم" value="<?php echo $data['user_name'] ?>">
						    </div>
						
					  	</div>

					  	


					  	


					  	<div class="form-group row">
						    <div class="col-md-6">
						    	<label>البريد الالكتروني *</label>
                                                        <input type="text" class="form-control" name="email" placeholder="البريد الالكتروني" value="<?php echo $data['email'] ?>">
						    </div>
						    <div class="col-md-6">
							    <label>رقم الهاتف *</label>
						    	<input type="text" class="form-control" name="mobile" placeholder="رقم الهاتف" value="<?php echo $data['phone_number'] ?>">
						    </div>
					  	</div>
<div class="form-group row">
						    <div class="col-md-6">
						    	<label>كلمة المرور *</label>
                                                        <input name="password" type="password" class="form-control" placeholder="*****">
						    </div>
						    <div class="col-md-6">
							    <label>تاكيد كلمة المرور *</label>
                                                            <input type="password" name="password_conformation" class="form-control" placeholder="*****">
						    </div>
					  	</div>
					  	<div class="form-group">
                                                    <input href="#" name="edit" class="btn btn-danger" type="submit" value="تعديل البيانات">
					  	</div>
					</div>
                    </form>
                </div>
            </div><!-- /.row -->
        </div>
        <footer class="footer">
            <div class="container text-center">
                <div class="row">
                    <p>
                        <a href="blog.html">المدونة</a>
                        <a href="sell.html">بائعون</a>
                        <a href="questions.html">الأسئلة الشائعة</a>
                        <a href="#">الكوكيز</a>
                        <a href="#">سياسة الإسترجاع</a>
                        <a href="#">سياسة الخصوصية</a>
                        <a href="#">إتفاق المستعمل</a>
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


