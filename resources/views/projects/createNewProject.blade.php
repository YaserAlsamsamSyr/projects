@extends('layouts.app')

@section('title','أنشاء مشروع جديد')

@section('content')
    <div class="row justify-content-center text-right">
        <div class="col-8">
          <div class="card p-5">
            <h3 class="text-center pb-5 font-weight-bold">
                     مشروع جديد
            </h3>

            <form action="/project" method="POST" dir="rtl">
                    @include('projects.form',['pro'=>new App\Models\Project()])
                  <div class="form-group d-flex flex-row-reverse">
                    <button type="submit" class="btn btn-primary">إنشاء</button>
                    <a href="/project" class="btn btn-light">الغاء</a>
                  </div>
            </form>
          </div>
        </div>
    </div>
@endsection