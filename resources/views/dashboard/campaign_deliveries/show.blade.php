<div class="modal-body p-4">

  <div class="mb-4">
    <h4 class="fw-bold mb-2">{{ $delivery->family_name }}</h4>

    @if($delivery->status === 'completed')
        <span class="badge badge-light-success">مكتمل</span>
    @elseif($delivery->status === 'incomplete')
        <span class="badge badge-light-danger">غير مكتمل</span>
    @else
        <span class="badge badge-light-secondary">{{ $delivery->status }}</span>
    @endif
  </div>

  <div class="separator my-3"></div>

  <div class="row g-4">
    <div class="col-md-6">
      <div class="fw-semibold text-gray-600 mb-1">اسم الحملة </div>
      <div class="fs-6">{{ $delivery->campaign_title }}</div>
    </div>

   

    <div class="col-md-6">
      <div class="fw-semibold text-gray-600 mb-1">تم التسليم بواسطة</div>
      <div class="fs-6">{{ $delivery->admin_name }}</div>
    </div>

    <div class="col-md-6">
      <div class="fw-semibold text-gray-600 mb-1">ملاحظات التسليم </div>
      <div class="fs-6">  {{  $delivery->description ?: '— لا يوجد وصف —' }}</div>
    </div>

    <div class="col-md-12">
      <div class="fw-semibold text-gray-600 mb-1">الصورة</div>
      <div class="mt-2">
        @if($delivery->image)
          <img src="{{ asset($delivery->image) }}" alt="صورة التسليم"
               style="max-width:100%;height:auto;border-radius:8px;object-fit:cover">
        @else
          <span class="text-muted">لا توجد صورة</span>
        @endif
      </div>
    </div>
  </div>
</div>

<div class="modal-footer">
  <button type="button" class="btn btn-light" data-bs-dismiss="modal">إغلاق</button>
</div>
