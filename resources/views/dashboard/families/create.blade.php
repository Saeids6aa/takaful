<div class="row">
  <div class="col-sm-12">
    <form method="post" action="{{ route('families.store') }}" class="ajaxForm">
      @csrf

      <div class="form-group row">
        <label for="name" class="col-3 col-form-label">الاسم :</label>
        <div class="col-8">
          <input class="form-control" name="name" id="name" type="text">
        </div>
      </div>

      <div class="form-group row">
        <label for="address" class="col-3 col-form-label">العنوان :</label>
        <div class="col-8">
          <input class="form-control" name="address" id="address" type="text">
        </div>
      </div>

      <div class="form-group row">
        <label for="status" class="col-3 col-form-label">الحالة :</label>
        <div class="col-8">
          <input class="form-control" name="status" id="status" type="text">
        </div>
      </div>

      <div class="form-group row">
        <label for="id_number" class="col-3 col-form-label">رقم الهوية :</label>
        <div class="col-8">
          <input class="form-control" name="id_number" id="id_number" type="text">
        </div>
      </div>

      <div class="form-group row">
        <label for="family_member" class="col-3 col-form-label">عدد الأفراد :</label>
        <div class="col-8">
          <input class="form-control" name="family_member" id="family_member" type="number" min="1">
        </div>
      </div>

      <div class="form-group row">
        <label for="camp_id" class="col-3 col-form-label">المخيم :</label>
        <div class="col-8">
          <select class="form-control" name="camp_id" id="camp_id">
            @foreach($camps as $camp)
              <option value="{{ $camp->id }}">{{ $camp->name }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="col-sm-8 offset-sm-4 pt-4">
        <button type="submit" data-refresh="true" class="btn btn-primary">حفظ</button>
        <a class="btn btn-default" data-bs-dismiss="modal">الغاء</a>
      </div>
    </form>
  </div>
</div>

<script>PageLoadMethods();</script>
