@extends('cms.parent')

@section('title')

@endsection

@section('title', 'cities')
@section('page-title', 'Edit cities')

@section('small-title', 'cities')

@section('content')

<!-- Main content -->
<section class="content">
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
        swal("Faild to add new city", {
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
                        <h3 class="card-title">Edit City</h3>
                    </div>

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{ route('cities.update',[$city->id])}}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">name</label>
                                <input type="text" class="form-control" id="title" name="name" placeholder="Enter Name"
                                    value="{{ $city->name }}">
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

<script>

</script>
@endsection
@section('script')

@endsection

{{--  --}}