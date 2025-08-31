@extends('layouts.app')

@section('bar-title') المخيمات @endsection
@section('page-title') المخيمات @endsection

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  <div class="container-fluid px-1">
    <div class="card card-custom gutter-b">
      <div class="card-header flex-wrap py-3">
        <div class="card-title">
          <h3 class="card-label">المخيمات
            <span class="d-block text-muted pt-2 font-size-sm">عرض &amp; إدارة</span>
          </h3>
        </div>
        <div class="card-toolbar">
          <a href="{{ route('camps.create') }}" class="btn btn-primary font-weight-bolder Popup" title="إضافة مخيم">
            <span class="svg-icon svg-icon-md"></span>إضافة مخيم
          </a>
        </div>
      </div>

      <div class="card-body">
        <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3 text-center" id="tblCamps">
          <thead class="bg-dark text-center">
            <tr class="fw-bold text-muted" style="color:#fff!important">
              <th class="text-center">#</th>
              <th>الاسم</th>
              <th>العنوان</th>
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
  $('#tblCamps').DataTable({
    lengthMenu: [5,10,25,50],
    pageLength: 10,
    paging: true,
    searching: true,
    ordering: false,
    info: true,
    autoWidth: false,
    responsive: true,
    processing: true,
    serverSide: true,
    stateSave: true,
    dom: '<"top"i>rt<"bottom"flp><"clear">',

    ajax: {
      type: "POST",
                    url: '/dashboard/camps/AjaxDT/',
      data: function (d) { d._token = "{{ csrf_token() }}"; }
    },

    columns: [
      { data: 'id',          name: 'id' },
      { data: 'name',        name: 'name' },
      { data: 'address',     name: 'address' },
      { data: 'created_at',  name: 'created_at' },
      { data: 'actions',     name: 'actions', orderable:false, searchable:false, className:'text-center' },
    ],
  });

  // حذف سريع عبر ConfirmLink (اختياري)
  $(document).on('click', '.ConfirmLink', function(){
    if(!confirm('تأكيد الحذف؟')) return;
    const url = $(this).data('url');
    $.ajax({
      url, type:'POST',
      data:{ _method:'DELETE', _token:'{{ csrf_token() }}' },
      success: () => $('#tblCamps').DataTable().ajax.reload(null,false),
      error:   () => alert('فشل الحذف')
    });
  });
});
</script>
@endsection
