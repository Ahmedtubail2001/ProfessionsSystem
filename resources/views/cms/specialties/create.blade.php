@extends('cms.parent')

@section('title')

@endsection

@section('title', 'Specialties')
@section('page-title', 'Create Specialties')

@section('small-title', 'Specialties')

@section('content')

<!-- Main content -->
<section class="content">
    @if (session()->has('stat'))
    @if (session('stat'))
    <script>
        $(document).ready(function() {
                        swal({
                            icon: "success",
                            text: "Adding a new specialty has been completed successfully!"
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
                    <form method="POST" action="{{ route('specialities.store') }}">
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


                            <div class="form-check">
                                <input type="checkbox" name="active" class="form-check-input" id="active" value="1">
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


@endsection

@section('script')

@endsection