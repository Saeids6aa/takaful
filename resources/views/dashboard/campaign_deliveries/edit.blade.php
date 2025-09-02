<div class="row">
  <div class="col-sm-12">
    <form method="post" action="{{ route('campaign-deliveries.update', $row->id) }}" class="ajaxForm"
      enctype="multipart/form-data">
      @csrf

      <select name="campaign_id" class="form-control select2" required>
        <option value="">اختر الحملة</option>
        @foreach($campaigns as $c)
          <option value="{{ $c->id }}">{{ $c->title }}</option>
        @endforeach
      </select>

      <select name="familiy_id" class="form-control select2" required>
        <option value="">اختر العائلة</option>
        @foreach($families as $f)
          <option value="{{ $f->id }}">{{ $f->name }}</option>
        @endforeach
      </select>

      <select name="admin_id" class="form-control select2" required>
        <option value="">اختر المسؤول</option>
        @foreach($admins as $a)
          <option value="{{ $a->id }}" {{ auth()->id() == $a->id ? 'selected' : '' }}>
            {{ $a->name }}
          </option>
        @endforeach
      </select>


      <div class="form-group row">
        <label class="col-3 col-form-label">الصورة :</label>
        <div class="col-8">
          <input class="form-control" name="image" id="image" type="file" accept="image/*">
          @if($row->image)
            <div class="mt-2">
              <img src="{{ asset('uploads/campaign_deliveries/' . $row->image) }}"
                style="width:80px;height:80px;border-radius:8px;object-fit:cover" />
            </div>
          @endif
        </div>
      </div>

      <div class="form-group row">
        <label class="col-3 col-form-label">الوصف :</label>
        <div class="col-8">
          <textarea class="form-control" name="description" id="description" rows="3">{{ $row->description }}</textarea>
        </div>
      </div>

      <div class="col-sm-8 offset-sm-4 pt-4">
        <button type="submit" data-refresh="true" class="btn btn-primary">تحديث</button>
        <a class="btn btn-default" data-bs-dismiss="modal">إلغاء</a>
      </div>
    </form>
  </div>
</div>

<script> PageLoadMethods(); </script>