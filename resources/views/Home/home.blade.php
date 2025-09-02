<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="utf-8">
  <title>الصفحة الرئيسية | تكافل</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{-- Metronic / Bootstrap --}}
  <link rel="stylesheet" href="{{ asset('backend/assets/plugins/global/plugins.bundle.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/css/style.bundle.css') }}">

  <style>
    body {
      background: #f5f8fa
    }

    .hero-card {
      overflow: hidden
    }

    .btn-lg {
      padding-left: 2rem;
      padding-right: 2rem
    }

    .mh-350px {
      max-height: 350px
    }
  </style>
</head>

<body class="app-blank">

  <div class="d-flex flex-column flex-root">
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
      <div class="container-xxl py-10">

        {{-- HERO --}}
        <div class="card bg-light-primary border-0 mb-10 hero-card">
          <div class="card-body p-10 p-lg-15">
            <div class="d-flex flex-column flex-lg-row align-items-center">
              <div class="flex-lg-row-fluid me-lg-10">
                <h1 class="fw-bolder mb-7" style="line-height:1.2">
                  أهلاً بك في <span class="text-primary">لوحة تكافل</span>
                </h1>
                <p class="fs-5 text-gray-700 mb-10">
                  نظام إدارة التبرعات، المخيمات، الأسر، والعطاءات — مرن وسريع ومبني على Metronic + Laravel.
                </p>
                <div class="d-flex flex-wrap gap-3">
                  <a href="javascript:void(0)" class="btn btn-light-primary btn-lg px-8 fw-bolder" data-bs-toggle="modal"
                    data-bs-target="#loginModal">
                    تسجيل الدخول
                  </a>

                  <a href="javascript:void(0)" class="btn btn-light-success btn-lg px-8 fw-bolder"
                    data-bs-toggle="modal" data-bs-target="#addFamilyModal">
                    تسجيل أسرة
                  </a>
                
                
                   <a href="{{ route('home.complain') }}" class="btn btn-light-warning btn-lg px-8 fw-bolder" data-bs-toggle="modal"
                data-bs-target="#complaintModal">
                الشكاوي
              </a></div>
              </div>

           


              <div class="text-center mt-10 mt-lg-0">
                <img class="mw-100 mh-350px" src="{{ asset('backend/assets/media/illustrations/sketchy-1/7.png') }}"
                  alt="Welcome">
              </div>
            </div>
          </div>
        </div>

        {{-- Features --}}
        <div class="row g-6 g-xl-9">
          <div class="col-md-4">
            <div class="card card-xl-stretch shadow-sm h-100">
              <div class="card-body d-flex align-items-start">
                <span class="svg-icon svg-icon-2tx me-4 text-primary"><i class="la la-donate fs-2x"></i></span>
                <div>
                  <div class="fw-bolder fs-4 mb-2">إدارة التبرعات</div>
                  <div class="text-gray-600">تنظيم الفئات، التبرعات، والمتبرعين بكل سهولة.</div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-xl-stretch shadow-sm h-100">
              <div class="card-body d-flex align-items-start">
                <span class="svg-icon svg-icon-2tx me-4 text-success"><i class="la la-users fs-2x"></i></span>
                <div>
                  <div class="fw-bolder fs-4 mb-2">إدارة المستفيدين</div>
                  <div class="text-gray-600">ملفات الأسر، المخيمات، والمتابعة الميدانية الذكية.</div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-xl-stretch shadow-sm h-100">
              <div class="card-body d-flex align-items-start">
                <span class="svg-icon svg-icon-2tx me-4 text-info"><i class="la la-chart-bar fs-2x"></i></span>
                <div>
                  <div class="fw-bolder fs-4 mb-2">تقارير ولوحات متابعة</div>
                  <div class="text-gray-600">إحصاءات تفاعلية تساعدك على اتخاذ القرار بسرعة.</div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>{{-- /container --}}
    </div>
  </div>

  {{-- Complaint Modal --}}

  {{-- Add Family Modal --}}
  <div class="modal fade" id="addFamilyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">تسجيل بيانات العائلة</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
        </div>
        <div class="modal-body">
          <form method="post" action="{{ route('families.store') }}" class="ajaxForm">
            @csrf
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">الاسم</label>
                <input class="form-control" name="name" placeholder="اسم رب الأسرة" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">العنوان</label>
                <input class="form-control" name="address" placeholder="المدينة / المخيم / الشارع" required>
              </div>
              <input type="hidden" name="status" value="pending">

              <div class="col-md-6">
                <label class="form-label">رقم الهوية</label>
                <input class="form-control" name="id_number" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">عدد الأفراد</label>
                <input type="number" class="form-control" name="family_member" min="1" required>
              </div>
              <div class="col-md-6">
                <label for="phone" class="col-3 col-form-label">الهاتف :</label>
                <input class="form-control" name="phone" id="phone" type="text" autocomplete="off">
              </div>
              <div class="col-md-6">
                <label class="form-label">المخيم</label>
                <select class="form-select select2" name="camp_id" id="camp_id" required>
                  <option value="">اختر المخيم</option>
                  @foreach($camps ?? [] as $camp)
                    <option value="{{ $camp->id }}">{{ $camp->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="d-flex justify-content-end gap-2 mt-4">
              <button type="submit" data-refresh="true" class="btn btn-primary">حفظ</button>
              <button type="button" class="btn btn-light" data-bs-dismiss="modal">إلغاء</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  {{-- Login Modal --}}
  <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">تسجيل الدخول</h5>
          <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="إغلاق"></button>
        </div>
        <div class="modal-body">
          <form method="post" action="{{ Route::has('login') ? route('login') : '' }}" class="ajaxForm"
            autocomplete="off">
            @csrf
            <div class="mb-3">
              <label class="form-label">البريد الإلكتروني / اسم المستخدم</label>
              <input type="text" name="email" class="form-control" placeholder="example@mail.com" required>
            </div>
            <div class="mb-3">
              <label class="form-label">كلمة المرور</label>
              <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-3">
              <label class="form-check form-check-sm">
                <input class="form-check-input" type="checkbox" name="remember">
                <span class="form-check-label">تذكرني</span>
              </label>
              <a class="text-primary small" href="javascript:void(0)">نسيت كلمة المرور؟</a>
            </div>
            <div class="d-grid">
              <button type="submit" data-refresh="false" class="btn btn-primary">دخول</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  {{-- Core JS (يتضمن jQuery/Bootstrap) --}}
  <script src="{{ asset('backend/assets/plugins/global/plugins.bundle.js') }}"></script>
  <script src="{{ asset('backend/assets/js/scripts.bundle.js') }}"></script>

  {{-- jquery.form فقط (لا تعيد تضمين jQuery نفسه) --}}
  <script src="{{ asset('backend/assets/js/jquery.form.min.js') }}"></script>

  <script>
    // Ajax handler موحد
    $('.ajaxForm').ajaxForm({
      beforeSubmit: function (arr, $form) { $form.find(':submit').prop('disabled', true); },
      success: function (json, status, xhr, $form) {
        $form.find(':submit').prop('disabled', false);
        if (json?.status == 1) {
          // رسائل حسب نظامك (toastr/alert)
          // toastr.success(json.msg || 'تم بنجاح');
          $form.resetForm();
          // أغلق أي مودال يحتوي هذا الفورم
          const modalEl = $form.closest('.modal').get(0);
          if (modalEl) bootstrap.Modal.getInstance(modalEl)?.hide();
        } else {
          alert(json?.msg || 'حدث خطأ!');
        }
      },
      error: function (xhr, status, err) {
        $('.ajaxForm :submit').prop('disabled', false);
        let msg = 'حدث خطأ غير متوقع!';
        if (xhr.status === 422 && xhr.responseJSON?.errors) {
          msg = Object.values(xhr.responseJSON.errors).map(e => e[0]).join('\n');
        } else if (xhr.responseJSON?.message) {
          msg = xhr.responseJSON.message;
        }
        alert(msg);
      }
    });

    // فعّل Select2 داخل مودال "تسجيل أسرة"
    const addFamilyModal = document.getElementById('addFamilyModal');
    addFamilyModal.addEventListener('shown.bs.modal', function () {
      $('#camp_id').select2({
        dropdownParent: $('#addFamilyModal'),
        width: '100%',
        dir: 'rtl',
        placeholder: 'اختر المخيم',
        allowClear: true
      });
    });
    // لو اتقفل المودال، دمّر Select2 لتفادي مضاعفة التهيئة
    addFamilyModal.addEventListener('hidden.bs.modal', function () {
      const $sel = $('#camp_id');
      if ($sel.hasClass('select2-hidden-accessible')) { $sel.select2('destroy'); }
    });
  </script>

</body>

</html>