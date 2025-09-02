<div class="row">
  <div class="col-sm-12">
    <form method="POST" action="{{ route('families.store') }}" class="ajaxForm" autocomplete="off">
      @csrf

      <input type="hidden" name="status" value="pending">

      <div class="row g-4">
        <div class="col-md-6">
          <label class="form-label fw-bold"> الاسم</label>
          <input type="text" name="name" class="form-control form-control-solid" placeholder="اسم رب الأسرة"
            minlength="3" maxlength="255">
        </div>

        <div class="col-md-6">
          <label class="form-label fw-bold"> العنوان</label>
          <input type="text" name="address" class="form-control form-control-solid"
            placeholder="المدينة / المخيم / الشارع" minlength="3" maxlength="255">
        </div>

        <div class="col-md-6">
          <label class="form-label fw-bold"> رقم الهوية</label>
          <input type="text" name="id_number" class="form-control form-control-solid" placeholder="401234567"
            inputmode="numeric" maxlength="20">
        </div>

        <div class="col-md-6">
          <label class="form-label fw-bold"> عدد الأفراد</label>
          <input type="number" name="family_member" class="form-control form-control-solid" min="1" step="1"
            placeholder="1">
        </div>

        <div class="col-md-6">
          <label class="form-label fw-bold"> الهاتف</label>
          <input type="tel" name="phone" class="form-control form-control-solid" placeholder="05XXXXXXXX"
            maxlength="20">
        </div>

        <div class="col-md-6">
          <label class="form-label fw-bold"> المخيم</label>
          <select name="camp_id" id="camp_id" class="form-select form-select-solid "
            data-placeholder="اختر المخيم">
            <option value="">اختر المخيم</option>
            @foreach($camps as $camp)
              <option value="{{ $camp->id }}">{{ $camp->name }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="d-flex justify-content-end gap-3 mt-5">
        <button type="submit" data-refresh="true" class="btn btn-primary px-6"> حفظ</button>
        <button type="button" class="btn btn-light px-6" data-bs-dismiss="modal">إلغاء</button>
      </div>
    </form>
  </div>
</div>
</script>

<script>

  PageLoadMethods();
  // $('.select2').select2({

  // });
</script>