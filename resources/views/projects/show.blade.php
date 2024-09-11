@extends('layouts.app')

@section('title','تفاصيل المشروع')

@section('content')
<header class="d-flex justify-content-between align-items-center my-5" dir="rtl">
    <div class="h6 text-dark">
            
       <a href="/project">المشاريع / {{ $pro->title }}</a>

    </div>
    <div>

       <a href="/project/{{ $pro->id }}/edit" class="btn btn-primary px-4" role="button">تعديل المشروع</a>

    </div>

 </header>
<section class="row text-right" dir="rtl">
      <div class="col-lg-4">
        {{-- project details --}}
        <div class="card text-right border border-primary rounded">
            <div class="card-body">
                   <div class="status">
                         @switch($pro->status)
                             @case(1)
                                 <span class="text-success">مكتمل</span>
                             @break
                         
                             @case(2)
                                 <span class="text-danger">ملغي</span>
                             @break
                         
                             @default
                                 <span class="text-warning">قيد الانجاز</span>
                         @endswitch
                         <h5 class="font-weight-bold card-title">
                                   <a href="/project/{{ $pro->id }}">{{ $pro->title }}</a>
                         </h5>
                         <div class="card-text mt-4">
                                  {{ $pro->description }}
                         </div>

                   </div>
            </div>
            
            @include('projects.footer')
        </div>

        <div class="card mt-4 border border-primary rounded">
            <div class="card-body">
                <h5 class="font-weight-bold">تغير حالة المشروع</h5>
                <form action="/project/{{ $pro->id }}" method="POST">
                 @csrf
                 @method('PATCH')
                    <select name="status" class="custom-select w-100" onchange="this.form.submit()">
                        <option value="0" {{ ($pro->status==0)? 'selected':"" }} >قيد الانجاز</option>
                        <option value="1" {{ ($pro->status==1)? 'selected':"" }} >مكتمل</option>
                        <option value="2" {{ ($pro->status==2)? 'selected':"" }} >ملغي</option>
                    </select>
                    
                </form>
            </div>
        </div>
        {{--  --}}
      </div>

      <div class="col-lg-8">
        {{-- tasks --}}
        @foreach($pro->tasks as $tas)
             <div class="card d-flex flex-row justify-content-between mt-3 p-4 align-items-center border border-primary rounded" style="padding-left:10px;padding-right:10px;">
                <div class={{ $tas->done ? 'checked' :'' }}>
                    {{ $tas->body }}
                </div>
                <div class="d-flex flex-row">
                <div class="ml-auto">
                    <form action="/project/{{ $pro->id }}/tasks/{{ $tas->id }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="checkbox" name="done" {{ $tas->done ? 'checked' :'' }} onchange="this.form.submit()">
                    </form>
                </div>
                <div>&nbsp;&nbsp;</div>
                  {{-- delete task --}}
                <div class="d-flex align-items-center">
                    <form action="/project/{{ $tas->project_id }}/tasks/{{ $tas->id }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="submit" value='' class="btn-delete m"/>
                    </form>
             </div>
            </div>
             </div>
        @endforeach
        <div class="card mt-4">
            <form action="/project/{{ $pro->id }}/tasks" method="POST" class="d-flex p-3">
               @csrf
               <input type="text" name="body" class="form-control p-2 ml-2 border-1" placeholder="اضف مهمة جديدة">
               <button type="submit" class="btn btn-primary">إضافة</button>
            </form>
        </div>
        {{--  --}}
      </div>
</section>

@endsection