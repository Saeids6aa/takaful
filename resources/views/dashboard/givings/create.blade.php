<div class="row">
  <div class="col-sm-12">
    <form method="post" action="{{ route('givings.store') }}" class="ajaxForm">
      @csrf

      <div class="form-group row">
        <label for="name" class="col-3 col-form-label">الاسم :</label>
        <div class="col-8">
          <input class="form-control" name="name" id="name" type="text">
        </div>
      </div>
      <br>
      <div class="form-group row">
        <label for="quantity" class="col-3 col-form-label">الكمية :</label>
        <div class="col-8">
          <input class="form-control" name="quantity" id="quantity" type="number">
        </div>
      </div>
      <br>

      <div class="form-group row">
        <label for="category_id" class="col-3 col-form-label">الفئة :</label>
        <div class="col-8">
          <select class="form-control" name="category_id" id="category_id">
            <option disabled selected>الفئة</option>
            @foreach($categories as $cat)
              <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <br>

      <div class="form-group row">
        <label for="doner_id" class="col-3 col-form-label">المتبرع :</label>
        <div class="col-8">
          <select class="form-control" name="doner_id" id="doner_id">
            <option disabled selected>المتبرع</option>
            @foreach($doners as $d)
              <option value="{{ $d->id }}">{{ $d->name }}</option>
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