@extends('cms.parent')

@section('title')

@endsection

@section('title', 'Professional')
@section('page-title', 'Create Professional')

@section('small-title', 'Professional')

@section('content')

<!-- Main content -->
<section class="content">
    @if (session()->has('status'))
    @if (session('status'))
    <script>
        $(document).ready(function() {
                        swal({
                            icon: "success",
                            text: "Adding a new professional has been completed successfully!"
                        })
                    });
    </script>
    @else
    <script>
        swal("Faild to add new professional row", {
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
                        <h3 class="card-title">Create Professional</h3>
                    </div>

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{ route('professional.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Enter Title">
                                @error('title')
                                <div class="col-sm-3">
                                    <small id="passwordHelp" class="text-danger">
                                        {{ $message }}
                                    </small>
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="title">description</label>
                                <input type="text" class="form-control" id="title" name="description"
                                    placeholder="Enter description">
                                @error('description')
                                <div class="col-sm-3">
                                    <small id="passwordHelp" class="text-danger">
                                        {{ $message }}
                                    </small>
                                </div>
                                @enderror
                            </div>



                            {{-- <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Enter Title">
                            </div> --}}



                            <div class="form-group">
                                <label>specialty</label>
                                <select class="form-control select2" style="width: 100%;" name="specialtie_id">
                                    @foreach($specialty as $specialties)
                                    <option value="{{$specialties->id}}">{{$specialties->title}}</option>
                                    @endforeach
                                </select>
                                @error('specialtie_id')
                                <div class="col-sm-3">
                                    <small id="passwordHelp" class="text-danger">
                                        {{ $message }}
                                    </small>
                                </div>
                                @enderror
                            </div>


                            <div class="form-check">
                                <input type="checkbox" name="allow_register" class="form-check-input"
                                    id="allow_register" value="1">
                                <label class="form-check-label" for="allow_register">Active</label>
                                @error('allow_register')
                                <div class="col-sm-3">
                                    <small id="passwordHelp" class="text-danger">
                                        {{ $message }}
                                    </small>
                                </div>
                                @enderror
                            </div>
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
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->


@endsection

@section('script')

@endsection