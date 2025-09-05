<div class="modal-body p-4">

  <div class="mb-4">
    <h4 class="fw-bold mb-2">{{ $family->name }}</h4>
    @if($family->status === 'approved')
        <span class="badge badge-light-success">نشطة</span>
    @elseif($family->status === 'rejected')
        <span class="badge badge-light-danger">غير نشطة</span>
    @elseif($family->status === 'pending')
          <span class="badge badge-light-info">{{ $family->status }}</span>

    @endif
  </div>

  <div class="separator my-3"></div>

  <div class="row g-4">
    <div class="col-md-6">
      <div class="fw-semibold text-gray-600 mb-1">الهاتف</div>
      <div class="fs-6">{{ $family->phone }}</div>
    </div>

    <div class="col-md-6">
      <div class="fw-semibold text-gray-600 mb-1">رقم الهوية</div>
      <div class="fs-6">{{ $family->id_number }}</div>
    </div>

    <div class="col-md-6">
      <div class="fw-semibold text-gray-600 mb-1">عدد أفراد الأسرة</div>
      <div class="fs-6">{{ $family->family_member }}</div>
    </div>

    <div class="col-md-6">
      <div class="fw-semibold text-gray-600 mb-1">العنوان</div>
      <div class="fs-6">{{ $family->address }}</div>
    </div>

    <div class="col-md-6">
