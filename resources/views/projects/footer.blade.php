<div class="card-footer bg-transparent" dir="rtl">
    <div class="d-flex justify-content-between">
              <div class="d-flex align-items-center">
                        <img src="/images/clock.svg" alt=""/>
                        <div class="mr-2">
                            {{ $pro->created_at->diffForHumans() }}
                        </div>
              </div>
              <div class="d-flex align-items-center">
                        <img src="/images/listcheck.svg" alt=""/>
                        <div class="mr-2">
                                   {{ count($pro->tasks) }}
                        </div>
              </div>
              <div class="d-flex align-items-center mr-auto">
                     <form action="/project/{{ $pro->id }}" method="POST">
                         @method('DELETE')
                         @csrf
                         <input type="submit" value='' class="btn-delete"/>
                     </form>
              </div>
    </div>
</div>