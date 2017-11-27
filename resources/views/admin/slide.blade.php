@extends('admin.master')

@section('title', 'Controll panel | Slide')

@section('slideActive', 'start active open')

@section('slideSelected', '<span class="selected"></span>')

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
                        <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>Slide Ảnh</div>
                    <div class="tools">
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="btn-group btn-group-solid margin-bottom-10">
                        <button type="button" class="btn green" data-target="#full-width-add" data-toggle="modal" onclick="initAddSlide({{ $slideListCount }})">
                            <i class="fa fa-plus-square green"></i>
                            Thêm Slide
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
                                <th>Tiêu đề</th>
                                <th>Nội dung</th>
                                <th>Liên kết</th>
                                <th>Thứ tự</th>
                                <th width="15% !important">Tùy chọn</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach( $slideList as $slide )
                                <tr>
                                    <td><img src="{{ asset('img/slides/' . $slide->image ) }}" class="img-thumbnail" width="70%" /></td>
                                    <td>{{ $slide->title }}</td>
                                    <td>{{ $slide->content }}</td>
                                    <td>{{ $slide->link }}</td>
                                    <td>{{ $slide->ordinal }}</td>
                                    <td>
                                        <div class="btn-group btn-group-solid">
                                            <button type="button" class="btn yellow" data-target="#full-width" data-toggle="modal" onclick="initEditSlide({{ $slide }})">Sửa</button>
                                            <button type="button" class="btn red" data-target="#full-width-delete" data-toggle="modal" onclick="selectChange({{ $slide->id }})">Xóa</button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $slideList->render() }}
                    </div>
                </div>
            </div>


            <!-- START MODAL BOXES !-->
            <div id="full-width" class="modal container fade" tabindex="-1">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Slide Ảnh</h4>
                </div>
                <div class="modal-body">
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form action="{{ url('admin/edit-slide') }}" class="form-horizontal form-bordered" enctype="multipart/form-data" method="POST">
                        {{ csrf_field() }}
                            <input type="hidden" name="editId" id="edit-id">
                            <div class="form-body">
                                <div class="form-group">
                                    <input type="hidden" name="slide_id" value="" />
                                    <label class="control-label col-md-3">Hình ảnh</label>
                                    <div class="col-md-9">
                                        <label><img id="edit-img-preview" alt="image" src="" class="img-thumbnail" width="30%"/></label>
                                        <input accept="image/*" type="file" name="editImage" class="form-control" id="edit-img" onchange="loadFile(event)">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Tiêu đề</label>
                                    <div class="col-md-9">
                                        <input type="text" name="editTitle" class="form-control" id="edit-title" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Nội dung</label>
                                    <div class="col-md-9">
                                        <input type="text" name="editContent" class="form-control" id="edit-content" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Liên kết</label>
                                    <div class="col-md-9">
                                        <input type="text" name="editLink" class="form-control" id="edit-link" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Thứ tự</label>
                                    <div class="col-md-9">
                                        <select name="editOrdinal" id="edit-ordinal" class="form-control">
                                            @for ( $i = 1; $i <= $slideListCount; $i++ )
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
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
                    <h4 class="modal-title">Slide Ảnh</h4>
                </div>
                <div class="modal-body">
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form action="" class="form-horizontal form-bordered" method="POST">
                            <div class="form-body">
                                <div class="form-group">
                                    <input type="hidden" name="slide_id" value="" />
                                    <div class="alert alert-danger">
                                        <strong>
                                            BẠN CÓ CHẮC CHẮN MUỐN XÓA SLIDE ẢNH NÀY?
                                        </strong>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="button" class="btn red" onclick="deleteSlide()">
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
                    <h4 class="modal-title">Slide Ảnh</h4>
                </div>
                <div class="modal-body">
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form action="" class="form-horizontal form-bordered" enctype="multipart/form-data" method="POST">
                        {{ csrf_field() }}
                            <div class="form-body">
                                <div class="form-group">
                                    <input type="hidden" name="slide_id" value="" />
                                    <label class="control-label col-md-3">Hình ảnh</label>
                                    <div class="col-md-9">
                                        <label><img alt="image" src="" class="img-thumbnail" id="img-preview" width="30%"/></label>
                                        <input accept="image/*" type="file" name="image" class="form-control" id="img" onchange="loadFileAdd(event)">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Tiêu đề</label>
                                    <div class="col-md-9">
                                        <input type="text" name="title" class="form-control" id="title" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Nội dung</label>
                                    <div class="col-md-9">
                                        <input type="text" name="content" class="form-control" id="content" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Liên kết</label>
                                    <div class="col-md-9">
                                        <input type="text" name="link" class="form-control" id="link" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Thứ tự</label>
                                    <div class="col-md-9">
                                        <select name="ordinal" id="ordinal" class="form-control">
                                            @for ( $i = 1; $i <= $slideListCount + 1; $i++ )
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
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
        </div>

<script>

    var loadFile = function(event) {
        var output = document.getElementById('edit-img-preview');
        output.src = URL.createObjectURL(event.target.files[0]);
    };

    var loadFileAdd = function(event) {
        var output = document.getElementById('img-preview');
        output.src = URL.createObjectURL(event.target.files[0]);
    };

    var initAddSlide = slideListCount => {
        document.getElementById('img-preview').src = '';
        document.getElementById('img').value = '';
        document.getElementById('title').value = '';
        document.getElementById('content').value = '';
        document.getElementById('link').value = '';
        document.getElementById('ordinal').value = slideListCount + 1;
    }

    var initEditSlide = slide => {
        document.getElementById('edit-id').value = slide['id'];
        document.getElementById('edit-img-preview').src = '{{ asset('img/slides') }}/' + slide['image'];
        document.getElementById('edit-title').value = slide['title'];
        document.getElementById('edit-content').value = slide['content'];
        document.getElementById('edit-link').value = slide['link'];
        document.getElementById('edit-ordinal').value = slide['ordinal'];
    }

    var selectedId = '';

    var selectChange = id => {
        selectedId = id;
    }

    var deleteSlide = () => {
        if(selectedId == '')
            return;
        $.get('{{ url('admin/remove-slide') }}/' + selectedId, response => {
            window.location.reload();
        });
    }

</script>
    <!-- END CONTAINER -->
@stop




