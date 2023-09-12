@extends('cms.parent')

@section('title')

@endsection

@section('title', 'permissions')
@section('page-title', 'Index')
@section('small-title', 'permission Index')

@section('content')
<section class="content">
    <div class="container-fluid">
        {{-- @if (session()->has('statusEdit'))
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
        window.location.href = 'http://127.0.0.1:8000/admin/professional'+'#ID'+$id;
        }else{
        window.location.href = 'http://127.0.0.1:8000/admin/professional?page='+$page+'#ID'+$id;
        }



        }

        )
        });
        </script>
        @else
        <script>
            swal("Faild to add new profession ! ", {
                                        className: "red-bg",
                                    });
        </script>
        @endif
        @endif --}}
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
                                    <th>guard name</th>
                                    <th>Create At</th>
                                    <th>Updated At</th>
                                    <th>Settings</th>

                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($permissions as $permission)
                                <tr id="ID{{ $permission->id }}">
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>

                                    <td>{{ $permission->guard_name}}</td>
                                    <td>{{ $permission->created_at }}</td>
                                    <td>{{ $permission->updated_at }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('permission.edit',$permission->id)}}" class="btn btn-info">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            {{-- action="{{route('permissions.destroy',$permission->id)}}" --}}

                                            <button type="button" id="deleteDel"
                                                class="btn btn-danger delete{{$permission->id}}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <script>
                                                $('.delete{{$permission->id}}').click(function(e){
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
                                                                 // $('#sub_Delete{{$permission->id}}').submit();
                                                                    deleteDel({{$permission->id}});
                                                                   }
                                                               });
                                                            });
                                            </script>

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
                            <div class="hint-text col-10"><b> {{ $permissions->count() }}</b> items out of
                                <b>{{ $permissions->total() }}</b> in
                                <b>{{ $permissions->lastPage() }}</b> pages
                            </div>
                            <!-- 2 items out of 100 in 10 pages -->
                            <div class="col-1" style="border :10px;">
                                {{ $permissions->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <script>
        function deleteDel(id){
    
    fetch(`https://phplaravel-1025967-3619615.cloudwaysapps.com/admin/permission/delete/${id}` ).then(data => {
data.json().then(response =>{
             
        if (status == 404) {
           swal({
                icon: "error",
                text: response.message
            })
        }else{ 
         $(document).ready(function() {
            swal({ 
                icon: "success",
                text: response.message
                
            }).then(function(){
               location.reload();
           });
        });
        } 

});
   
    
    })
    
    .catch(error => {
    console.log("Error1:", error);
    });
   }

        // const hashParams = new URLSearchParams(window.location.hash.slice(1));
        //                         const sectionId = hashParams.get('section');
        //                         let IDHash = hashParams+"";
        //                         let ID =IDHash.replace('=','')+"";
        //                         const myElement = document.getElementById(ID);
        //                          myElement.style.backgroundColor = '#A9A9A9';  
                              
                             
        //                             $('#'+ID).animate({
        //                                 backgroundColor: '#A9A9A9',
        //                                 opacity: "toggle"
        //                             }, 700, "swing" ,function(){
        //                            $('#'+ID).animate({backgroundColor: '#ffffff',
        //                              opacity: "toggle"},700);
        //                            });
                                
        //                         setTimeout(() => {
        //                         myElement.style.backgroundColor = '';
        //                         }, 3000 );
                                
                            
    </script>
    <!-- /.container-fluid -->
</section>
@endsection

@section('script')


@endsection