<div class="row">
    <div class="col-sm-12">
        <form method="post" action="{{ route('families.store') }}" class="ajaxForm" enctype="multipart/form-data">
            {{ csrf_field() }}


           <div class="form-group row">
    <label for="name" class="col-3 col-form-label">الاسم :</label>
    <div class="col-8">
        <input class="form-control" name="name" id="name" type="text" autocomplete="off">
    </div>
</div>

<div class="form-group row">
    <label for="phone" class="col-3 col-form-label">رقم الهاتف :</label>
    <div class="col-8">
        <input class="form-control" name="phone" id="phone" type="text" autocomplete="off">
    </div>
</div>

<div class="form-group row">
    <label for="id_number" class="col-3 col-form-label">رقم الهوية :</label>
    <div class="col-8">
        <input class="form-control" name="id_number" id="id_number" type="text" autocomplete="off">
    </div>
</div>

<div class="form-group row">
    <label for="address" class="col-3 col-form-label">العنوان :</label>
    <div class="col-8">
        <input class="form-control" name="address" id="address" type="text" autocomplete="off">
    </div>
</div>



<div class="form-group row">
    <label for="family_member" class="col-3 col-form-label">عدد أفراد الأسرة :</label>
    <div class="col-8">
        <input class="form-control" name="family_member" id="family_member" type="number" min="1" autocomplete="off">
    </div>
</div>

      <div class="form-group row">
        <label for="camp_id" class="col-3 col-form-label">المخيم:</label>
        <div class="col-8">
          <select class="form-control" id="camp_id" name="camp_id">
            <option disabled selected>أخنر المخيم الخاص بك او اقرب مخيم</option>
            @foreach($camps as $camp)
              <option value="{{ $camp->id }}">{{ $camp->name }}</option>
            @endforeach
          </select>
        </div>
      </div>

<div class="col-sm-8 offset-sm-4 pt-4">
    <button type="submit" data-refresh="true" class="btn green btn-primary">حفظ</button>
    <a class="btn btn-default" data-bs-dismiss="modal">الغاء</a>
</div>

        </form>
    </div>
</div>

<script>
    PageLoadMethods();
</script>