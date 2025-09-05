@extends('layouts.app')

@section('bar-title') طلبات اعتماد الأسر @endsection
@section('page-title') طلبات اعتماد الأسر @endsection

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  <div class="container-fluid px-1">
    <div class="card card-custom gutter-b">
      <div class="card-header flex-wrap py-3">
        <div class="card-title">
          <h3 class="card-label">طلبات اعتماد الأسر
            <span class="d-block text-muted pt-2 font-size-sm">عرض &amp; إدارة</span>
          </h3>
        </div>
    
      </div>

      <div class="card-body">
        <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3 text-center" id="tblFamilies">
          <thead class="bg-dark text-center">
            <tr class="fw-bold text-muted" style="color:#fff!important">
              <th>#</th>
              <th>الاسم</th>
              <th>المخيم</th>
              <th>عدد الأفراد</th>
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
      oTable = $("#tblFamilies").dataTable({
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
    { data: 'camp_name',     name: 'camp.name', orderable:false, searchable:true },
    { data: 'family_member', name: 'family_member' },
    { data: 'actions',       orderable:false, searchable:false, className:'text-center' },
  ],

        ajax: {
          type: "post",
          contentType: "application/json",
          url: "/dashboard/families/AjaxDT",
          data: function (d) {
            d._token = "{{ csrf_token() }}";
            d.status = "pending";

            return JSON.stringify(d);
          },
        },
       

      });
    }

    
</script>
@endsection