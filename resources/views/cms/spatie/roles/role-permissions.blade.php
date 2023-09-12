@extends('cms.parent')

@section('title')

@endsection

@section('title', 'Permissions')
@section('page-title', 'Index')
@section('small-title', 'Permissions Index')

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
                                    <th>Assigned</th>

                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($permissions as $permission)
                                <tr id="ID{{ $permission->id }}">
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->guard_name}}</td>
                                    <td>
                                        <div class="checkbox icheck-primary">
                                            <input type="checkbox" id="permission_{{$permission->id}}"
                                                onchange="updatePermission({{$role_id}},{{ $permission->id }})"
                                                @if($permission->assigned ) checked @endif />
                                            <label for="permission_{{$permission->id}}"></label>
                                        </div>
                                    </td>

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
        function updatePermission($roleId , $permissionId){
            
          const data = {
          permission_id : $permissionId
          };
      
         fetch('https://phplaravel-1025967-3619615.cloudwaysapps.com/admin/role/'+$roleId+'/permissions',
         {
        method: 'POST',
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        'Content-Type': 'application/json'
        },
        body: JSON.stringify(data),
        } ).then(response =>{
            console.log(response.status);
            // response.json().then(data=>{
              
            // }
                
            // );
         }).catch(response => {
            console.log("Error : "+ response.error);
         })
         ;
           
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