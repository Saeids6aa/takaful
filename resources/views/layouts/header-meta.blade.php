 <base href="">
 <title>@yield('bar-title')</title>
 <meta name="description"
     content="" />
 <meta name="keywords"
     content="" />
 <meta name="viewport" content="width=device-width, initial-scale=1" />
 <meta charset="utf-8" />
 <meta property="og:locale" content="en_US" />
 <meta property="og:type" content="article" />
 {{-- <meta property="og:title"
      content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
  <meta property="og:url" content="https://keenthemes.com/metronic" />
  <meta property="og:site_name" content="Keenthemes | Metronic" />
  <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
 <link rel="shortcut icon" href="assets/media/logos/favicon.ico" /> --}}

 <link href="{{ asset('backend/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
     type="text/css" />

 <link rel="stylesheet" href="{{ asset('backend/assets/plugins/global/plugins.bundle.rtl.css') }}" />

 <link rel="stylesheet" href="{{ asset('backend/assets/css/style.bundle.rtl.css') }}" />


 <link rel="stylesheet" href="{{ asset('backend/fonts/familyTajawal.css') }}" />
 {{-- <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet"> --}}
  

 <link rel="stylesheet" href="{{ asset('backend/assets/plugins/custom/datatables/datatables.bundle.rtl.css') }}">
 
<link rel="stylesheet" href="{{ asset('backend/assets/css/select2.min.css') }}">
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
 
 <style>
     body,
     html {
         font-family: 'Tajawal', sans-serif !important;
     }
 </style>

    <style>
        #tblAjax th,
        #tblAjax td {
            white-space: nowrap;
        }

        #tblAjax th,
        #tblAjax td {
            font-size: 15px;
        }

        .breadcrumb {
    margin: 0 !important;   /* يشيل المسافة فوق وتحت */
    padding: 0 !important;  /* يشيل الفراغ الداخلي */
}

.breadcrumb-item {
    margin: 0 !important;   /* يشيل المسافة بين العناصر */
    padding: 0 2px !important; /* يترك فراغ صغير فقط */
}

    </style>
 
