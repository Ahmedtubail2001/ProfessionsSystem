@extends('cms.parent')

@section('title')

@endsection

@section('title', 'city')
@section('page-title', 'Index')
@section('small-title', 'city Index')

@section('content')
<section class="content">
    <div class="container-fluid">
        @if (session()->has('statusEdit'))
        @if (session('statusEdit'))
        <script>
            $(document).ready(function() {
                                swal({
                                    icon: "success",
                                    text: "the Edit Process is success \n Do you want to go back Edit row ?"
                                }).then(function name(params) {
                                    $id = '{{session("id")}}';
                                    $page ='{{session("pageNumber")}}';
                                    
                                    if ($page == 0) {
                              window.location.href = 'http://127.0.0.1:8000/admin/cities'+'#ID'+$id;
                                    }else{
                              window.location.href = 'http://127.0.0.1:8000/admin/cities?page='+$page+'#ID'+$id;
                                    }
                                // $('html, body').animate({ scrollTop: offset }, 'slow'); 
                                    // myElement = document.getElementById('#ID'+$id);
                                    // myElement.style.backgroundColor = 'red';
                                    // setTimeout(() => {
                                    //     myElement.style.backgroundColor = 'red';
                                    // }, 30000);
                                }
                                 
                                )
                            });
        </script>
        @else
        <script>
            swal("Faild to add new cities", {
                                className: "red-bg",
                            });
        </script>
        @endif
        @endif
        <!-- /.row -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">

                        </h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right"
                                    placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover table-bordered table-striped text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>name</th>
                                    <th>Create At</th>
                                    <th>Updated At</th>
                                    <th>Settings</th>

                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($cities as $city)

                                <tr id='ID{{ $city->id }}'>

                                    <td>{{ $city->id }}</td>
                                    <td>{{ $city->name }}</td>

                                    <td>{{ $city->created_at }}</td>
                                    <td>{{ $city->updated_at }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('cities.edit',$city->id)}}" class="btn btn-info">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{route('cities.destroy',$city->id)}}" ,
                                                id="sub_Delete{{$city->id}}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger delete{{$city->id}}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                <script>
                                                    // swal library use for ask user are soure for make delete process
                                                    $('.delete{{$city->id}}').click(function(e){
                                                          e.preventDefault()
                                                               let confirm =swal("Are you sure delete this record ?", {
                                                               dangerMode: true,
                                                                    buttons: {
                                                                      cancel: "cancel",
                                                                       ok: {
                                                                       text: "ok",
                                                                       value: "ok",
                                                                         },
                                                                        },  }).then(function(e){
                                                                     if(e == "ok"){
                                                                      $('#sub_Delete{{$city->id}}').submit();
                                                                   }
                                                               });
                                                        });
                                                </script>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="container">
                        <hr>
                        <div class="row">
                            <div class="hint-text col-10"><b> {{ $cities->count() }}</b> items out of
                                <b>{{ $cities->total() }}</b> in
                                <b>{{ $cities->lastPage() }}</b> pages
                            </div>
                            <!-- 2 items out of 100 in 10 pages -->
                            <div class="col-1" style="border :10px;">
                                {{ $cities->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    <script>
        // إعطاء منظر جمالي بعد عملية التعديل على البيانات الموجودة في الجدول 
        const hashParams = new URLSearchParams(window.location.hash.slice(1));
                        const sectionId = hashParams.get('section');
                        let IDHash = hashParams+"";
                        let ID =IDHash.replace('=','')+"";
                        const myElement = document.getElementById(ID);
                        myElement.style.backgroundColor = '#A9A9A9';               
                  $(document).ready(function(){
                    $('#'+ID).animate({
                       backgroundColor: '#A9A9A9',
                        opacity: "toggle"
                  }, 700, "swing" ,function(){
                $('#'+ID).animate({backgroundColor: '#ffffff',
                opacity: "toggle"},700);
                })
                 });
                        setTimeout(() => {
                        myElement.style.backgroundColor = '';
                        }, 3000 );


                    
    </script>
</section>
@endsection

@section('script')


@endsection