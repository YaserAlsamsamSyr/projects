@csrf
<div class="mb-3">
  <label for="title">عنوان المشروع</label>
  <input type="text" class="form-control border border-primary rounded" id="title" name="title" value="{{  $pro->title  }}" >
  @error('title')
        <div class="text-danger">
             <small>{{ $message }}</small>
        </div>
  @enderror
</div>

<div class="mb-3">
  <label for="description">وصف المشروع</label>
  <textarea  class="form-control border border-primary rounded" id="description" name="description" >{{ $pro->description }}</textarea>
  @error('description')
  <div class="text-danger">
       <small>{{ $message }}</small>
  </div>
@enderror
 </div>