@extends('cms.parent')

@section('title')

@endsection

@section('title', 'images')
@section('page-title', 'Index')
@section('small-title', 'images Index')

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
                                                window.location.href = 'http://127.0.0.1:8000/admin/images'+'#ID'+$id;
                                            }else{
                                                window.location.href = 'http://127.0.0.1:8000/admin/images?page='+$page+'#ID'+$id;
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
                                    <th>image</th>
                                    <th>accept</th>
                                    <th>rejection reason</th>
                                    <td>imageable id</td>
                                    <td>imageable type</td>
                                    <td>slug</td>
                                    <th>Create At</th>
                                    <th>Updated At</th>
                                    <th>Settings</th>

                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($images as $image)
                                <tr id="ID{{ $image->id }}">
                                    <td>{{ $image->id }}</td>
                                    {{-- <td>{{ $image->full_path }}</td> --}}
                                    <td>
                                        <a href="{{ $image->full_path }}" target="_blank" rel="noopener noreferrer">
                                            <img src="{{ $image->full_path }}" width="60" alt="nothing image">
                                        </a>

                                    </td>
                                    <td>
                                        @if ($image->accept)
                                        <span class="badge bg-success">{{$image->check_active}}</span>
                                        @else
                                        <span class="badge bg-danger"> {{$image->check_active}} </span>
                                        @endif
                                        </span>
                                    </td>
                                    @if($image->reject_reason !=null)
                                    <td>{{ $image->reject_reason}}</td>
                                    @else
                                    <td>--</td>
                                    @endif

                                    <td>{{ $image->imageable_id }}</td>
                                    <td>{{ $image->imageable_type }}</td>
                                    <td>{{ $image->slug }}</td>
                                    <td>{{ $image->created_at }}</td>
                                    <td>{{ $image->updated_at }}</td>
                                    <td>
                                        <div class="btn-group">

                                            <form method="POST" action="{{route('images.destroy',$image->slug)}}" ,
                                                id="sub_Delete{{$image->id}}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger delete{{$image->id}}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                <script>
                                                    $('.delete{{$image->id}}').click(function(e){
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
                                                                      $('#sub_Delete{{$image->id}}').submit();
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
                            <div class="hint-text col-10"><b> {{ $images->count() }}</b> items out of
                                <b>{{ $images->total() }}</b> in
                                <b>{{ $images->lastPage() }}</b> pages
                            </div>
                            <!-- 2 items out of 100 in 10 pages -->
                            <div class="col-1" style="border :10px;">
                                {{ $images->links() }}
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