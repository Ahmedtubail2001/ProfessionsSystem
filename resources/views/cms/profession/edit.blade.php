@extends('cms.parent')

@section('title')

@endsection

@section('title', 'Profession')
@section('page-title', 'Edit Profession')

@section('small-title', 'Profession')

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
        swal("Faild to add new Profession", {
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
                        <h3 class="card-title">Create Profession</h3>
                    </div>

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{ route('professional.update',[$profession->id])}}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{$profession->title}}" placeholder="Enter Title">
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
                                    placeholder="Enter description" value=" {{$profession->description}}">

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

                                    <option value="{{$specialties->id}}" @if($specialties->id == $spec_id) selected
                                        @endif>{{$specialties->title}}</option>


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
                                    id="allow_register" value="1" @if($profession->allow_register)
                                checked
                                @endif
                                >
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
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->


@endsection

@section('script')

@endsection