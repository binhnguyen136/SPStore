@extends('admin.master')

@section('title', 'Controll panel | Cart')

@section('cartActive', 'start active open')

@section('cartSelected', '<span class="selected"></span>')

@section('content')
<div class="page-content-wrapper">
   <!-- BEGIN CONTENT BODY -->
   <div class="page-content" style="min-height: 1177px;">
      <!-- BEGIN PAGE HEADER-->
      <!-- BEGIN PAGE BAR -->
      <div class="page-bar">
         <ul class="page-breadcrumb">
            <li>
               <a href="index.html">Trang chủ</a>
               <i class="fa fa-circle"></i>
            </li>
            <li>
               <span>Quản lý đơn hàng</span>
            </li>
         </ul>
         <div class="page-toolbar">
         </div>
      </div>
      <!-- END PAGE BAR -->
      <!-- BEGIN PAGE TITLE-->
      <h1 class="page-title"> Quản lý đơn hàng
      </h1>
      <!-- END PAGE TITLE-->
      <!-- END PAGE HEADER-->
      <div class="row">
         <div class="col-md-12">
            <!-- Begin: life time stats -->
            <div class="portlet light portlet-fit portlet-datatable bordered">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="icon-settings font-green"></i>
                     <span class="caption-subject font-green sbold uppercase"> Danh sách đơn hàng </span>
                  </div>
                  <div class="actions">
                  </div>
               </div>
               <div class="portlet-body">
                  <div class="table-container">
                     <div id="datatable_orders_wrapper" class="dataTables_wrapper dataTables_extended_wrapper no-footer">
                        <div class="row">
                           <div class="col-md-8 col-sm-12">
                              <div class="dataTables_paginate paging_bootstrap_extended" id="datatable_orders_paginate">
                                 <div class="pagination-panel"> Trang <a href="#" class="btn btn-sm default prev disabled"><i class="fa fa-angle-left"></i></a><input type="text" class="pagination-panel-input form-control input-sm input-inline input-mini" maxlenght="5" style="text-align:center; margin: 0 5px;"><a href="#" class="btn btn-sm default next"><i class="fa fa-angle-right"></i></a></div>
                              </div>
                           </div>
                        </div>
                        <div class="table-responsive">
                           <table class="table table-striped table-bordered table-hover table-checkable dataTable no-footer" id="datatable_orders" aria-describedby="datatable_orders_info" role="grid">
                              <thead>
                                 <tr role="row" class="heading">
                                    <th width="2%" class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                       ">
                                    </th>
                                    <th width="5%"  tabindex="0" aria-controls="datatable_orders" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" Order&amp;nbsp;# : activate to sort column descending"> STT&nbsp;# </th>
                                    <th width="15%"  tabindex="0" aria-controls="datatable_orders" rowspan="1" colspan="1" aria-label=" Purchased&amp;nbsp;On : activate to sort column ascending"> Ngày </th>
                                    <th width="15%"  tabindex="0" aria-controls="datatable_orders" rowspan="1" colspan="1" aria-label=" Customer : activate to sort column ascending"> Khách hàng </th>
                                    <th width="10%"  tabindex="0" aria-controls="datatable_orders" rowspan="1" colspan="1" aria-label=" Ship&amp;nbsp;To : activate to sort column ascending"> Ship đến </th>
                                    <th width="10%"  tabindex="0" aria-controls="datatable_orders" rowspan="1" colspan="1" aria-label=" Base&amp;nbsp;Price : activate to sort column ascending"> Giá gốc </th>
                                    <th width="10%"  tabindex="0" aria-controls="datatable_orders" rowspan="1" colspan="1" aria-label=" Purchased&amp;nbsp;Price : activate to sort column ascending"> Thanh toán </th>
                                    <th width="10%"  tabindex="0" aria-controls="datatable_orders" rowspan="1" colspan="1" aria-label=" Status : activate to sort column ascending"> Tình trạng </th>
                                    <th width="10%"  tabindex="0" aria-controls="datatable_orders" rowspan="1" colspan="1" aria-label=" Actions : activate to sort column ascending"> Hành động </th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr role="row" class="odd">
                                    <td><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="1"><span></span></label></td>
                                    <td class="sorting_1">1</td>
                                    <td>12/09/2016</td>
                                    <td>Test Customer</td>
                                    <td>Test Customer</td>
                                    <td>234.000VND</td>
                                    <td>234.000VND</td>
                                    <td><span class="label label-sm label-success">Chờ</span></td>
                                    <td><a href="?p=ecommerce_orders_Xem" class="btn btn-sm btn-circle btn-default btn-editable"><i class="fa fa-search"></i> Xem</a></td>
                                 </tr>
                                 <tr role="row" class="even">
                                    <td><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="2"><span></span></label></td>
                                    <td class="sorting_1">2</td>
                                    <td>12/09/2016</td>
                                    <td>Test Customer</td>
                                    <td>Test Customer</td>
                                    <td>234.000VND</td>
                                    <td>234.000VND</td>
                                    <td><span class="label label-sm label-info">Đóng</span></td>
                                    <td><a href="?p=ecommerce_orders_Xem" class="btn btn-sm btn-circle btn-default btn-editable"><i class="fa fa-search"></i> Xem</a></td>
                                 </tr>
                                 <tr role="row" class="odd">
                                    <td><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="3"><span></span></label></td>
                                    <td class="sorting_1">3</td>
                                    <td>12/09/2016</td>
                                    <td>Test Customer</td>
                                    <td>Test Customer</td>
                                    <td>234.000VND</td>
                                    <td>234.000VND</td>
                                    <td><span class="label label-sm label-info">Đóng</span></td>
                                    <td><a href="?p=ecommerce_orders_Xem" class="btn btn-sm btn-circle btn-default btn-editable"><i class="fa fa-search"></i> Xem</a></td>
                                 </tr>
                                 <tr role="row" class="even">
                                    <td><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="4"><span></span></label></td>
                                    <td class="sorting_1">4</td>
                                    <td>12/09/2016</td>
                                    <td>Test Customer</td>
                                    <td>Test Customer</td>
                                    <td>234.000VND</td>
                                    <td>234.000VND</td>
                                    <td><span class="label label-sm label-success">Chờ</span></td>
                                    <td><a href="?p=ecommerce_orders_Xem" class="btn btn-sm btn-circle btn-default btn-editable"><i class="fa fa-search"></i> Xem</a></td>
                                 </tr>
                                 <tr role="row" class="odd">
                                    <td><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="5"><span></span></label></td>
                                    <td class="sorting_1">5</td>
                                    <td>12/09/2016</td>
                                    <td>Test Customer</td>
                                    <td>Test Customer</td>
                                    <td>234.000VND</td>
                                    <td>234.000VND</td>
                                    <td><span class="label label-sm label-success">Chờ</span></td>
                                    <td><a href="?p=ecommerce_orders_Xem" class="btn btn-sm btn-circle btn-default btn-editable"><i class="fa fa-search"></i> Xem</a></td>
                                 </tr>
                                 <tr role="row" class="even">
                                    <td><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="6"><span></span></label></td>
                                    <td class="sorting_1">6</td>
                                    <td>12/09/2016</td>
                                    <td>Test Customer</td>
                                    <td>Test Customer</td>
                                    <td>234.000VND</td>
                                    <td>234.000VND</td>
                                    <td><span class="label label-sm label-danger">Lỗi</span></td>
                                    <td><a href="?p=ecommerce_orders_Xem" class="btn btn-sm btn-circle btn-default btn-editable"><i class="fa fa-search"></i> Xem</a></td>
                                 </tr>
                                 <tr role="row" class="odd">
                                    <td><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="7"><span></span></label></td>
                                    <td class="sorting_1">7</td>
                                    <td>12/09/2016</td>
                                    <td>Test Customer</td>
                                    <td>Test Customer</td>
                                    <td>234.000VND</td>
                                    <td>234.000VND</td>
                                    <td><span class="label label-sm label-danger">Lỗi</span></td>
                                    <td><a href="?p=ecommerce_orders_Xem" class="btn btn-sm btn-circle btn-default btn-editable"><i class="fa fa-search"></i> Xem</a></td>
                                 </tr>
                                 <tr role="row" class="even">
                                    <td><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="8"><span></span></label></td>
                                    <td class="sorting_1">8</td>
                                    <td>12/09/2016</td>
                                    <td>Test Customer</td>
                                    <td>Test Customer</td>
                                    <td>234.000VND</td>
                                    <td>234.000VND</td>
                                    <td><span class="label label-sm label-success">Chờ</span></td>
                                    <td><a href="?p=ecommerce_orders_Xem" class="btn btn-sm btn-circle btn-default btn-editable"><i class="fa fa-search"></i> Xem</a></td>
                                 </tr>
                                 <tr role="row" class="odd">
                                    <td><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="9"><span></span></label></td>
                                    <td class="sorting_1">9</td>
                                    <td>12/09/2016</td>
                                    <td>Test Customer</td>
                                    <td>Test Customer</td>
                                    <td>234.000VND</td>
                                    <td>234.000VND</td>
                                    <td><span class="label label-sm label-danger">Lỗi</span></td>
                                    <td><a href="?p=ecommerce_orders_Xem" class="btn btn-sm btn-circle btn-default btn-editable"><i class="fa fa-search"></i> Xem</a></td>
                                 </tr>
                                 <tr role="row" class="even">
                                    <td><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="10"><span></span></label></td>
                                    <td class="sorting_1">10</td>
                                    <td>12/09/2016</td>
                                    <td>Test Customer</td>
                                    <td>Test Customer</td>
                                    <td>234.000VND</td>
                                    <td>234.000VND</td>
                                    <td><span class="label label-sm label-info">Đóng</span></td>
                                    <td><a href="?p=ecommerce_orders_Xem" class="btn btn-sm btn-circle btn-default btn-editable"><i class="fa fa-search"></i> Xem</a></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                        <div class="row">
                           <div class="col-md-8 col-sm-12">
                              <div class="dataTables_paginate paging_bootstrap_extended">
                                 <div class="pagination-panel"> Page <a href="#" class="btn btn-sm default prev disabled"><i class="fa fa-angle-left"></i></a><input type="text" class="pagination-panel-input form-control input-sm input-inline input-mini" maxlenght="5" style="text-align:center; margin: 0 5px;"><a href="#" class="btn btn-sm default next"><i class="fa fa-angle-right"></i></a></div>
                              </div>
                           </div>
                           <div class="col-md-4 col-sm-12"></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- End: life time stats -->
         </div>
      </div>
   </div>
   <!-- END CONTENT BODY -->
</div>
@stop