<!DOCTYPE html>
<html class="no-js" lang="">

<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Hosoren &middot; Homepage</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,700,400italic,700italic&amp;subset=latin,vietnamese">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('css/plugins.css') }}">

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <script src="js/vendor.js"></script>


</head>

<body>


<div id="wrapper" class="main-wrapper ">
        <div id="login-popup" class="white-popup login-popup ">
            <div role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="index.html#account-login" aria-controls="account-login" role="tab" data-toggle="tab">Account Login</a>
                    </li>

                    <li role="presentation">
                        <a href="index.html#account-register" aria-controls="account-register" role="tab" data-toggle="tab">Register</a>
                    </li>
                </ul>
                <!-- /.nav -->

                <!-- Tab panes -->
                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane active" id="account-register">
                        <form action="index.html" method="POST">
                            <div class="form-group">
                                <label for="register-username">Username <sup>*</sup>
                                </label>
                                <input type="text" class="form-control" id="register-username">
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label for="register-email">Email <sup>*</sup>
                                </label>
                                <input type="text" class="form-control" id="register-email">
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label for="register-password">Password <sup>*</sup>
                                </label>
                                <input type="password" class="form-control" id="register-password">
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label for="register-confirm-password">Confirm Password <sup>*</sup>
                                </label>
                                <input type="password" class="form-control" id="register-confirm-password">
                            </div>
                            <!-- /.form-group -->

                            <div class="form-button">
                                <button type="submit" class="btn btn-lg btn-warning btn-block">Register</button>
                            </div>
                            <!-- /.form-button -->
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
        </div>
    </div>
    <!-- /#wrapper -->  


</body>

</html>
