

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
                        <a href="{{ url('/login') }}" aria-controls="account-login" role="tab" data-toggle="tab">Account Login</a>
                    </li>

                    <li role="presentation">
                        <a href="{{ url('/register') }}" aria-controls="account-register" role="tab" data-toggle="tab">Register</a>
                    </li>
                </ul>
                <!-- /.nav -->

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="account-login">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif                            
                            <div class="form-group">
                                <label for="login-account">Account</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="login-password">Password</label>
                                <div class="hide-show-password-wrapper" style="position: relative; display: block; vertical-align: baseline; margin: 0px;">
                                    <input type="password" class="form-control hideShowPassword-field" id="password" data-show-password="true" style="margin: 0px; padding-right: 24px;" name="password">

                                    <button type="button" role="button" aria-label="Show Password" tabindex="0" class="hide-show-password-toggle hideShowPassword-toggle-show" aria-pressed="false" style="position: absolute; right: 0px; top: 50%;" onclick="setTypeText()"><i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.form-group -->

                            <div class="forgot-passwd hidden">
                                <a href="index.html#" title="">
                                    <i class="icon icon-key"></i>
                                    <span>Forgot your password?</span>
                                </a>
                            </div>
                            <!-- /.forgot-passwd -->

                            <div class="form-button">
                                <button type="submit" class="btn btn-lg btn-primary btn-block">Login</button>
                            </div>
                            <!-- /.form-group -->
                        </form>
                    </div>
                    <!-- /.tab-pane -->

                </div>
                <!-- /.tab-content -->
            </div>
        </div>
    </div>
    <!-- /#wrapper -->  

<script type="text/javascript">

    $('document').ready(function(){
        $('#email').focus();    
    });

    var setTypeText = () =>{
        if( $('#password').attr('type') == 'password')
            $('#password').attr('type', 'text');
        else
            $('#password').attr('type', 'password');
    }
</script>
</body>

</html>

