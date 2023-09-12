@extends('cms.parent')

@section('title')

@endsection

@section('title', 'workers')
@section('page-title', 'Index')
@section('small-title', 'workers Index')

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
        window.location.href = 'http://127.0.0.1:8000/admin/workers'+'#ID'+$id;
        }else{
        window.location.href = 'http://127.0.0.1:8000/admin/workers?page='+$page+'#ID'+$id;
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
                                    <th>email</th>
                                    <th>professional experience</th>
                                    <th>image</th>
                                    <th>ID number</th>
                                    <td>address</td>
                                    <td>experience year</td>
                                    <td>profession </td>
                                    <td>phone number</td>
                                    <td>slug </td>
                                    <th>CV</th>

                                    <th>Settings</th>

                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($workers as $worker)
                                <tr id="ID{{ $worker->id }}">
                                    <td>{{ $worker->id }}</td>
                                    <td>{{ $worker->user?->name }}</td>
                                    <td>{{ $worker->user?->email }}</td>
                                    <td>{{ $worker->professional_experience }}</td>
                                    <th>
                                        <a href="{{ $worker->path_image}}" target="_blank" rel="noopener noreferrer">
                                            <img src="{{ $worker->path_image}}" width="80" alt="nothing image">
                                        </a>
                                    </th>
                                    <th>{{ $worker->id_number }}</th>
                                    <th>{{ $worker->address }}</th>
                                    <th>{{ $worker->experience_year }}</th>
                                    <th>{{ $worker->profession?->title }}</th>
                                    <th>{{ $worker->phone_number }}</th>
                                    <th>{{ $worker->slug }}</th>
                                    <th>
                                        @if ($worker->path_file)
                                        <a href="{{$worker->path_file}}" target="_blank" class="btn btn-primary">open
                                            File</a>
                                        @endif

                                    </th>

                                    {{-- @if ($worker->accept)
                                        <span class="badge bg-success">{{$worker->check_active}}</span>
                                    @else
                                    <span class="badge bg-danger"> {{$worker->check_active}} </span>
                                    @endif
                                    </span>
                                    </td>
                                    @if($worker->reject_reason !=null)
                                    <td>{{ $worker->reject_reason}}</td>
                                    @else
                                    <td>--</td>
                                    @endif
                                    --}}

                                    <th>
                                        <div class="btn-group">

                                            <form method="POST" action="{{route('worker.destroy',$worker->slug)}}" ,
                                                id="sub_Delete{{$worker->id}}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger delete{{$worker->id}}">
                                                    <i class="fas fa-trash-alt"></i>

                                                </button>
                                                <script>
                                                    $('.delete{{$worker->id}}').click(function(e){
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
                                                                      $('#sub_Delete{{$worker->id}}').submit();
                                                                   }
                                                               });
                                        
                                                        });
                                                </script>
                                            </form>
                                        </div>
                                    </th>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="container">
                        <hr>
                        <div class="row">
                            <div class="hint-text col-10"><b> {{ $workers->count() }}</b> items out of
                                <b>{{ $workers->total() }}</b> in
                                <b>{{ $workers->lastPage() }}</b> pages
                            </div>
                            <!-- 2 items out of 100 in 10 pages -->
                            <div class="col-1" style="border :10px;">
                                {{ $workers->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <script>
        const hashParams = new URLSearchParams(window.location.hash.slice(1));
                                const sectionId = hashParams.get('section');
                                let IDHash = hashParams+"";
                                let ID =IDHash.replace('=','')+"";
                                const myElement = document.getElementById(ID);
                                 myElement.style.backgroundColor = '#A9A9A9';  
                              
                             
                                    $('#'+ID).animate({
                                        backgroundColor: '#A9A9A9',
                                        opacity: "toggle"
                                    }, 700, "swing" ,function(){
                                   $('#'+ID).animate({backgroundColor: '#ffffff',
                                     opacity: "toggle"},700);
                                   });
                                
                                setTimeout(() => {
                                myElement.style.backgroundColor = '';
                                }, 3000 );
                                
                            
    </script>
    <!-- /.container-fluid -->
</section>
@endsection

@section('script')


@endsection