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

                        <div class="table-responsive">
                           <table class="table table-striped table-bordered table-hover table-checkable dataTable no-footer" id="datatable_orders" aria-describedby="datatable_orders_info" role="grid">
                              <thead>
                                 <tr role="row" class="heading">

                                    <th width="5%"  tabindex="0" aria-controls="datatable_orders" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" Order&amp;nbsp;# : activate to sort column descending"> STT&nbsp;# </th>
                                    <th width="15%"  tabindex="0" aria-controls="datatable_orders" rowspan="1" colspan="1" aria-label=" Purchased&amp;nbsp;On : activate to sort column ascending"> Ngày </th>
                                    <th width="15%"  tabindex="0" aria-controls="datatable_orders" rowspan="1" colspan="1" aria-label=" Customer : activate to sort column ascending"> Mã khách hàng </th>
                                    <th width="10%"  tabindex="0" aria-controls="datatable_orders" rowspan="1" colspan="1" aria-label=" Base&amp;nbsp;Price : activate to sort column ascending"> Tổng tiền </th>
                                    <th width="10%"  tabindex="0" aria-controls="datatable_orders" rowspan="1" colspan="1" aria-label=" Purchased&amp;nbsp;Price : activate to sort column ascending"> Thanh toán </th>
                                    <th width="10%"  tabindex="0" aria-controls="datatable_orders" rowspan="1" colspan="1" aria-label=" Status : activate to sort column ascending"> Tình trạng </th>
                                    <th width="10%"  tabindex="0" aria-controls="datatable_orders" rowspan="1" colspan="1" aria-label=" Actions : activate to sort column ascending"> Hành động </th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php $count = 0 ?>
                                 @foreach($order_list as $order)
                                 <tr role="row" class="odd">
                                    <td class="sorting_1"><?= ++$count ?></td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->customer_id }}</td>
                                    <td>{{ $order->total }}</td>
                                    <td>{{ $order->payment }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td><a href="?p=ecommerce_orders_Xem" class="btn btn-sm btn-circle btn-default btn-editable"><i class="fa fa-search"></i> Xem</a></td>
                                 </tr>
                                 @endforeach
                              </tbody>
                           </table>
                           <div style="text-align: center;">
                           {{ $order_list->render() }}
                           </div>  
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