@extends('admin.master')

@section('title', 'Controll panel | Product')

@section('productActive', 'start active open')

@section('productSelected', '<span class="selected"></span>')

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
                                    <span>Sản phẩm</span>
                                </li>
                            </ul>
                            <div class="page-toolbar">
                            </div>
                        </div>
                        <!-- END PAGE BAR -->
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> Sản phẩm
                        </h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <!-- BEGIN DASHBOARD STATS 1-->
<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-cogs"></i>Sản phẩm</div>
        <div class="tools">
        </div>
    </div>
    <div class="portlet-body">
        <div class="btn-group btn-group-solid margin-bottom-10">
            <button type="button" class="btn green" data-target="#full-width-add" data-toggle="modal" onclick="initAddProduct()">
                <i class="fa fa-plus-square green"></i>
                Thêm sản phẩm
            </button>

            <select name="" class="filter form-control" id="cate-filter" onchange="initPage()">
                <option value="0">Tất cả danh mục</option>
                @foreach( $cateList as $cate )
                <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                @endforeach
            </select>
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
                    <th width="30% !important">Ảnh sản phẩm</th>
                    <th>Thông tin sản phẩm</th>
                    <th width="15% !important">Tùy chọn</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($productList as $product)
                    <tr>
                        <td><img src="{{ asset('img/products/' . $product->image) }}" class="thumbnail" width="50%"></td>
                        <td>
                            <ul>
                                <li><b>Tên sản phẩm</b>: {{ $product->name }}</li>
                                <li><b>Giá gốc</b>: {{ $product->primary_cost }}</li>
                                <li><b>Giá bán</b>: {{ $product->cost }}</li>
                                <li><b>Giới thiệu</b>: {{ $product->detail }}</li>
                            </ul>
                        </td>
                        <td>
                            <div class="btn-group btn-group-solid">
                                <button type="button" class="btn yellow" data-target="#full-width" data-toggle="modal" onclick="initEditProduct({{ $product }})">Sửa</button>
                                <button type="button" class="btn red" data-target="#full-width-delete" data-toggle="modal" onclick="selectChanged({{ $product->id }})">Xóa</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="text-align: center;">
            {{ $productList->render() }}
            </div>            
        </div>
    </div>
</div>

<!-- START MODAL BOXES !-->
<div id="full-width" class="modal container fade" tabindex="-1">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Sửa sản phẩm</h4>
    </div>
    <div class="modal-body">
<div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form action="{{ url('admin/edit-product') }}" class="form-horizontal form-bordered" method="POST"  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Tên sản phẩm</label>
                        <div class="col-md-9">
                            <input type="hidden" name="editId" id="edit-id">
                            <input type="text" name="editName" class="form-control" id="edit-name" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Ảnh sản phẩm</label>
                        <div class="col-md-2">
                            <label>Ảnh chính</label><br/>
                            <label><img id="edit-img-preview" alt="image" src="" class="img-thumbnail" width="100%"/></label>
                            <input accept="image/*" type="file" name="editImage" class="form-control" id="edit-img" onchange="readURL(this)">
                        </div>
                        <div class="col-md-2">
                            <label>Ảnh phụ 1</label><br/>
                            <label><img id="edit-img-1-preview" alt="image" src="" class="img-thumbnail" width="100%"/></label>
                            <input accept="image/*" type="file" name="editImage1" class="form-control" id="edit-img-1" onchange="readURL(this)">
                        </div>
                        <div class="col-md-2">
                            <label>Ảnh phụ 2</label><br/>
                            <label><img id="edit-img-2-preview" alt="image" src="" class="img-thumbnail" width="100%"/></label>
                            <input accept="image/*" type="file" name="editImage2" class="form-control" id="edit-img-2" onchange="readURL(this)">
                        </div>
                        <div class="col-md-2">
                            <label>Ảnh phụ 3</label><br/>
                            <label><img id="edit-img-3-preview" alt="image" src="" class="img-thumbnail" width="100%"/></label>
                            <input accept="image/*" type="file" name="editImage3" class="form-control" id="edit-img-3" onchange="readURL(this)">
                        </div>
                        </div>
                    </div>

                <div class="form-group">
                    <label class="control-label col-md-3">Danh mục sản phảm</label>
                    <div class="col-md-9">
                        <select name="editCateId" class="form-control" id="edit-cate-id">                          
                            @foreach( $cateList as $cate )
                            <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="form-group">
                        <label class="control-label col-md-3">Mô tả</label>
                        <div class="col-md-9">
                            <input id="edit-detail" type="text" name="editDetail" class="form-control" value="">
                        </div>
                    </div>

                <div class="form-group">
                    <label class="control-label col-md-3">Giá</label>
                    <div class="col-md-4">
                        <label>Giá gốc</label>
                        <input id="edit-primary-cost" type="text" name="editPrimary_cost" class="form-control" value="">
                    </div>
                    <div class="col-md-5">
                        <label>Giá bán</label>
                        <input id="edit-cost" type="text" name="editCost" class="form-control" value="">
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
        <h4 class="modal-title">Xóa sản phẩm</h4>
    </div>
    <div class="modal-body">
        <div class="portlet-body form">
            <!-- BEGIN FORM-->

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
                                    <button type="button" class="btn red" onclick="deleteProduct()">
                                        <i class="fa fa-check"></i> Xóa</button>
                                    <button type="button" data-dismiss="modal" class="btn btn-outline dark">Đóng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            <!-- END FORM-->
        </div>

    </div>
