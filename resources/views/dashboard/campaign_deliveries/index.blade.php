@extends('layouts.app')

@section('bar-title') تسليم الحملات @endsection
@section('page-title') تسليم الحملات @endsection

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  <div class="container-fluid px-1">
    <div class="card card-custom gutter-b">
      <div class="card-header flex-wrap py-3">
        <div class="card-title">
          <h3 class="card-label">تسليم الحملات
            <span class="d-block text-muted pt-2 font-size-sm">عرض &amp; إدارة التسليم</span>
          </h3>
        </div>
        <div class="card-toolbar">
          <a href="{{ route('campaign_deliveries.create') }}" class="btn btn-primary font-weight-bolder Popup" style="margin:2px;" title="إضافة تسليم">
            <span class="svg-icon svg-icon-md">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><g fill="none"><rect width="24" height="24"/><circle fill="#000" cx="9" cy="15" r="6"/><path d="M8.8,7c1-1.8,3-3,5.2-3C17.3,4,20,6.7,20,10c0,2.2-1.2,4.2-3,5.2C17,15.1,17,15,17,15c0-4.4-3.6-8-8-8C9,7,8.9,7,8.8,7Z" fill="#000" opacity=".3"/></g></svg>
            </span>إضافة تسليم
          </a>
        </div>
      </div>

      <div class="card-body">
        <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3 text-center" id="tblAjax">
          <thead class="bg-dark text-center">
            <tr class="fw-bold text-muted" style="color:#fff !important">
              <th>#</th>
              <th>الحالة</th>
              <th>الحملة</th>
              <th>العائلة</th>
              <th>المسؤول</th>
              <th>الصورة</th>
              <th>التاريخ</th>
              <th>الإجراءات</th>
            </tr>
          </thead>
        </table>
      </div>

    </div>
  </div>
</div>
@endsection

@section('script')
<script src="{{ asset('backend/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script>
$(function(){ BindDataTable(); });
var oTable;
function BindDataTable(){
  oTable = $('#tblAjax').dataTable({
    lengthMenu:[5,10,25,50],
    pageLength:10,
    paging:true, searching:false, ordering:false, info:true,
    responsive:true, serverSide:true, bDestroy:true, bSort:true,
    iDisplayLength:10, sPaginationType:"full_numbers", bAutoWidth:false, bStateSave:true,
    dom:'<"top"i>rt<"bottom"flp><"clear">',
    columns: [
      {data:'id', name:'id'},
      {data:'status', name:'status'},
      {data:'campaign_id', name:'campaign_id'},
      {data:'familiy_id', name:'familiy_id'},
      {data:'admin_id', name:'admin_id'},
      {data:'image_thumb', name:'image_thumb', orderable:false, searchable:false},
      {data:'Date', name:'Date'},
      {data:'actions', name:'actions', orderable:false, searchable:false, sClass:'text-center'}
    ],
    ajax:{
      type:"POST",
      contentType:"application/json",
      url:'/dashboard/campaign-deliveries/AjaxDT',
      data:function(d){ d._token = "{{ csrf_token() }}"; return JSON.stringify(d); }
    },
    fnDrawCallback:function(){}
  });
}
</script>
@endsection
