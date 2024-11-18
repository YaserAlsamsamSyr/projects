@extends('layouts.app')
@section('title','ملفي الشخصي')
@section('content')

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card p-5">
            <div class="text-center">
                <img src="{{ asset(auth()->user()->img) }}" alt="" width="82px" height="82px">
                <h3 class="mt-4 font-weight-bold">
                    {{ auth()->user()->name }}
                </h3>
            </div>
            <div class="card-body" dir="rtl">
                <form action="/profile" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="name">الاسم</label>
                        <input type="text" name="name" id="name" class="form-control border border-secondary rounded" value="{{ auth()->user()->name }}" >
                        @error('name')
                             <div class="text-danger">
                                <small>{{ $message }}</small>
                             </div>
                        @enderror
                        <br>
                    </div>
                    <div class="form-group">
                        <label for="email">البريد الالكتروني</label>
                        <input type="email" name="email" id="email" class="form-control border border-secondary rounded" value="{{ auth()->user()->email }}" >
                        @error('email')
                        <div class="text-danger">
                           <small>{{ $message }}</small>
                        </div>
                        @enderror
                        <br>
                    </div>
                    <div class="form-group">
                        <label for="password">كلمة المرور</label>
                        <input type="password" name="password" id="password" class="form-control border border-secondary rounded" >
                        @error('password')
                        <div class="text-danger">
                           <small>{{ $message }}</small>
                        </div>
                        @enderror
                        <br>
                    </div>
                    <div class="form-group">
                        <label for="password-confirmation">تأكيد كلمة المرور</label>
                        <input type="password" name="password_confirmation" id="password-confirmation" class="form-control border border-secondary rounded">
                        @error('password-confirmation')
                        <div class="text-danger">
                           <small>{{ $message }}</small>
                        </div>
                        @enderror
                        <br>
                    </div>

                    <div class="form-group">
                        <label for="img">تغير الصورة الشخصية</label>
                        <div class="custom-file">
                            <input type="file" name="img" id="img" class="custom-file-input border border-secondary rounded">
                            <label for="img" id="img-label" class="custom-file-label text-left" data-browse="استعراض"></label>
                            @error('img')
                            <div class="text-danger">
                               <small>{{ $message }}</small>
                            </div>
                            @enderror
                            <br>
                        </div>
                    </div>
                    <div class="form-group d-flex mt-5 flex-row-reverse">
                        <button type="submit" class="btn btn-primary mr-2">حفظ التعديلات</button>
                        <button type="submit" class="btn btn-light" form="logout">تسجيل الخروج</button>
                    </div>
                </form>
                <form action="/logout" id="logout" method="POST">@csrf</form>
            </div>
        </div>
    </div>
</div>
{{-- <script>
     document.getElementById('image').onchange=uploadOnChange;

     function uploadOnChange(){
        let filename=this.value;
        let lastIndex=filename.lastIndexOf("\\");
        if(lastIndex>=0)
            filename=filename.substring(lastIndex+1);
        document.getElementById('image-label').innerHTML=filename;
     }
</script> --}}
@endsection