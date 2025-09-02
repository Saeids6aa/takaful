<div class="row">
    <div class="col-sm-12">
        <form method="POST" action="{{ route('campaigns.update', $campaign->id) }}" class="ajaxForm">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="POST">

            <div class="form-group row">
                <label for="title" class="col-3 col-form-label">اسم الحملة:</label>
                <div class="col-8">
                    <input class="form-control" id="title" name="title" type="text" value="{{ $campaign->title }}"
                        autocomplete="off">
                </div>
            </div>
            <br>


            <div class="form-group row">
                <label for="title" class="col-3 col-form-label">الكمية المتاحة حاليآ :</label>
                <div class="col-8">
                    <input class="form-control" id="quantity" name="quantity" type="number" autocomplete="off"
                        value="{{$campaign->quantity}}" readonly disabled>
                        
                </div>
            </div>

            <div class="form-group row">
                <label for="title" class="col-3 col-form-label">الكمية الجديدة  :</label>
                <div class="col-8">
                    <br>
                        <input class="form-control" id="quantity" name="quantity" type="number" autocomplete="off" >
                </div>
            </div>
            <br>


            <div class="form-group row">
                <label for="category_id" class="col-3 col-form-label">الفئة:</label>
                <div class="col-8">
                    <select class="form-control" id="category_id" name="category_id">
                        <option disabled selected>اختيار الفئة المراد توزيعها</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" <?=($cat->id === $campaign->category_id) ? 'selected' : '' ?>>
                                {{--
                            <option value="{{ $cat->id }}" {{($cat->id === $campaign->category_id) ? 'selected' : '' }}>
                                --}}
                                {{ $cat->name }}
                            </option>

                        @endforeach
                    </select>
                </div>
            </div>


            <div class="form-group row">
                <div class="col-12" id="category_quantity_container">
                    <!-- القيمة رح تنعرض هنا -->
                </div>
            </div>
            <br>
            <div class="form-group row">
                <label for="camp_id" class="col-3 col-form-label">المخيم:</label>
                <div class="col-8">
                    <select class="form-control" id="camp_id" name="camp_id">
                        <option disabled selected>المخيم</option>
                        @foreach($camps as $camp)
                            <option value="{{ $camp->id }}" {{$camp->id === $campaign->camp_id ? 'selected' : ""}}>
                                {{ $camp->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <br>

    <div class="form-group row">
        <label for="description" class="col-3 col-form-label">الوصف:</label>
        <div class="col-8">
            <textarea class="form-control" id="description" name="description"
                rows="3">{{ $campaign->description }}</textarea>
        </div>
    </div>

    <div class="col-sm-8 offset-sm-4 pt-4">
        <button type="submit" data-refresh="true" class="btn btn-primary">حفظ</button>
        <a class="btn btn-default" data-bs-dismiss="modal">إلغاء</a>
    </div>
    </form>
</div>
</div>
</div>

<script>
    PageLoadMethods();

    $(document).ready(function () {
        $(document).on('change', '#category_id', function () {
            var category_id = $(this).val();
            if (!category_id) {
                $('#category_quantity_container').html('');

            }
            $.ajax({
                url: '/dashboard/campaigns/category_quantity/' + category_id,
                method: 'GET',
                success: function (response) {
                    $('#category_quantity_container').html('');

                    if (response.status) {
                        var html = `
            <div class="  pb-4 text-center">
          <small id="category_quantity_hint" class="form-text text-muted">
           <strong> الكمية المتبقي لهذه الفئة : ${response.total}</strong>
          </small>
          </div>
        `;
                        $('#category_quantity_container').append(html);
                    } else {
                        var html = `
            <div class="  pb-4 text-center">
          
          <small id="category_quantity_hint" class="form-text text-danger">
            لا يوجد رصيد لهذه الفئة حالياً.
          </small>
          </div>

        `;
                        $('#category_quantity_container').append(html);
                    }
                },
                error: function () {
                    $('#category_quantity_container').html(`
                    <div class="  pb-4 text-center">

        <small id="category_quantity_hint" class="form-text text-danger">
          تعذر جلب الرصيد.
        </small>
          </div>

      `);
                }
            });
        });
    });



</script>