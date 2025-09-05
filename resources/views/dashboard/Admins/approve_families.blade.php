@extends('layouts.app')

@section('bar-title')
    آعتماد العائلة
@endsection

@section('page-title')
    آعتماد العائلة
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-fluid px-1">
            <div class="card card-custom gutter-b">

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
                                                <th>#</th>
                                                <th>الاسم</th>
                                                <th>عدد الأفراد</th>
                                                <th>الحالة </th>
                                                <th>الهاتف </th>
                                                <th>رقم الهوية </th>
                                                <th>العنوان </th>
                                                <th>المخيم</th>
                                                <th>إعتماد الأسرة</th>
                                                <th>رفض الأسرة</th>
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
    {{--
    <script src="{{ asset('backend/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script> --}}

    <script>
        $(document).ready(function () {
            BindDataTable();

        });
        var oTable;

        $(function () {
            $(document).on("click", ".active-btn", function () {
                var id = $(this).data('id');
                Swal.fire({
                    icon: 'تحذير',
                    title: 'هل انت متأكد ؟ ',
                    text: "هل انت واثق من عملية الاعتماد ؟",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonText: 'الغاء',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'اعتمد , Change'
                }).then((result) => {

                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/dashboard/admins/activate-family/' + id,
                            method: 'get',
                            data: {},
                            success: function (response) {
                                ShowMessage(response.msg, "success", "تكافل");
                                BindDataTable();
                            }
                        })

                    }
                })
            });
            BindDataTable();
        });

        $(function () {
            $(document).on("click", ".reject-btn", function () {
                let id = $(this).data('id');
                Swal.fire({
                    icon: 'تحذير',
                    title: 'هل انت متأكد ؟ ',
                    text: "هل انت واثق من عملية الرفض ؟",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonText: 'الغاء',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'رفض , Change'
                }).then((result) => {

                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/dashboard/admins/reject-family/' + id,
                            method: 'get',
                            data: {},
                            success: function (response) {
                                ShowMessage(response.msg, "success", "تكافل");
                                BindDataTable();
                            }
                        })

                    }
                })
            });
            BindDataTable();
        });



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
                    { data: 'family_member', name: 'family_member' },
                    { data: 'status', name: 'status' },
                    { data: 'phone', name: 'phone' },
                    { data: 'id_number', name: 'id_number' },
                    { data: 'address', name: 'address' },
                    { data: 'camp_name', name: 'camp.name', orderable: false, searchable: true },

                    { data: 'change_status', name: 'change_status', orderable: false, searchable: false },
                    { data: 'change_status_to_rejected', name: 'change_status_to_rejected' },

                ], ajax: {
                    method: 'POST',
                    contentType: "application/json",
                    url: '/dashboard/admins/approve-families/AjaxDT',
                    data: function (d) {
                        d._token = "{{ csrf_token() }}";
                        return JSON.stringify(d);
                    },
                }

            });
        }
    </script>

@endsection