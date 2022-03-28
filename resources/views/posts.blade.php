@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>
                لیست پست ها
            </h1>
            <table class="table table-success table-striped">
                <thead>
                    <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">عنوان</th>
                    <th scope="col">متن</th>
                    <th scope="col">نویسنده</th>
                    <th scope="col">تاریخ انتشار</th>
                    <th scope="col"> عملیات</th>
                  </tr>
                </thead>
                <tbody>
                 @foreach ($posts as $key=>$post)
                 <tr class="text-center">
                    <th scope="row">{{++$key}}</th>
                    <td>{{$post->title}}</td>
                    <td>{{$post->body}}</td>
                    <td>{{$post->userName()}}</td>
                    <td>{{$post->created_at}}</td>
                    <td>
                        <i  style="cursor: pointer" class="bi bi-wrench"></i>
                        <a href="{{ route('posts.destroy', $post->id) }}" onclick="delPost(event, {{ $post->id }})"  class="bi bi-trash" ></a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" id="destroy-post-{{ $post->id }}">
                            @csrf
                            @method('delete')
                          </form>
                    </td>
                  </tr>
                 @endforeach
                  
                </tbody>
              </table>
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
  title: 'شرمنده',
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
