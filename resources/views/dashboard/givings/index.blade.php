@extends('layouts.app')

@section('bar-title') العطاءات @endsection
@section('page-title') العطاءات @endsection

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  <div class="container-fluid px-1">
    <div class="card card-custom gutter-b">
      <div class="card-header flex-wrap py-3">
        <div class="card-title">
          <h3 class="card-label">العطاءات
            <span class="d-block text-muted pt-2 font-size-sm">عرض &amp; إدارة</span>
          </h3>
        </div>
        <div class="card-toolbar">
          <a href="{{ route('givings.create') }}" class="btn btn-primary font-weight-bolder Popup" title="إضافة عطاء">
            <span class="svg-icon svg-icon-md"></span>إضافة عطاء
          </a>
        </div>
      </div>

      <div class="card-body">
        <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3 text-center" id="tblGivings">
          <thead class="bg-dark text-center">
            <tr class="fw-bold text-muted" style="color:#fff!important">
              <th>#</th>
              <th>الاسم</th>
              <th>الكمية</th>
              <th>الحملة</th>
              <th>المتبرع</th>
              <th>تاريخ الإضافة</th>
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
   $(function () {
      BindDataTable();
    });
    var oTable;
    function BindDataTable() {
      oTable = $('#tblGivings').DataTable({
  lengthMenu: [10, 25, 50],
        pageLength: 10,
        "paging": true,
        "searching": false,
        "ordering": false,
        "info": true,
        "responsive": true,
        serverSide: true,
        "bDestroy": true,
        "bSort": true,
        "iDisplayLength": 10,
        "sPaginationType": "full_numbers",
        "bStateSave": true,
        "dom": '<"top"i>rt<"bottom"flp><"clear">',


    columns: [
      { data: 'id',            name: 'id' },
      { data: 'name',          name: 'name' },
      { data: 'quantity',      name: 'quantity' },
      { data: 'category_name', name: 'category.name', orderable:false, searchable:true },
      { data: 'doner_name',    name: 'doner.name',    orderable:false, searchable:true },
      { data: 'Date',          name: 'Date' },
      { data: 'actions',       name: 'actions', orderable:false, searchable:false, className:'text-center' },
    ],

    ajax: {
  type: "POST",
  url: "/dashboard/givings/AjaxDT",
  headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" }
},

  });


}
</script>
@endsection
