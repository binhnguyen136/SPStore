@extends('admin.master')

@section('title', 'Controll panel | Navigation')

@section('navActive', 'start active open')

@section('navSelected', '<span class="selected"></span>')

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
                                    <span>Thanh điều hướng</span>
                                </li>
                            </ul>
                            <div class="page-toolbar">
                            </div>
                        </div>
                        <!-- END PAGE BAR -->
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> Thanh điều hướng
                        </h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <!-- BEGIN DASHBOARD STATS 1-->
<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-cogs"></i>Thanh điều hướng</div>
        <div class="tools">
        </div>
    </div>
    <div class="portlet-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th width="25% !important">Danh mục cha</th>
                    <th>Tên danh mục</th>
                    <th>Thứ tự</th>
                    <th width="15% !important">Tùy chọn</th>
                </tr>
                </thead>
                <tbody>

                    @foreach( $cateParentList as $cateParent )
	                    <tr>
	                        <td class="bg-grey-mint bg-font-grey-mint">Gốc</td>
	                        <td>{{ $cateParent->cate_name }}</td>
	                        <td>{{ ($cateParent->cate_ordinal==0 ? 'Không hiển thị' : $cateParent->cate_ordinal) }}</td>
	                        <td>
	                            <div class="btn-group btn-group-solid">
	                                <button type="button" class="btn yellow" style="margin: 0 auto;" data-target="#full-width-parent" data-toggle="modal" onclick="initParentEdit({{ json_encode($cateParent) }})">Sửa</button>
	                            </div>
	                        </td>
	                    </tr>

                        @if( $cateListCount[$cateParent->cate_id] > 0 )
                            @for( $i = 0; $i < $cateListCount[$cateParent->cate_id]; $i++ )
                            <tr>
                                <td class="bg-grey bg-font-grey">{{ $cateParent->cate_name }}</td>
                                <td>{{ $cateList[$cateParent->cate_id][$i]->name }}</td>
                                <td>{{ ($cateList[$cateParent->cate_id][$i]->ordinal==0 ? 'Không hiển thị' : $cateList[$cateParent->cate_id][$i]->ordinal) }}</td>
                                <td>
                                    <div class="btn-group btn-group-solid">
                                        <button type="button" class="btn yellow" style="margin: 0 auto;" data-target="#full-width" data-toggle="modal" onclick="initEdit({{ json_encode($cateList[$cateParent->cate_id][$i]) }})">Sửa</button>
                                    </div>
                                </td>
                            </tr>                                  
                            @endfor
                        @endif

                    @endforeach

                    </tbody>
            </table>
        </div>
    </div>
</div>

<!-- START MODAL BOXES !-->
<div id="full-width-parent" class="modal container fade" tabindex="-1">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Thanh điều hướng</h4>
    </div>
    <div class="modal-body">
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form action="" class="form-horizontal form-bordered" enctype="multipart/form-data" method="POST">
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Tên danh mục</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="parent_name" readonly="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Thứ tự</label>
                        <div class="col-md-9">
                            <select class="form-control" id="parent_ordinal" onchange="changeSelectedParent()">
                                @for( $i=0; $i<=$cateParentCount; $i++)
                                <option value="{{ $i }}">{{ ($i==0 ? 'Không hiển thị' : $i) }}</option>
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
                                    <button type="button" class="btn green" onclick="exeEdit()">
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
<div id="full-width" class="modal container fade" tabindex="-1">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Thanh điều hướng</h4>
    </div>
    <div class="modal-body">
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form action="" class="form-horizontal form-bordered" enctype="multipart/form-data" method="POST">
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Tên danh mục</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="cate_name" readonly="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Thứ tự</label>
                        <div class="col-md-9">
                            <select class="form-control" id="cate_ordinal" onchange="changeSelected()">
                            </select>
                        </div>
                    </div>

                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="button" class="btn green" onclick="exeEdit()">
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
<!-- END CONTAINER -->

<script type="text/javascript">
    var cateListCount = <?php echo json_encode($cateListCount) ?>;

	var selectedId = '', selectedOrdinal = '';

	var changeSelectedParent = () => {
		selectedOrdinal = document.getElementById('parent_ordinal').value;
	}

	var changeSelected = () => {
		selectedOrdinal = document.getElementById('cate_ordinal').value;
	}	

	var initParentEdit = cate => {
		selectedId = cate.cate_id;
		selectedOrdinal = cate.cate_ordinal;		
		document.getElementById('parent_name').value = cate.cate_name;
		document.getElementById('parent_ordinal').value = cate.cate_ordinal;
	}

	var initEdit = cate => {
        var selectTag = document.getElementById('cate_ordinal');

        while (selectTag.firstChild) {
            selectTag.removeChild(selectTag.firstChild);
        }

        for(var i=0; i<=cateListCount[cate.parent_id]; i++){
            var option = document.createElement('option');
            option.value = i;
            option.text = (i==0 ? 'Không hiển thị' : i);
            selectTag.appendChild(option);
        }

		selectedId = cate.id;
		selectedOrdinal = cate.ordinal;			
		document.getElementById('cate_name').value = cate.name;
		document.getElementById('cate_ordinal').value = cate.ordinal;
	}

	var exeEdit = () => {
		window.location.href = '{{ url('admin/edit-nav') }}' + "?id=" + selectedId + "&ordinal=" + selectedOrdinal ;
	}

</script>

@stop