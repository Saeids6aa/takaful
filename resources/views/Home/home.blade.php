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
  /* لوحة ألوان من الشعار */
  :root{
    /* الأساسي = أزرق مُخضر (كفّ اليد اليمنى/النص الإنجليزي) */
    --brand-primary: #1E6B77;
    --brand-primary-rgb: 30,107,119;

    /* نجاح = أخضر (الكف اليسار/الدائرة) */
    --brand-success: #2E7D4F;
    --brand-success-rgb: 46,125,79;

    /* تحذير = عنبري (العلبة) */
    --brand-warning: #F2A500;
    --brand-warning-rgb: 242,165,0;

    --brand-info: #2FA6B1;
    --brand-info-rgb: 47,166,177;

    --brand-ink: #0E3742;
    --brand-muted: #6B7280;
    --brand-surface: #f5f8fa;    
    --brand-hero: #eef7f9;   
  }

  /* ربط الألوان المخصصة بمتغيّرات Bootstrap */
  :root{
    --bs-primary: var(--brand-primary);
    --bs-primary-rgb: var(--brand-primary-rgb);

    --bs-success: var(--brand-success);
    --bs-success-rgb: var(--brand-success-rgb);

    --bs-warning: var(--brand-warning);
    --bs-warning-rgb: var(--brand-warning-rgb);

    --bs-info: var(--brand-info);
    --bs-info-rgb: var(--brand-info-rgb);

    --bs-body-color: var(--brand-ink);
    --bs-body-bg: var(--brand-surface);
  }

  body{ background: var(--brand-surface); }

  .hero-card{
    border-radius: 18px;
    box-shadow: 0 12px 32px rgba(0,0,0,.06);
    overflow: hidden;
  }
  .hero-card.bg-light-primary{
    background: linear-gradient(135deg, var(--brand-hero) 0%, #eaf3f5 100%) !important;
  }
  .hero-card .card-body{
    position: relative;
  }
  .hero-card .card-body::before{
    content:"";
    position:absolute; inset-inline-start:-120px; inset-block-end:-140px;
    width:420px; height:420px; border-radius:50%;
    background: radial-gradient(closest-side, rgba(var(--brand-primary-rgb),.10), transparent 70%);
    pointer-events:none;
  }

  h1,h2,h3,h4,h5{ letter-spacing: .1px; }
  .text-primary{ color: var(--bs-primary) !important; }
  .text-gray-700{ color: var(--brand-muted) !important; }

  .btn-lg{ padding-inline:2rem; }
  .btn{ border-radius: 12px; font-weight: 800; }

  .btn-primary{
    background: var(--bs-primary); border-color: var(--bs-primary);
  }
  .btn-primary:hover{ background: #16545D; border-color:#16545D; }

  .btn-light-primary{
    background: rgba(var(--brand-primary-rgb), .1);
    color: var(--bs-primary);
    border: 1px solid rgba(var(--brand-primary-rgb), .15);
  }
  .btn-light-primary:hover{
    background: rgba(var(--brand-primary-rgb), .18);
    color: #0c3a41;
  }

  .btn-light-warning{
    background: rgba(var(--brand-warning-rgb), .12);
    color: #9a6a00;
    border: 1px solid rgba(var(--brand-warning-rgb), .18);
  }
  .btn-light-warning:hover{
    background: rgba(var(--brand-warning-rgb), .2);
    color: #7a5200;
  }

  .card.card-xl-stretch{
    border:0; border-radius: 16px;
    box-shadow: 0 10px 24px rgba(0,0,0,.05);
    transition: transform .2s ease, box-shadow .2s ease;
  }
  .card.card-xl-stretch:hover{
    transform: translateY(-2px);
    box-shadow: 0 16px 36px rgba(0,0,0,.08);
  }

  .text-primary   { color: var(--bs-primary) !important; }
  .text-success   { color: var(--bs-success) !important; }
  .text-info      { color: var(--bs-info) !important; }

  .mw-100.mh-350px{
    filter: saturate(1.05) contrast(1.02);
  }

  .border-0{ border:0 !important; }
  .shadow-sm{ box-shadow: 0 8px 20px rgba(0,0,0,.05) !important; }
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
                  نظام إدارة التبرعات، المخيمات، الأسر، والعطاءات — مرن وسريع 
                </p>
                <div class="d-flex flex-wrap gap-3">
                  <a href="{{route('login')}}" class="btn btn-light-primary btn-lg px-8 fw-bolder">
                    تسجيل الدخول
                  </a>

                
                
                   <a href="" class="btn btn-light-warning btn-lg px-8 fw-bolder" data-bs-toggle="modal"
                data-bs-target="#complaintModal">
                الشكاوي
              </a></div>
              </div>

           


              <div class="text-center mt-10 mt-lg-0">
                <img class="mw-100 mh-350px" src="{{ asset('backend\assets\local_data\logo\Logo_tkafuul.png') }}"
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




</body>

</html>