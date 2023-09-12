@extends('cms.parent')

@section('title')

@endsection

@section('title', 'projects')
@section('page-title', 'Index')
@section('small-title', 'projects Index')

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
        window.location.href = 'http://127.0.0.1:8000/admin/projects'+'#ID'+$id;
        }else{
        window.location.href = 'http://127.0.0.1:8000/admin/projects?page='+$page+'#ID'+$id;
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
                                    <th>description</th>
                                    <th>time first</th>
                                    <td>slug </td>
                                    <td>notes</td>
                                    <td>time function</td>
                                    <td>funds</td>
                                    <th>city</th>
                                    <th>description location</th>
                                    <td>additional file</td>
                                    <th>user</th>
                                    <th>number of offer</th>
                                    <th>worker</th>
                                    <th>profession</th>
                                    <th>number of offers
                                        </br> submitted</th>
                                    <th>Settings</th>

                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($projects as $project)
                                <tr id="ID{{ $project->id }}">
                                    <td>{{ $project->id }}</td>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ $project->description }}</td>
                                    <th>{{ $project->time_first }}</th>
                                    <th>{{ $project->slug }}</th>
                                    <th>{{ $project->notes }}</th>
                                    <th>{{ $project->time_function }}</th>
                                    {{-- <th>{{ $project->additional_file }}</th> --}}
                                    <th>{{ $project->funds }}</th>
                                    <th>{{ $project->city?->name }}</th>
                                    <th>{{ $project->description_location }}</th>
                                    <th>
                                        @if ($project->additional_file)
                                        <a href="{{$project->full_path}}" class="btn btn-primary">open File</a>
                                        @endif

                                    </th>
                                    <th>{{ $project->user?->name }}</th>
                                    <th>{{ $project->offer_count }}</th>

                                    <th>{{ $project->worker?->user?->name }}</th>
                                    <th>{{ $project->profession?->title }}</th>
                                    <th>{{ $project->offer_count }}</th>
                                    {{-- <td>{{ $project->full_path }}</td> --}}
                                    <th>
                                        <div class="col-md-2">
                                            @foreach($project->images as $image)
                                            <a href="{{ $image?->full_path }}" target="_blank"
                                                rel="noopener noreferrer">
                                                <img src="{{ $image?->full_path }}" width="60" alt="nothing project">
                                            </a>
                                            @endforeach
                                        </div>

                                    </th>

                                    {{-- @if ($project->accept)
                                        <span class="badge bg-success">{{$project->check_active}}</span>
                                    @else
                                    <span class="badge bg-danger"> {{$project->check_active}} </span>
                                    @endif
                                    </span>
                                    </td>
                                    @if($project->reject_reason !=null)
                                    <td>{{ $project->reject_reason}}</td>
                                    @else
                                    <td>--</td>
                                    @endif
                                    --}}

                                    <th>
                                        <div class="btn-group">

                                            <form method="POST" action="{{route('project.destroy',$project->slug)}}" ,
                                                id="sub_Delete{{$project->id}}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger delete{{$project->id}}">
                                                    <i class="fas fa-trash-alt"></i>

                                                </button>
                                                <script>
                                                    $('.delete{{$project->id}}').click(function(e){
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
                                                                      $('#sub_Delete{{$project->id}}').submit();
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
                            <div class="hint-text col-10"><b> {{ $projects->count() }}</b> items out of
                                <b>{{ $projects->total() }}</b> in
                                <b>{{ $projects->lastPage() }}</b> pages
                            </div>
                            <!-- 2 items out of 100 in 10 pages -->
                            <div class="col-1" style="border :10px;">
                                {{ $projects->links() }}
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