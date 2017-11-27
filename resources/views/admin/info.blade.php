@extends('admin.master')

@section('title', 'Controll panel | Infomation')

@section('infoActive', 'start active open')

@section('infoSelected', '<span class="selected"></span>')

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
                                    <a href="index.html">Home</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>Thông tin chung</span>
                                </li>
                            </ul>
                            <div class="page-toolbar">
                            </div>
                        </div>
                        <!-- END PAGE BAR -->
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> Thông tin chung
                        </h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <!-- BEGIN DASHBOARD STATS 1-->
            <div class="portlet box blue ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>Thông tin </div>
                    <div class="tools">
                    </div>
                </div>
                <div class="portlet-body form">

                    <form action="" class="form-horizontal form-bordered form-row-stripped">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Tiêu đề website</label>
                                <div class="col-md-9">
                                    <label>
                                        @if( isset($info->title) )
                                            {{ $info->title }}
                                        @endif                                        
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2">Số điện thoại</label>
                                <div class="col-md-9">
                                    <label>
                                        @if( isset($info->phoneNumber) )
                                            {{ $info->phoneNumber }}
                                        @endif
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Email</label>
                                <div class="col-md-9">
                                    <label>
                                        @if( isset($info->email) )
                                            {{ $info->email }}
                                        @endif
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Địa chỉ</label>
                                <div class="col-md-9">
                                    <label>
                                        @if( isset($info->address) )
                                            {{ $info->address }}
                                        @endif
                                    </label>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-2">Địa chỉ website</label>
                                <div class="col-md-9">
                                    <label>
                                        @if( isset($info->webUrl) )
                                            {{ $info->webUrl }}
                                        @endif
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2">Tên website</label>
                                <div class="col-md-9">
                                    <label>
                                        @if( isset($info->webName) )
                                            {{ $info->webName }}
                                        @endif
                                    </label>
                                </div>
                            </div>

                            <div class="form-group last">
                                <label class="control-label col-md-2">Ảnh đại diện</label>
                                <div class="col-md-9">
                                    @if( isset($info->image) )
                                    <label><img alt="image" src="{{ asset('img/info/' . $info->image) }}" class="img-thumbnail" width="80%"/></label>
                                    @else
                                    <label><img alt="image" src="" class="img-thumbnail" width="80%"/></label>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    @if( isset($info) )
                                    <button class="btn yellow-crusta" data-target="#full-width" data-toggle="modal" onclick="initEditInfo({{ json_encode($info) }})">
                                        Sửa
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    @else
                                    <button class="btn yellow-crusta" data-target="#full-width" data-toggle="modal" onclick="initEditInfo()">
                                        Sửa
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->

            <!-- START MODAL BOXES !-->
            <div id="full-width" class="modal container fade" tabindex="-1">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thông tin trang chủ</h4>
                </div>
                <div class="modal-body">
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form action="" class="form-horizontal form-bordered" enctype="multipart/form-data" method="POST">
                            {{ csrf_field() }}
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Tiêu đề website</label>
                                    <div class="col-md-9">
                                        <input type="text" name="title" class="form-control" id="title">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Số điện thoại</label>
                                    <div class="col-md-9">
                                        <input type="text" name="phoneNumber" class="form-control" id="phone-number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Email</label>
                                    <div class="col-md-9">
                                        <input type="text" name="email" class="form-control" id="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Địa chỉ</label>
                                    <div class="col-md-9">
                                        <input type="text" name="address" class="form-control" id="address">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3">Địa chỉ website</label>
                                    <div class="col-md-9">
                                        <input type="text" name="webUrl" class="form-control" id="web-url">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Tên website</label>
                                    <div class="col-md-9">
                                        <input type="text" name="webName" class="form-control" id="web-name">
                                    </div>
                                </div>

                                <div class="form-group last">
                                    <label class="control-label col-md-3">Ảnh đại diện</label>
                                    <div class="col-md-9">
                                        <label><img id="img-preview" alt="image" src="" class="img-thumbnail" width="50%"/></label>
                                        <input accept="image/*" type="file" name="image" class="form-control" onchange="loadFile(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn green">
                                                    <i class="fa fa-check"></i> Lưu</button>
                                                <button type="button" data-dismiss="modal" class="btn btn-outline dark">Đóng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>
            </div>
            <!-- END MODAL BOXES !-->
        </div>
<script>

    var initEditInfo = () => {
        document.getElementById('title').value = '';
        document.getElementById('phone-number').value = '';
        document.getElementById('email').value = '';
        document.getElementById('address').value = '';
        document.getElementById('web-url').value = '';
        document.getElementById('web-name').value = '';
    }

    var initEditInfo = info => {
        document.getElementById('title').value = info['title'];
        document.getElementById('phone-number').value = info['phoneNumber'];
        document.getElementById('email').value = info['email'];
        document.getElementById('address').value = info['address'];
        document.getElementById('web-url').value = info['webUrl'];
        document.getElementById('web-name').value = info['webName'];
        document.getElementById('img-preview').src = '{{ asset('img/info') }}/' + info['image'];
    }

    var loadFile = function(event) {
        var output = document.getElementById('img-preview');
        output.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
@stop

