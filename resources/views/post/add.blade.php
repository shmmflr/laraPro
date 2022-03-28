@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12">
          <a href="{{route('posts.index')}}" class="btn btn-info">
          لیست مقالات
          </a>
        </div>
        <div class="col-md-8">
          <form method="POST" action="{{route('posts.store')}}">
            @csrf
            <div class="row">
              <div class="col">
                <label>عنوان</label>
                <input type="text" name="title" class="form-control" placeholder="عنوان مقاله">
                @error('title')
                  <p class="text-danger">{{$message}}</p>
                @enderror
              </div>
            </div>
            <div class="row mt-3">
              <div class="col">
                <label>متن</label>
              <textarea class="form-control" name='body' placeholder="متن . . ."></textarea>
              @error('body')
              <p class="text-danger">{{$message}}</p>
            @enderror
              </div>
            </div>
            <button class="btn btn-success mt-3" type="submit">ارسال</button>
          </form>
        </div>
    </div>
   
</div>

@endsection
@section('js')
<script>
@if(Session::has('err'))
Swal.fire({
  icon: 'error',
  title: 'شرمنده',
  title: "{{ session('err') }}"
})
 @endif
@if(Session::has('msg'))
Swal.fire({
  icon: 'success',
  title: 'موفق',
  title: "{{ session('msg') }}"
})
 @endif
</script>

<script>
    function delPost(event,id){
             event.preventDefault();
                     Swal.fire({
                     title: 'ایا مطمئن هستید این کار را میخواهید حذف کنید؟',
                     icon: 'warning',
                     showCancelButton: true,
                     confirmButtonColor: 'rgb(221, 51, 51)',
                     cancelButtonColor: 'rgb(48, 133, 214)',
                     confirmButtonText: 'بله حذف کن!',
                     cancelButtonText: 'کنسل'
                     }).then((result) => {
                         console.log(result);
                     if (result.isConfirmed) {
                         document.getElementById(`destroy-post-${id}`).submit()
                     }
                     })
                     }
 
     </script>




@endsection
