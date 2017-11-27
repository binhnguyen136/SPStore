@extends('admin.master')

@section('title', 'Controll panel | Profile')

@section('profileActive', 'start active open')

@section('profileSelected', '<span class="selected"></span>')

@section('style')
    @parent
    <link href="../assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
@stop

@section('js')
    @parent
    <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
@stop

@section('content')
               <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->

                        <!-- BEGIN PAGE BAR -->
                        <div class="page-bar">
                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="index.html">Trang chủ</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>Tài khoản</span>
                                </li>
                            </ul>
                            <div class="page-toolbar">

                            </div>
                        </div>
                        <!-- END PAGE BAR -->
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> Quản lý tài khoản
                        </h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN PROFILE SIDEBAR -->
                                <div class="profile-sidebar">
                                    <!-- PORTLET MAIN -->
                                    <div class="portlet light profile-sidebar-portlet ">
                                        <!-- SIDEBAR USERPIC -->
                                        <div class="profile-userpic">
                                            <img src="{{ asset('images/profile.jpg') }}" class="img-responsive" alt=""> </div>
                                        <!-- END SIDEBAR USERPIC -->
                                        <!-- SIDEBAR USER TITLE -->
                                        <div class="profile-usertitle">
                                            <div class="profile-usertitle-name"> Admin </div>
                                            <div class="profile-usertitle-job"> Quản trị viên </div>
                                        </div>
                                        <!-- END SIDEBAR USER TITLE -->
                                        <!-- SIDEBAR BUTTONS -->
                                        <!-- END SIDEBAR BUTTONS -->
                                        <!-- SIDEBAR MENU -->
                                        <div class="profile-usermenu">
                                            <ul class="nav">
                                            </ul>
                                        </div>
                                        <!-- END MENU -->
                                    </div>
                                    <!-- END PORTLET MAIN -->
                                    <!-- PORTLET MAIN -->
                                    <div class="portlet light ">
                                        <!-- STAT -->
                                        <div>
                                            <h4 class="profile-desc-title">Admin</h4>
                                            <span class="profile-desc-text"></span>
                                            <div class="margin-top-20 profile-desc-link">
                                                <i class="fa fa-globe"></i>
                                                <a href="#">sgu.edu.vn</a>
                                            </div>
                                            <div class="margin-top-20 profile-desc-link">
                                                <i class="fa fa-twitter"></i>
                                                <a href="#">@shop</a>
                                            </div>
                                            <div class="margin-top-20 profile-desc-link">
                                                <i class="fa fa-facebook"></i>
                                                <a href="#">@shop.sgu</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END PORTLET MAIN -->
                                </div>
                                <!-- END BEGIN PROFILE SIDEBAR -->
                                <!-- BEGIN PROFILE CONTENT -->
                                <div class="profile-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet light ">
                                                <div class="portlet-title tabbable-line">
                                                    <div class="caption caption-md">
                                                        <i class="icon-globe theme-font hide"></i>
                                                        <span class="caption-subject font-blue-madison bold uppercase">Tài khoản</span>
                                                    </div>
                                                    <ul class="nav nav-tabs">
                                                        <li class="active">
                                                            <a href="#tab_1_1" data-toggle="tab">Thông tin cá nhân</a>
                                                        </li>
                                                        <li>
                                                            <a href="#tab_1_2" data-toggle="tab">Đổi ảnh đại diện</a>
                                                        </li>
                                                        <li>
                                                            <a href="#tab_1_3" data-toggle="tab">Đổi mật khẩu</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="tab-content">
                                                        <!-- PERSONAL INFO TAB -->
                                                        <div class="tab-pane active" id="tab_1_1">
                                                            <form role="form" action="">
                                                                <div class="form-group">
                                                                    <label class="control-label">Họ</label>
                                                                    <input type="text" placeholder="" class="form-control" /> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Tên</label>
                                                                    <input type="text" placeholder="" class="form-control" /> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Số điện thoại</label>
                                                                    <input type="text" placeholder="" class="form-control" /> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Sở thích</label>
                                                                    <input type="text" placeholder="" class="form-control" /> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Nghề nghiệp</label>
                                                                    <input type="text" placeholder="" class="form-control" /> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Giới thiệu</label>
                                                                    <textarea class="form-control" rows="3" placeholder=""></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Địa chỉ website</label>
                                                                    <input type="text" placeholder="" class="form-control" /> </div>
                                                                <div class="margiv-top-10">
                                                                    <a href="javascript:;" class="btn green"> Lưu  </a>
                                                                    <a href="javascript:;" class="btn default"> Đóng </a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- END PERSONAL INFO TAB -->
                                                        <!-- CHANGE AVATAR TAB -->
                                                        <div class="tab-pane" id="tab_1_2">
                                                            <form action="" role="form">
                                                                <div class="form-group">
                                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                                                        <div>
                                                                            <span class="btn default btn-file">
                                                                                <span class="fileinput-new"> Chọn ảnh </span>
                                                                                <input type="file" name="..."> </span>
                                                                            <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Xóa </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="margin-top-10">
                                                                    <a href="javascript:;" class="btn green"> Lưu </a>
                                                                    <a href="javascript:;" class="btn default"> Đóng </a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- END CHANGE AVATAR TAB -->
                                                        <!-- CHANGE PASSWORD TAB -->
                                                        <div class="tab-pane" id="tab_1_3">
                                                            <form action="">
                                                                <div class="form-group">
                                                                    <label class="control-label">Mật khẩu hiện tại</label>
                                                                    <input type="password" class="form-control" /> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Mật khẩu mới</label>
                                                                    <input type="password" class="form-control" /> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Nhập lại mật khẩu</label>
                                                                    <input type="password" class="form-control" /> </div>
                                                                <div class="margin-top-10">
                                                                    <a href="javascript:;" class="btn green"> Đổi mật khẩu </a>
                                                                    <a href="javascript:;" class="btn default"> Đóng </a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- END CHANGE PASSWORD TAB -->

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END PROFILE CONTENT -->
                            </div>
                        </div>
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
            <script type="text/javascript">
            $(document).ready(function() {
                $('#summernote_2').summernote({ height: 300});
            });
            </script>
@stop