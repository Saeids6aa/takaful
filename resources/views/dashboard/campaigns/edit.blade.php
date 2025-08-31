<div class="row">
    <div class="col-sm-12">
<form method="POST" action="{{ route('categories.update', $category->id) }}" class="ajaxForm">
            {{ csrf_field() }}
  {{-- لو بتحب تعتمد PUT بدل POST غيّر قيمة _method لـ PUT وعدّل الروت --}}
            <input type="hidden" name="_method" value="POST">

            <div class="form-group row">
                <label for="title" class="col-3 col-form-label">العنوان:</label>
                <div class="col-8">
                    <input class="form-control" id="title" name="title" type="text"
                           value="{{ $campaign->title }}" autocomplete="off">
                </div>
            </div>

            <div class="form-group row">
                <label for="category_id" class="col-3 col-form-label">الفئة:</label>
                <div class="col-8">
                    <select class="form-control" id="category_id" name="category_id">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $campaign->category_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="admin_id" class="col-3 col-form-label">المسؤول:</label>
                <div class="col-8">
                    <select class="form-control" id="admin_id" name="admin_id">
                        @foreach($admins as $adm)
                            <option value="{{ $adm->id }}" {{ $campaign->admin_id == $adm->id ? 'selected' : '' }}>
                                {{ $adm->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-3 col-form-label">الوصف:</label>
                <div class="col-8">
                    <textarea class="form-control" id="description" name="description" rows="3">{{ $campaign->description }}</textarea>
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