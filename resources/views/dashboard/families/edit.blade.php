<div class="row">
  <div class="col-sm-12">
    <form method="post" action="{{ route('families.update', $family->id) }}" class="ajaxForm">
      @csrf
      <input type="hidden" name="_method" value="POST">

      <div class="form-group row">
        <label for="name" class="col-3 col-form-label">الاسم :</label>
        <div class="col-8">
          <input class="form-control" name="name" id="name" type="text" value="{{ $family->name }}">
        </div>
      </div>
<br>
      <div class="form-group row">
        <label for="address" class="col-3 col-form-label">العنوان :</label>
        <div class="col-8">
          <input class="form-control" name="address" id="address" type="text" value="{{ $family->address }}">
        </div>
      </div>
<br>

      <div class="form-group row">
        <label for="id_number" class="col-3 col-form-label">رقم الهوية :</label>
        <div class="col-8">
          <input class="form-control" name="id_number" id="id_number" type="text" value="{{ $family->id_number }}">
        </div>
      </div>
<br>
      <div class="form-group row">
        <label for="family_member" class="col-3 col-form-label">عدد الأفراد :</label>
        <div class="col-8">
          <input class="form-control" name="family_member" id="family_member" type="number" value="{{ $family->family_member }}">
        </div>
      </div>
<br>
     <div class="form-group row">
  <label for="camp_id" class="col-3 col-form-label">المخيم :</label>
  <div class="col-8">
    <select class="form-select" name="camp_id" id="camp_id" data-placeholder="اختر المخيم">
      @foreach($camps as $camp)
        <option value="{{ $camp->id }}" {{ $family->camp_id == $camp->id ? 'selected' : '' }}>
          {{ $camp->name }}
        </option>
      @endforeach
    </select>
  </div>
</div>


      <div class="col-sm-8 offset-sm-4 pt-4">
        <button type="submit" data-refresh="true" class="btn btn-primary">تحديث</button>
        <a class="btn btn-default" data-bs-dismiss="modal">إلغاء</a>
      </div>
    </form>
  </div>
</div>

<script>
PageLoadMethods();
</script>
