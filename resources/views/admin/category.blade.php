@extends('admin.master')

@section('title', 'Controll panel | category')

@section('catActive', 'start active open')

@section('catSelected', '<span class="selected"></span>')

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
                                    <span>Danh mục sản phẩm</span>
                                </li>
                            </ul>
                            <div class="page-toolbar">
                            </div>
                        </div>
                        <!-- END PAGE BAR -->
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> Danh mục sản phẩm
                        </h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <!-- BEGIN DASHBOARD STATS 1-->
<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-cogs"></i>Danh mục</div>
        <div class="tools">
        </div>
    </div>
    <div class="portlet-body">
        <div class="btn-group btn-group-solid margin-bottom-10">
            <button type="button" class="btn green" data-target="#full-width-add" data-toggle="modal" onclick="initAdd()">
                <i class="fa fa-plus-square green"></i>
                Thêm danh mục
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
                    <th width="25% !important">Danh mục cha</th>
                    <th>Tên danh mục</th>
                    <th width="15% !important">Tùy chọn</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($cateList as $cate)
                    <tr>
                        @if($cate->cate_name === $cate->parent_name)
                        <td class="bg-grey-mint bg-font-grey-mint">Gốc</td>
                        @else
                        <td class="bg-grey bg-font-grey">{{ $cate->parent_name }}</td>
                        @endif
                        <td>{{ $cate->cate_name }}</td>
                        <td>
                            <div class="btn-group btn-group-solid">
                                <button type="button" class="btn yellow" data-target="#full-width" data-toggle="modal" onclick="initEditCategory({{ json_encode($cate) }})">Sửa</button>
                                <button type="button" class="btn red" data-target="#full-width-delete" data-toggle="modal" onclick="selectChange({{ $cate->cate_id }})">Xóa</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- START MODAL BOXES !-->
<div id="full-width" class="modal container fade" tabindex="-1">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Danh mục</h4>
    </div>
    <div class="modal-body">
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form action="{{ url('admin/edit-category') }}" class="form-horizontal form-bordered" enctype="multipart/form-data" method="POST">
            {{ csrf_field() }}
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Tên danh mục</label>
                        <div class="col-md-9">
                            <input type="hidden" name="cat_id" class="form-control" id="edit_id" value="">
                            <input type="text" name="cat_name" class="form-control" id="edit_name" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Danh mục cha</label>
                        <div class="col-md-9">
                            <select class="form-control" id="edit_parent_id" name="cat_parent">
                                <option value="0">Danh mục gốc</option>
                                @foreach($cateList as $cate)
                                <option value="{{ $cate->cate_id }}">{{ $cate->cate_name }}</option>
                                @endforeach
                            </select>
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
        <h4 class="modal-title">Danh mục</h4>
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
                                    <button type="button" class="btn red" onclick="deleteCate()">
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
        <h4 class="modal-title">Danh mục</h4>
    </div>
    <div class="modal-body">
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form action="" class="form-horizontal form-bordered" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Tên danh mục</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" id="name" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Thư mục cha</label>
                        <div class="col-md-9">
                            <select class="form-control" id="parent_id" name="parent_id">
                                <option value="0">Danh mục gốc</option>
                                @foreach($cateList as $cate)
                                @if( $cate->cate_name === $cate->parent_name )
                                <option value="{{ $cate->cate_id }}">{{ $cate->cate_name }}</option>
                                @endif
                                @endforeach
                            </select>
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

    var selectedCateId = '';

    var selectChange = id => {
        selectedCateId = id;
    }

    var initAdd = () => {
        document.getElementById('name').value = '';
        document.getElementById('parent_id').value = 0;
    }

    var initEditCategory = cate => {
        document.getElementById('edit_id').value = cate['cate_id'];
        document.getElementById('edit_name').value = cate['cate_name'];
        if(cate['cate_id'] == cate['parent_id'])
            document.getElementById('edit_parent_id').value = 0;
        else
            document.getElementById('edit_parent_id').value = cate['parent_id'];
    }

    var deleteCate = () =>{
        if(selectedCateId == '')
            return;
        // send request use get jquery
        /*
        $.get('{{ url('admin/remove-category') }}/' + selectedCateId, response => {
            window.location.reload();
        })
        */
        window.location.href = '{{ url('admin/remove-category') }}/' + selectedCateId;
    }

</script></div>
<!-- END CONTAINER -->
@stop


