{{-- resources/views/dashboard/campaigns/index.blade.php --}}
@extends('layouts.app')

@section('bar-title') الحملات @endsection
@section('page-title') الحملات @endsection


@section('content')
  <div class="container-fluid px-1">
    <div class="card card-custom gutter-b">
      <div class="card-header flex-wrap py-3">
        <div class="card-title">
          <h3 class="card-label">الحملات
            <span class="d-block text-muted pt-2 font-size-sm">عرض &amp; الحملات</span>
          </h3>
        </div>
        <div class="card-toolbar">
          <a href="{{ route('campaigns.create') }}" class="btn btn-primary font-weight-bolder Popup " style="margin: 2px;"
            title="اضافة فئة">
            <span class="svg-icon svg-icon-md">
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <rect x="0" y="0" width="24" height="24"></rect>
                  <circle fill="#000000" cx="9" cy="15" r="6"></circle>
                  <path
                    d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                    fill="#000000" opacity="0.3"></path>
                </g>
              </svg>
            </span>اضافة فئة
          </a>
        </div>
      </div>

      <div class="card-body">
        <div class="dataTables_wrapper dt-bootstrap4 no-footer">
          <div class="row">
            <div class="col-sm-12">

              <div class="card-body">
                <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3 text-center"
                  id="tblCampaigns">
                  <thead class="bg-dark text-center">
                    <tr class="fw-bold text-muted" style="color:#fff!important">
                      <th class="text-center">#</th>
                      <th>اسم الحملة</th>
                      <th>الفئة</th>
                      <th>تمت الإضافة بواسطة</th>
                      <th>المخيم</th>
                      <th>الكمية </th>
                      <th>حالة الحملة  </th>
                      <th>تاريخ الإضافة</th>
                      <th>الإجراءات</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>

    $(function () {
      BindDataTable();
    });
    var oTable;
    function BindDataTable() {
      oTable = $("#tblCampaigns").dataTable({
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
          { data: 'id', name: 'id' },
          { data: 'title', name: 'title' },
          { data: 'categoryName', name: 'categoryName' },
          { data: 'adminName', name: 'adminName' },
          { data: 'campName', name: 'campName' },
          { data: 'quantity', name: 'quantity' },
          { data: 'status', name: 'status' },
          { data: 'Date', name: 'Date' },
          {
            data: 'actions',
            name: 'actions',
            orderable: false,
            searchable: false,
            sClass: 'text-center'
          },
        ],
        ajax: {
          type: "post",
          contentType: "application/json",
          url: "/dashboard/campaigns/AjaxDT",
          data: function (d) {
            d._token = "{{ csrf_token() }}";
            return JSON.stringify(d);
          },
        },
       

      });
    }

    
  </script>
@endsection