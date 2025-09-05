<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <title>صفحة تسجيل الدخول | تكافل</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{-- Metronic / Bootstrap --}}
  <link rel="stylesheet" href="{{ asset('backend/assets/plugins/global/plugins.bundle.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/css/style.bundle.css') }}">

  <style>
  
  
  
  /* لوحة الألوان من الشعار */
    :root{
      --brand-primary:#1E6B77; --brand-primary-rgb:30,107,119;
      --brand-success:#2E7D4F; --brand-success-rgb:46,125,79;
      --brand-warning:#F2A500; --brand-warning-rgb:242,165,0;
      --brand-info:#2FA6B1;    --brand-info-rgb:47,166,177;
      --brand-ink:#0E3742; --brand-muted:#6B7280;
      --brand-surface:#f5f8fa; --brand-hero:#eef7f9;
    }
    :root{
      --bs-primary:var(--brand-primary);
      --bs-primary-rgb:var(--brand-primary-rgb);
      --bs-body-color:var(--brand-ink);
      --bs-body-bg:var(--brand-surface);
    }
    body{ background:var(--brand-surface); }

    /* ===== Navbar ===== */
    .brand-navbar{
      background: rgba(255,255,255,.92);
      backdrop-filter: blur(6px);
      border-bottom: 1px solid rgba(var(--brand-primary-rgb),.08);
    }
    .brand-navbar .app-name{
      font-weight: 900; letter-spacing:.2px; color: var(--brand-primary);
    }
    .brand-navbar .tagline{
      color: var(--brand-muted); font-size: .9rem;
    }
    .brand-logo{
      height: 44px; width:auto; object-fit:contain; filter:saturate(1.05) contrast(1.03);
    }

    /* ===== Login Card ===== */
    .auth-wrap{ min-height: calc(100vh - 74px); display:flex; align-items:center; }
    .auth-card{
      background:#fff; border:0; border-radius:18px;
      box-shadow:0 18px 40px rgba(0,0,0,.06);
    }
    .muted{ color:var(--brand-muted); }
    .btn{ border-radius:12px; font-weight:800; }
    .btn-primary{ background:var(--brand-primary); border-color:var(--brand-primary); }
    .btn-primary:hover{ background:#16545D; border-color:#16545D; }
    .form-control{ padding:.95rem 1rem; }

    /* خلفية خفيفة خلف الكارد (إحساس الهيرو) */
    .hero-bg{
      background: linear-gradient(135deg, var(--brand-hero) 0%, #eaf3f5 100%);
      border-radius: 22px;
      box-shadow: 0 18px 40px rgba(0,0,0,.06);
    }

    /* زر إظهار كلمة المرور */
    .btn-eye{
      position:absolute; inset-inline-start:.6rem; top:50%; transform:translateY(-50%);
    }
  </style>
</head>
<body class="app-blank">

  <nav class="navbar brand-navbar">
    <div class="container-xxl d-flex align-items-center justify-content-between py-3">
      <div class="d-flex align-items-center gap-3">
        <img class="brand-logo" src="{{ asset('backend/assets/local_data/logo/Logo_tkafuul.png') }}" alt="Takaful App">
        <div class="d-flex flex-column">
          <span class="app-name fs-4">تكافل</span>
          <span class="tagline">Takaful App</span>
        </div>
      </div>

      <div class="d-none d-md-flex align-items-center gap-3"> 
          <a href="{{ route('home') }}" class="btn btn-light btn-sm">الصفحة الرئيسية</a>
       
      </div>
    </div>
  </nav>

  {{-- MAIN --}}

<main class="container-xxl auth-wrap py-0">
  <div class="row w-100 g-10 justify-content-center">
    <div class="col-xl-7 col-lg-9 col-md-10">
              <div class="p-5 p-md-7 hero-bg"> 
        <div class="card auth-card p-6 p-md-8"> 

            <div>
              <h3 class="fw-black mb-2">تسجيل الدخول</h3>
              <p class="muted mb-6">ادخل بريدك وكلمة المرور للوصول إلى اللوحة.</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
              @csrf

              {{-- البريد --}}
              <div class="mb-4">
                <label for="email" class="form-label fw-bold">البريد الإلكتروني</label>
                <input id="email" type="email" name="email" value=""
                       class="form-control" required autofocus>
              </div> 
              

              {{-- كلمة المرور --}}
              <div class="mb-3">
                <div class="d-flex align-items-center justify-content-between">
                  <label for="password" class="form-label fw-bold mb-0">كلمة المرور</label>
                 
                </div>
                <div class="position-relative">
                  <input id="password" type="password" name="password"
                         class="form-control" required>
                  <button type="button" class="btn btn-sm btn-light btn-eye" onclick="togglePass()" aria-label="إظهار/إخفاء">
                    <i class="la la-eye"></i>
                  </button>
                </div>
             </div> 
              </div>

</div>
              <button type="submit" class="btn btn-primary w-100 btn-lg">دخول</button>

              <div class="text-center muted mt-5">© {{ date('Y') }} تكافل — جميع الحقوق محفوظة</div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>


  <script>
    function togglePass(){
      const i = document.getElementById('password');
      i.type = i.type === 'password' ? 'text' : 'password';
    }
  </script>
</body>
</html>
