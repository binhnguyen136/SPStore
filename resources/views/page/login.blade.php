@extends('page.master')
@section('content')
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
            <div role="tabpanel" class="tab-pane active" id="account-login">
                <form action="index.html" method="POST">
                    <div class="form-group">
                        <label for="login-account">Account</label>
                        <input type="text" class="form-control" id="login-account">
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label for="login-password">Password</label>
                        <input type="password" class="form-control" id="login-password" data-show-password="true">
                    </div>
                    <!-- /.form-group -->

                    <div class="forgot-passwd">
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

            <div role="tabpanel" class="tab-pane" id="account-register">
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
<!-- /.login-popup -->

<script>
    $(function() {
        $('a[href="#login-popup"]').magnificPopup({
            type:'inline',
            midClick: false,
            closeOnBgClick: false
        });
    });
</script>
@stop