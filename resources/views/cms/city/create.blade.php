@extends('cms.parent')

@section('title')

@endsection

@section('title', 'Cities')
@section('page-title', 'Create Cities')

@section('small-title', 'Cities')

@section('content')

<!-- Main content -->
<section class="content">
    @if (session()->has('status'))
    @if (session('status'))
    <script>
        $(document).ready(function() {
                        swal({
                            icon: "success",
                            text: "Adding a new City has been completed successfully!"
                        })
                    });
    </script>
    @else
    <script>
        swal("Faild to add new City", {
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
                        <h3 class="card-title">Create Cities</h3>
                    </div>

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{ route('cities.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                                @error('name')
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
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->


@endsection

@section('script')

@endsection