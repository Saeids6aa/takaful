<script>
    var hostUrl = "assets/";
</script>

<script src="{{ asset('backend/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('backend/assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="{{ asset('backend/assets/js/custom/widgets.js') }}"></script>
<script src="{{ asset('backend/assets/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ asset('backend/assets/js/custom/modals/create-app.js') }}"></script>
<script src="{{ asset('backend/assets/js/custom/modals/upgrade-plan.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/nprogress-master/nprogress.js') }}"></script>
<script src="{{ asset('backend/assets/js/jquery/select2.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/jquery/jquery.form.min.js') }}"></script>

<script>
    NProgress.start();
    window.addEventListener('load', function() { NProgress.done(); });
    $(document).ajaxStart(function() { NProgress.start(); });
    $(document).ajaxStop(function() { NProgress.done(); });
    $(document).ajaxError(function() { NProgress.done(); });

    $(function () {
       $('.select2').select2()

        $(document).on("click", ".ConfirmLink", function() {
            var id = $(this).attr("data-id");
            var name = $(this).attr("data-name");
            var item = this;
            Swal.fire({
                title: 'هل انت متأكد ؟',
                text: "هل انت متاكد من الحذف " + name + " ؟",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonText: 'الغاء',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم , احذف'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: $(item).attr('href'),
                        method: 'get',
                        success: function(response) {
                            if (response.status == 1) {
                                ShowMessage(response.msg, "success", "تكافل");
                            } else {
                                ShowMessage(response.msg, "error", "تكافل");
                            }
                            BindDataTable?.();
                        }
                    })
                }
            });
            return false;
        });

        $(document).on("click", ".Popup", function() {
            $("#Popup .modal-body").html("<h1 class='text-center'><i style='font-size:50px;' class='fa fa-spinner fa-spin'></i></h1>");
            $("#Popup .modal-title").text($(this).attr("title"));
            $("#Popup .modal-body").load($(this).attr("href"), function() {
            
            });
            $("#Popup").modal("show");
            return false;
        });

        PageLoadMethods();

        $(".DTForm").submit(function() {
            BindDataTable?.();
            return false;
        });

        if ($('#tblAjax').length > 0) {
            $("#Confirm .btn-danger").click(function() {
                $.get($("#Confirm .btn-danger").attr("href"), function(json) {
                    if (json.status == 1) {
                        ShowMessage(json.msg, "success", "تكافل");
                    } else {
                        ShowMessage(json.msg, "error", "تكافل");
                    }
                    BindDataTable?.();
                });
                $("#Confirm").modal("hide");
                return false;
            });
        }
    });

    function PageLoadMethods() {
        handleAjaxForm(".ajaxForm");
        handleAjaxForm(".ajaxFormss");

        function handleAjaxForm(selector) {
            $(selector).ajaxForm({
                beforeSubmit: function () {
                    $(`${selector} :submit`).prop("disabled", true);
                },
                success: function (json) {
                    $(`${selector} :submit`).prop("disabled", false);
                    if (json.status == 1) {
                        $(selector).resetForm();
                        ShowMessage(json.msg, "success", "تكافل");
                        if (json.redirect != null) {
                            setTimeout(function () { window.location = json.redirect; }, 800);
                        }
                        if (json.close != null) {
                            $("#Popup").modal("hide");
                        }
                        if ($(`${selector} :submit`).data("refresh") === true) {
                            $("#Popup").modal("hide");
                            BindDataTable?.();
                        }
                    } else {
                        ShowMessage(json.msg, "error", "تكافل");
                    }
                },
                error: function (xhr) {
                    $(`${selector} :submit`).prop("disabled", false);
                    let errorsHtml = "<ul>";
                    if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                        $.each(xhr.responseJSON.errors, function (key, messages) {
                            errorsHtml += `<li>${messages[0]}</li>`;
                        });
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorsHtml += `<li>${xhr.responseJSON.message}</li>`;
                    } else {
                        errorsHtml += `<li>حدث خطأ غير متوقع!</li>`;
                    }
                    errorsHtml += "</ul>";
                    ShowMessage(errorsHtml, "error", "تكافل");
                }
            });
        }
    }

    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "timeOut": "5000"
    };

    function ShowMessage(msg, type = "success", title = "") {
        toastr[type](msg, title);
    }

    var KTAppSettings = {
        "breakpoints": {"sm":576,"md":768,"lg":992,"xl":1200,"xxl":1200},
        "colors": {
            "theme": {
                "base": {"white":"#ffffff","primary":"#3699FF","secondary":"#E5EAEE","success":"#1BC5BD","info":"#8950FC","warning":"#FFA800","danger":"#F64E60","light":"#F3F6F9","dark":"#212121"},
                "light": {"white":"#ffffff","primary":"#E1F0FF","secondary":"#ECF0F3","success":"#C9F7F5","info":"#EEE5FF","warning":"#FFF4DE","danger":"#FFE2E5","light":"#F3F6F9","dark":"#D6D6E0"},
                "inverse": {"white":"#ffffff","primary":"#ffffff","secondary":"#212121","success":"#ffffff","info":"#ffffff","warning":"#ffffff","danger":"#ffffff","light":"#464E5F","dark":"#ffffff"}
            },
            "gray": {"gray-100":"#F3F6F9","gray-200":"#ECF0F3","gray-300":"#E5EAEE","gray-400":"#D6D6E0","gray-500":"#B5B5C3","gray-600":"#80808F","gray-700":"#464E5F","gray-800":"#1B283F","gray-900":"#212121"}
        },
        "font-family": "Poppins"
    };
</script>

<div id="Popup" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog w-20" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <div class="row col-sm-12 modal-title font-weight-bold h3"></div>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

@yield('js')
