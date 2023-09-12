@extends('cms.parent')

@section('title')

@endsection

@section('title', 'admin')
@section('page-title', 'Index')
@section('small-title', 'admin Index')

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
                              window.location.href = 'http://127.0.0.1:8000/admin/admins'+'#ID'+$id;
                                    }else{
                              window.location.href = 'http://127.0.0.1:8000/admin/admins?page='+$page+'#ID'+$id;
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
            swal("Faild to add new admins", {
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
                                    <th>email</th>
                                    <th>role name</th>
                                    <th>Create At</th>
                                    <th>Updated At</th>
                                    <th>Settings</th>

                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($admins as $admin)

                                <tr id='ID{{ $admin->id }}'>

                                    <td>{{ $admin->id }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->role_name }}</td>

                                    <td>{{ $admin->created_at }}</td>
                                    <td>{{ $admin->updated_at }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('admins.edit',$admin->id)}}" class="btn btn-info">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{route('admins.destroy',$admin->id)}}" ,
                                                id="sub_Delete{{$admin->id}}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger delete{{$admin->id}}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                <script>
                                                    // swal library use for ask user are soure for make delete process
                                                    $('.delete{{$admin->id}}').click(function(e){
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
                                                                      $('#sub_Delete{{$admin->id}}').submit();
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
                            <div class="hint-text col-10"><b> {{ $admins->count() }}</b> items out of
                                <b>{{ $admins->total() }}</b> in
                                <b>{{ $admins->lastPage() }}</b> pages
                            </div>
                            <!-- 2 items out of 100 in 10 pages -->
                            <div class="col-1" style="border :10px;">
                                {{ $admins->links() }}
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
                        opaadmin: "toggle"
                  }, 700, "swing" ,function(){
                $('#'+ID).animate({backgroundColor: '#ffffff',
                opaadmin: "toggle"},700);
                })
                 });
                        setTimeout(() => {
                        myElement.style.backgroundColor = '';
                        }, 2000 );


                    
    </script>
</section>
@endsection

@section('script')


@endsection