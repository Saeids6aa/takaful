@extends('layouts.app')

@section('bar-title')
    المسؤولين
@endsection

@section('page-title')
    المسؤولين
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-fluid px-1">
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap py-3">
                    <div class="card-title">
                        <h3 class="card-label">المسؤولين
                            <span class="d-block text-muted pt-2 font-size-sm">عرض &amp; المسؤولين</span>
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ route('admins.create') }}" class="btn btn-primary font-weight-bolder Popup "
                            style="margin: 2px;" title="اضافة مسؤول">
                            <span class="svg-icon svg-icon-md">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <circle fill="#000000" cx="9" cy="15" r="6"></circle>
                                        <path
                                            d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                            fill="#000000" opacity="0.3"></path>
                                    </g>
                                </svg>
                            </span>اضافة مسؤول </a>
                    </div>
                </div>

                <div class="card-body">
                    <div id="" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-body p-0">
                                    <table
                                        class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3 text-center"
                                        id="tblAjax">
                                        <thead class="bg-dark text-center">
                                            <tr class="fw-bold text-muted" style="color:#fff!important">
                                                <th class="text-center">#</th>
                                                <th>الاسم</th>
                                                <th>الهاتف</th>
                                                <th>رقم الهوية</th>
                                                <th>الصلاحيات</th>
                                                <th>تاريخ الإنشاء</th>
                                                <th>الصورة</th>
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
    </div>
@endsection

@section('script')
    <script src="{{ asset('backend/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

  <script>
        $(document).ready(function(){
            BindDataTable();

        });
        // $(function () {
        //     BindDataTable();
        // });
        var oTable;


        function BindDataTable() {
            oTable = $('#tblAjax').dataTable({
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
                    { data: 'name', name: 'name' },
                    { data: 'phone', name: 'phone' },
                    { data: 'id_number', name: 'id_number' },
                    { data: 'role', name: 'role' },
                    { data: 'Date', name: 'Date' },
                    { data: 'image', name: 'image', orderable: false, searchable: false },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false, className: 'text-center' },
                ], ajax: {
                    type: "POST",
                    contentType: "application/json",
                    url: '/dashboard/admins/AjaxDT',
                    data: function (d) {
                        d._token = "{{ csrf_token() }}";
                        return JSON.stringify(d);
                    },
                }
                
            });
        }
    </script>

@endsection