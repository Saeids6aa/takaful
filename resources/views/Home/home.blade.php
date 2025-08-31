<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <title>الصفحة الرئيسية | تكافل</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{-- Metronic / Bootstrap CSS (عدّل المسارات حسب مشروعك) --}}
  <link rel="stylesheet" href="{{ asset('backend/assets/plugins/global/plugins.bundle.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/css/style.bundle.css') }}">

  <style>
    body { background: #f5f8fa; }
    .hero-card { overflow: hidden; }
    .btn-lg { padding-left: 2rem; padding-right: 2rem; }
    .mh-350px { max-height: 350px; }
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
                  نظام إدارة التبرعات، المخيمات، الأسر، والعطاءات — مرن، سريع، ومبني على Android application + Metronic + Laravel.
                </p>

                <div class="d-flex flex-wrap gap-3">
                  {{-- تسجيل الدخول --}}
            <a href="javascript:void(0)"
   class="btn btn-primary btn-lg px-8 fw-bolder"
   data-bs-toggle="modal" data-bs-target="#loginModal">
  تسجيل الدخول
</a>

                  {{-- الشكاوي (مودال) --}}
                  <a href="javascript:void(0)" class="btn btn-light-primary btn-lg px-8 fw-bolder"
                     data-bs-toggle="modal" data-bs-target="#complaintModal">
                    الشكاوي
                  </a>
                </div>
              </div>

              {{-- صورة جانبية --}}
              <div class="text-center mt-10 mt-lg-0">
                <img class="mw-100 mh-350px"
                     src="{{ asset('backend/assets/media/illustrations/sketchy-1/7.png') }}"
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
                <span class="svg-icon svg-icon-2tx me-4 text-primary">
                  <i class="la la-donate fs-2x"></i>
                </span>
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
                <span class="svg-icon svg-icon-2tx me-4 text-success">
                  <i class="la la-users fs-2x"></i>
                </span>
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
                <span class="svg-icon svg-icon-2tx me-4 text-info">
                  <i class="la la-chart-bar fs-2x"></i>
                </span>
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
  <div class="modal fade" id="complaintModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">إرسال شكوى</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
        </div>

        <div class="modal-body">
          <form method="post" action="" class="ajaxForm" enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
              <label for="full_name" class="col-3 col-form-label">الاسم الكامل :</label>
              <div class="col-8">
                <input class="form-control" name="full_name" id="full_name" type="text" autocomplete="off">
              </div>
            </div>

            <div class="form-group row mt-3">
              <label for="phone" class="col-3 col-form-label">الهاتف :</label>
              <div class="col-8">
                <input class="form-control" name="phone" id="phone" type="text" autocomplete="off">
              </div>
            </div>

            <div class="form-group row mt-3">
              <label for="subject" class="col-3 col-form-label">الموضوع :</label>
              <div class="col-8">
                <input class="form-control" name="subject" id="subject" type="text" autocomplete="off">
              </div>
            </div>

            <div class="form-group row mt-3">
              <label for="message" class="col-3 col-form-label">نص الشكوى :</label>
              <div class="col-8">
                <textarea class="form-control" name="message" id="message" rows="4"></textarea>
              </div>
            </div>

            <div class="form-group row mt-3">
              <label for="file" class="col-3 col-form-label">مرفق (اختياري) :</label>
              <div class="col-8">
                <input class="form-control" name="file" id="file" type="file">
              </div>
            </div>

            <div class="col-sm-8 offset-sm-4 pt-4">
              <button type="submit" data-refresh="false" class="btn btn-primary">إرسال</button>
              <a class="btn btn-light" data-bs-dismiss="modal">إلغاء</a>
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
        <form method="post"
              action="{{ Route::has('login') ? route('login') : '' }}"
              class="ajaxForm" autocomplete="off">
          @csrf

          <div class="form-group mb-3">
            <label class="form-label">البريد الإلكتروني / اسم المستخدم</label>
            <input type="text" name="email" class="form-control" placeholder="example@mail.com" required>
          </div>

          <div class="form-group mb-3">
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
            <button type="submit" data-refresh="false" class="btn btn-primary">
              دخول
            </button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

  {{-- Core JS --}}
  <script src="{{ asset('backend/assets/plugins/global/plugins.bundle.js') }}"></script>
  <script src="{{ asset('backend/assets/js/scripts.bundle.js') }}"></script>

  {{-- jQuery + jquery.form (لو مش مضمّن داخل plugins.bundle) --}}
  <script src="{{ asset('backend/assets/js/jquery/jquery-3.6.0.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/jquery.form.min.js') }}"></script>

  <script>
    // لو عندك PageLoadMethods جاهزة بالمشروع، فعّلها:
    if (typeof PageLoadMethods === 'function') {
      PageLoadMethods();
    } else {
      // هاندلر بسيط للـ ajaxForm إذا PageLoadMethods غير متوفرة
      $('.ajaxForm').ajaxForm({
        beforeSubmit: function(formData, $form){ $form.find(':submit').prop('disabled', true); },
        success: function(json, status, xhr, $form){
          $form.find(':submit').prop('disabled', false);
          if (json?.status == 1) {
            alert(json.msg || 'تم الإرسال بنجاح');
            // إغلاق المودال إن وجد
            const modal = document.getElementById('complaintModal');
            if (modal) bootstrap.Modal.getInstance(modal)?.hide();
            $form.resetForm();
          } else {
            alert(json?.msg || 'حدث خطأ!');
          }
        },
        error: function(xhr, status, err){
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
    }
  </script>
  
</body>
</html>
