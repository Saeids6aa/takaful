@extends('layouts.app')

@section('bar-title')
    الفئات
@endsection

@section('page-title')
    الفئات
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-xxl">
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap py-3">
                    <div class="card-title">
                        <h3 class="card-label">الفئات
                            <span class="d-block text-muted pt-2 font-size-sm">عرض &amp; الفئات</span>
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ route('categories.create') }}" class="btn btn-primary font-weight-bolder Popup "
                            style="margin: 2px;" title="اضافة فئة">
                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
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
                                <!--end::Svg Icon-->
                            </span>اضافة فئة </a>
                    </div>
                </div>

                <div class="card-body">
                    <!--begin: Datatable-->
                    <div id="" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-body p-0">
                                    <table
                                        class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3 text-center"
                                        id="tblAjax">
                                        <thead class="bg-dark text-center">
                                            <tr class="fw-bold text-muted" style="color: white !important">
                                                <th class="text-center">#</th>
                                                <th>الفئة</th>
                                                <th>تاريخ الإضافة</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end: Datatable-->
                </div>
            </div>
        </div>
    </div>
 
@endsection

@section('script')
    <script src="{{ asset('backend/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

     <script>
        $(function() {
            BindDataTable();
        });
        var oTable;
        var oTable;
        function BindDataTable() {
            oTable = $('#tblAjax').dataTable({
                lengthMenu: [5, 10, 25, 50],
                pageLength: 10,

                "paging": true,
                lengthChange: true,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": true,
                "autoWidth": true,
                "responsive": true,
                serverSide: true,
                select: false,
                "bDestroy": true,
                "bSort": true,
                visible: true,
                "iDisplayLength": 10,
                "sPaginationType": "full_numbers",
                "bAutoWidth": false,
                "bStateSave": true,
                "dom": '<"top"i>rt<"bottom"flp><"clear">',
                columnDefs: [{
                    visible: true
                }],
                "order": [
                    [0, "asc"]
                ],
                serverSide: true,
                columns: [

                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },

                    {
                        data: 'Date',
                        name: 'Date'
                    },

                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        serachable: false,
                        sClass: 'text-center'
                    },
                ],
                ajax: {
                    type: "POST",
                    contentType: "application/json",
                    url: '/dashboard/categories/AjaxDT/',
                    data: function(d) {
                        d._token = "{{ csrf_token() }}";
                        return JSON.stringify(d);
                    },
                },

                fnDrawCallback: function() {}
            });
        }
        
    </script>
@endsection
