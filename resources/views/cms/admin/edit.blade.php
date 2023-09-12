@extends('cms.parent')

@section('title')

@endsection

@section('title', 'Admin')
@section('page-title', 'Edit Admin')

@section('small-title', 'Admin')

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
        swal("Faild to add new Admin", {
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
                        <h3 class="card-title">Edit Admin</h3>
                    </div>

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{ route('admins.update',[$admin->id])}}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" value="{{old('name' ,$admin->name )}}" id="name"
                                    name="name" placeholder="Enter Name">
                                @error('name')
                                <div class="col-sm-3">
                                    <small id="passwordHelp" class="text-danger">
                                        {{ $message }}
                                    </small>
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">email</label>
                                <input type="text" value="{{old('email' , $admin->email)}}" class="form-control"
                                    id="email" name="email" placeholder="Enter Email">
                                @error('email')
                                <div class="col-sm-3">
                                    <small id="passwordHelp" class="text-danger">
                                        {{ $message }}
                                    </small>
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">password</label>
                                <input type="text" value="{{old('password')}}" class="form-control" id="password"
                                    name="password"
                                    placeholder="Enter password  If you want to leave the password as is, leave it blank">
                                @error('password')
                                <div class="col-sm-3">
                                    <small id="passwordHelp" class="text-danger">
                                        {{ $message }}
                                    </small>
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                {{-- <label for="title">Name</label>
                                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name"> --}}
                                <label for="title">type of admin</label>
                                <select name="role_name" id="role_name" class="form-control">
                                    @foreach($type_admin as $type_admins)
                                    <option value="{{$type_admins}}" @selected(old('role_name')==$type_admins)>
                                        {{$type_admins}}</option>
                                    @endforeach
                                </select>
                                @error('role_name')
                                <div class="col-sm-3">
                                    <small id="passwordHelp" class="text-danger">
                                        {{ $message }}
                                    </small>
                                </div>
                                @enderror
                            </div>

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