@extends('cms.parent')

@section('title')

@endsection

@section('title', 'Specialties')
@section('page-title', 'Edit Specialties')

@section('small-title', 'Specialties')

@section('content')

<!-- Main content -->
<section class="content">
    <script>
        $(document).ready(function () {
                $("#active").click(function(){
                        
                        if($('#active').attr(checked) == true){
                            $('#active').prop('checked', false)
                        alert('checked .............')
                        } else if($('#active').attr(checked) == false){
                        alert('Unchecked .............')
                        $('#active').prop('checked', true)
                        }
                        
                        })
            });
    </script>
    @if (session()->has('status'))
    @if (session('status'))
    <script>
        $(document).ready(function() {
                        swal({
                            icon: "success",
                            text: "the Edit Process is success"
                        })

                    
                    });
    </script>
    @else
    <script>
        swal("Faild to add new specialty", {
                        className: "red-bg",
                    });
    </script>
    @endif
    @endif
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create Specialties</h3>
                    </div>

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{ route('specialities.update',[$specialty->id])}}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Enter Title" value="{{ $specialty->title }}">
                                @error('title')
                                <div class="col-sm-3">
                                    <small id="passwordHelp" class="text-danger">
                                        {{ $message }}
                                    </small>
                                </div>
                                @enderror
                            </div>


                            <div class="form-check">
                                <input type="checkbox" name="" id="active" checked="true">
                                {{-- <input type="checkbox" name="active" class="form-check-input" id="active"
                                    checked="true" /> --}}
                                <label class="form-check-label" for="active">Active</label>
                            </div>
                            @error('active')
                            <div class="col-sm-3">
                                <small id="passwordHelp" class="text-danger">
                                    {{ $message }}
                                </small>
                            </div>
                            @enderror
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Store</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<script>
    // if ({{$specialty->active}} ==1) {
        
    //   } else {
        
    //   }
    // function check() {
    //      const checkbox = document.querySelector('#active');
    //      checkbox.check = !checkbox.check
    // }
    // $('#active').
</script>
@endsection
@section('script')

@endsection

{{--  --}}