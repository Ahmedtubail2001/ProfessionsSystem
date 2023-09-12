@extends('cms.parent')

@section('title')
{{-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> --}}
<script type="module" src="your-file.js"></script>

<link href="{{asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}" rel="stylesheet" />
@endsection

@section('title', 'Permission')
@section('page-title', 'Create Permission')
@section('small-title', 'Permission')

@section('content')

<!-- Main content -->
<section class="content">

    <script>
        // var $j = jQuery.noConflict();
        //   $j(document).ready(function() {
        //     $j('#mySelect').select2();
        // });
    </script>
    @if (session()->has('status'))
    @if (session('status'))
    <script>
        $(document).ready(function() {
                        swal({
                            icon: "success",
                            text: "Adding a new permission has been completed successfully!"
                        })
                    });
    </script>
    @else
    <script>
        swal("Faild to add new permission row", {
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
                        <h3 class="card-title">Create permission</h3>
                    </div>

                    <!-- /.card-header -->
                    <!-- form start -->
                    {{-- action="{{ route('role.store') }}" --}}
                    <form method="POST">
                        {{-- action="{{ route('professional.store') }}" --}}
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"
                                    required>
                                {{-- @error('name') --}}
                                <div class="col-sm-3">
                                    <small id="msgName" class="text-danger">

                                    </small>
                                </div>
                                {{-- @enderror --}}
                            </div>

                            {{-- <div class="form-group">
                                <label for="title">guard name</label>
                                <input type="text" class="form-control" id="guard_name" name="guard_name"
                                    placeholder="Enter guard name">
                                @error('guard_name')
                                <div class="col-sm-3">
                                    <small id="passwordHelp" class="text-danger">
                                        {{ $message }}
                            </small>
                        </div>
                        @enderror
                </div> --}}



                {{-- <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Enter Title">
                            </div> --}}



                <div class="form-group">
                    <label>guard name</label>
                    <select class="form-control select2" style="width: 100%;" id='guards' name="guards" required>

                        <option value="web">Web</option>
                        <option value="admin">Admin</option>
                        <option value="higher_admin">Higher admin</option>
                        {{-- <option value="web">Web</option> --}}

                    </select>
                    {{-- @error('guard_name') --}}
                    <div class="col-sm-3">
                        <small id="msgGuards" class="text-danger">

                        </small>
                    </div>
                    {{-- @enderror --}}
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="sendData()" class="btn btn-primary">Store</button>
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

<script src="{{asset('cms/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    // import axios from 'axios';
    $(document).ready(function(){
                $('#guards').select2({
                theme: "bootstrap4"
             })
        });
   
//   function sendData() {
// const data = {
// email: document.getElementById('name').value,
// guards: document.getElementById('guards').value,
// };
// axios.post('http://127.0.0.1:8000//admin/roles/store', {
//   email:data.email,
//   guards:data.guards
// })
// .then( (response) =>{
// console.log("response",response.data);
// })
// .catch( (error) =>{
// console.log(error.message);
// });
//   }
 

   function sendData() {
const data = {
name: document.getElementById('name').value,
guards: document.getElementById('guards').value,
};


fetch('https://phplaravel-1025967-3619615.cloudwaysapps.com/admin/permission',
{   
    method: 'POST',
    headers: {  
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
     'Content-Type': 'application/json'
    },
    body: JSON.stringify(data),
}).then(response => {
console.log(response);
  const status = response.status;
    response.json().then(data => {
 const message = data.message;
      
    if (status == 400) {
       
        if (data.message.name) {
        // console.log(data.message.name[0]);
             const nameError = document.getElementById('msgName');
            nameError.innerHTML = data.message.name[0];
        }
        
        if (data.message.guards) {
            const guardsError = document.getElementById('msgGuards');
            guardsError.textContent = data.message.guards[0];
        }
        
    }

 else if(status == 201){$(document).ready(function() {swal({icon: "success",text: "Adding a new permission has been completed successfully!"})});}
 else if(status == 404){swal("Faild to add new permission", {className: "red-bg",});}

})

 }).catch(error => {
console.log("Error1:", error);
});

}
</script>
@endsection