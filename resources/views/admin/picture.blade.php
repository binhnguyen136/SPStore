@extends('admin.master')

@section('title', 'Controller panel | Picture')

@section('picActive', 'start active open')

@section('picSelected', '<span class="selected"></span>')

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
                                    <span>Hình ảnh</span>
                                </li>
                            </ul>
                            <div class="page-toolbar">
                            </div>
                        </div>
                        <!-- END PAGE BAR -->
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> Hình ảnh
                        </h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <!-- BEGIN DASHBOARD STATS 1-->
<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-cogs"></i>Hình ảnh</div>
        <div class="tools">
        </div>
    </div>
    <div class="portlet-body">
        <div class="btn-group btn-group-solid margin-bottom-10">
            <button type="button" class="btn green" data-target="#full-width-add" data-toggle="modal" onclick="initAddPicture()">
                <i class="fa fa-plus-square green"></i>
                Thêm hình ảnh
            </button>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif        

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th width="30% !important">Ảnh</th>
                    <th>Thông tin ảnh</th>
                    <th width="15% !important">Tùy chọn</th>
                </tr>
                </thead>
                <tbody>
                    @foreach( $pictureList as $picture )
                    <tr>
                        <td><img src="{{ asset('img/pictures/' . $picture->image) }}" class="thumbnail" width="50%"></td>
                        <td>
                            {{ $picture->content }}
                        </td>
                        <td>
                            <div class="btn-group btn-group-solid">
                                <button type="button" class="btn yellow" data-target="#full-width" data-toggle="modal" onclick="initEdit({{ $picture }})">Sửa</button>
                                <button type="button" class="btn red" data-target="#full-width-delete" data-toggle="modal" onclick="changeSelectedId({{ $picture->id }})">Xóa</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $pictureList->render() }}
        </div>
    </div>
</div>

<!-- START MODAL BOXES !-->
<div id="full-width" class="modal container fade" tabindex="-1">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Sửa hình ảnh</h4>
    </div>
    <div class="modal-body">
<div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form action="{{ url('admin/edit-picture') }}" class="form-horizontal form-bordered" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-body">
                    <div class="form-group">
                        <input type="hidden" name="editId" id="edit-id">
                        <label class="control-label col-md-3">Ảnh</label>
                        <div class="col-md-2">
                            <label><img id="edit-img-preview" alt="image" src="" class="img-thumbnail" width="100%"/></label>
                            <input accept="image/*" type="file" name="editImage" class="form-control" id="edit-img" onchange="loadEditFile(event)">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">Mô tả</label>
                        <div class="col-md-9">
                            <input type="text" name="editContent" class="form-control" id="edit-content" value="">
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

<!-- START MODAL BOXES !-->
<div id="full-width-delete" class="modal container fade" tabindex="-1">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Xóa hình ảnh</h4>
    </div>
    <div class="modal-body">
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form action="" class="form-horizontal form-bordered" method="POST">
            {{ csrf_field() }}
                <div class="form-body">
                    <div class="form-group">
                        <input type="hidden" name="cat_id" value="" />
                        <div class="alert alert-danger">
                            <strong>
                                BẠN CÓ CHẮC CHẮN MUỐN XÓA?
                            </strong>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="button" class="btn red" onclick="deletePicture()">
                                        <i class="fa fa-check"></i> Xóa</button>
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

<!-- START MODAL BOXES !-->
<div id="full-width-add" class="modal container fade" tabindex="-1">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Thêm hình ảnh</h4>
    </div>
    <div class="modal-body">
<div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form action="" class="form-horizontal form-bordered" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Ảnh</label>
                        <div class="col-md-2">
                            <label><img id="img-preview" alt="image" src="" class="img-thumbnail" width="100%"/></label>
                            <input accept="image/*" type="file" name="image" class="form-control" id="img" onchange="loadFile(event)">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">Mô tả</label>
                        <div class="col-md-9">
                            <input type="text" name="content" class="form-control" id="content" value="">
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

<script>

    var selectedId = '';

    var changeSelectedId = id => {
        selectedId = id;
    }

    var deletePicture = () => {
        if(selectedId == '')
            return;
        $.get('{{ url('admin/remove-picture') }}/' + selectedId , response => {
            window.location.reload();
        });
    }

    var loadFile = event => {
        var output = document.getElementById('img-preview');
        output.src = URL.createObjectURL(event.target.files[0]);
    };

    var loadEditFile = event => {
        document.getElementById('edit-img-preview').src = URL.createObjectURL(event.target.files[0]);
    }

    var initEdit = picture => {
        document.getElementById('edit-id').value = picture['id'];
        document.getElementById('edit-img-preview').src = '{{ asset('img/pictures') }}/' + picture['image'];
        document.getElementById('edit-img').value = '';
        document.getElementById('edit-content').value = picture['content'];
    }

    var initAddPicture = () => {
        document.getElementById('img-preview').src = '';
        document.getElementById('img').value = '';
        document.getElementById('content').value = '';
    }

</script></div>
<!-- END CONTAINER -->
@stop