</div>
<!-- END MODAL BOXES !-->

<!-- START MODAL BOXES !-->
<div id="full-width-add" class="modal container fade" tabindex="-1">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Thêm sản phẩm</h4>
    </div>
    <div class="modal-body">
<div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form action="" class="form-horizontal form-bordered" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Tên sản phẩm</label>
                        <div class="col-md-9">
                            <input type="hidden" name="pro_detail"/>
                            <input type="text" name="name" class="form-control" id="name" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Ảnh sản phẩm</label>
                        <div class="col-md-2">
                            <label>Ảnh chính</label><br/>
                            <label><img id="img-preview" alt="image" src="" class="img-thumbnail" width="100%"/></label>
                            <input accept="image/*" type="file" name="image" class="form-control" id="img" onchange="readURL(this)">
                        </div>
                        <div class="col-md-2">
                            <label>Ảnh phụ 1</label><br/>
                            <label><img id="img-1-preview" alt="image" src="" class="img-thumbnail" width="100%"/></label>
                            <input accept="image/*" type="file" name="image1" class="form-control" id="img-1" onchange="readURL(this)"">
                        </div>
                        <div class="col-md-2">
                            <label>Ảnh phụ 2</label><br/>
                            <label><img id="img-2-preview" alt="image" src="" class="img-thumbnail" width="100%"/></label>
                            <input accept="image/*" type="file" name="image2" class="form-control" id="img-2" onchange="readURL(this)">
                        </div>
                        <div class="col-md-2">
                            <label>Ảnh phụ 3</label><br/>
                            <label><img id="img-3-preview" alt="image" src="" class="img-thumbnail" width="100%"/></label>
                            <input accept="image/*" type="file" name="image3" class="form-control" id="img-3" onchange="readURL(this)">
                        </div>
                        </div>
                    </div>

                <div class="form-group">
                    <label class="control-label col-md-3">Danh mục sản phảm</label>
                    <div class="col-md-9">
                        <select name="cate_id" class="form-control" id="cate_id">
                            @foreach( $cateList as $cate )
                            <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="form-group">
                        <label class="control-label col-md-3">Mô tả</label>
                        <div class="col-md-9">
                            <input type="text" name="detail" class="form-control" id="detail" value="">
                        </div>
                    </div>

                <div class="form-group">
                    <label class="control-label col-md-3">Giá</label>
                    <div class="col-md-4">
                        <label>Giá gốc</label>
                        <input type="text" name="primary_cost" class="form-control" id="primary_cost" value="">
                    </div>
                    <div class="col-md-5">
                        <label>Giá bán</label>
                        <input type="text" name="cost" class="form-control" id="cost" value="">
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

    document.getElementById('cate-filter').value = '{{ $cate_id }}' != '' ? '{{ $cate_id }}' : 0;

    var selectedProductID = '';

    var selectChanged = id => {
        selectedProductID = id;
    }

    var initPage = () => {
        var cate_id = document.getElementById('cate-filter').value;
        if(cate_id != 0)
            window.location.href = '{{ url('admin/product') }}' + '?cate_id=' + cate_id;
        else
            window.location.href = '{{ url('admin/product') }}';
    }

    var initAddProduct = () => {
        for(i = 0; i <= 3; i++){
            if(i === 0) { document.getElementById('img-preview').src = ''; document.getElementById('img').value = ''; }
            else { document.getElementById('img-' + i + '-preview').src = ''; document.getElementById('img-' + i).value = '';}
        }
        document.getElementById('name').value = '';
        document.getElementById('detail').value = '';
        document.getElementById('primary_cost').value = '';
        document.getElementById('cost').value = '';
        document.getElementById('cate_id').value = '{{ $cate_id }}';
    }

    var initEditProduct = product => {
        document.getElementById('edit-id').value = product['id'];
        document.getElementById('edit-name').value = product['name'];
        document.getElementById('edit-img-preview').src = '{{ asset('img/products') }}/' + product['image'];
        document.getElementById('edit-img-1-preview').src = '{{ asset('img/products') }}/' + product['image1'];
        document.getElementById('edit-img-2-preview').src = '{{ asset('img/products') }}/' + product['image2'];
        document.getElementById('edit-img-3-preview').src = '{{ asset('img/products') }}/' + product['image3'];
        document.getElementById('edit-cate-id').value = product['cate_id'];                      
        document.getElementById('edit-detail').value = product['detail'];
        document.getElementById('edit-primary-cost').value = product['primary_cost'];
        document.getElementById('edit-cost').value = product['cost'];
    }    

    var deleteProduct = () => {
        if(selectedProductID === '')
            return;

        $.get('{{ url('admin/remove-product') }}/' + selectedProductID, response => {
            window.location.reload()
        })
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                document.getElementById(input.id + '-preview').src = e.target.result;
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
</div>
<!-- END CONTAINER -->
@stop