<x-app-layout>
  <h1>This is admin dashboard.</h1>
</x-app-layout>

<!DOCTYPE html>
<html lang="en">

<head>
  @include('admin.css')
  <style>
    label {
      display: inline-block;
      width: 200px;
    }
  </style>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
    <!-- partial -->
    @include('admin.navbar')
    <!-- partial -->

    <!-- content-wrapper ends -->
    <div class="container-fluid page-body-wrapper">
      <div class="container" align="center" style="padding-top:50px;">

        @if(Session::has('success'))
        <h1 class="alert alert-success">{{ Session::get('success') }}</h1>
        @elseif(Session::has('fail'))
        <h1 class="alert alert-danger">{{ Session::get('fail') }}</h1>
        @endif


        <form action="{{ url('upload_doctor') }}" method="post" enctype="multipart/form-data" style="padding-top:50px;">

          @csrf

          <div style="padding:15px;">
            <label for="">Doctor Name</label>
            <input type="text" name="name" placeholder="Write the name">
          </div>

          <div style="padding:15px;">
            <label for="">Phone</label>
            <input type="number" name="phone" placeholder="Write the number">
          </div>

          <div style="padding:15px;">
            <label for="">Speciality</label>
            <select name="speciality" id="" style="width:210px;color:#000;">
              <option value="">--Select--</option>
              <option value="skin">skin</option>
              <option value="heart">heart</option>
              <option value="eye">eye</option>
              <option value="nose">nose</option>
            </select>
          </div>

          <div style="padding:15px;">
            <label for="">Room no.</label>
            <input type="number" name="room" placeholder="Write the room number">
          </div>

          <div style="padding:15px;">
            <label for="">Doctor Image</label>
            <input type="file" name="file">
          </div>


          <div style="padding:15px;">
            <input type="submit" class="btn btn-success">
          </div>
        </form>
      </div>

    </div>


    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  @include('admin.scripts')
</body>

</html>