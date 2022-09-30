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

       <?php
        if(isset($doctor->id)){
          $url = 'update_doctor';
          $id = $doctor->id;
        }else{
          $url = 'upload_doctor';
          $id = '';
        }
        ?>

        <form action="{{ url($url) }}" method="post" enctype="multipart/form-data" style="padding-top:50px;">

          @csrf

          <input type="hidden" name="id" value="{{$id}}">
          <div style="padding:15px;">
            <label for="">Doctor Name</label>
            <input type="text" name="name" placeholder="Write the name" value="{{ isset($doctor->name) ? $doctor->name : '' }}">
          </div>

          <div style="padding:15px;">
            <label for="">Phone</label>
            <input type="number" name="phone" placeholder="Write the number" value="{{ isset($doctor->phone) ? $doctor->phone : '' }}">
          </div>

          <div style="padding:15px;">
            <label for="">Speciality</label>
            <select name="speciality" id="" style="width:210px;color:#000;">
              <option value="">--Select--</option>
              <option value="skin" @if(isset($doctor->speciality) && $doctor->speciality=='skin')
                {{'selected'}}
                @endif
                >skin
              </option>
              <option value="heart" @if(isset($doctor->speciality) && $doctor->speciality=='heart')
                {{'selected'}}
                @endif
                >heart
              </option>
              <option value="eye" @if(isset($doctor->speciality) && $doctor->speciality=='eye')
                {{'selected'}}
                @endif
                >eye
              </option>
              <option value="nose" @if(isset($doctor->speciality) && $doctor->speciality=='nose')
                {{'selected'}}
                @endif
                >nose
              </option>
            </select>
          </div>

          <div style="padding:15px;">
            <label for="">Room no.</label>
            <input type="number" name="room" placeholder="Write the room number" value="{{ isset($doctor->room) ? $doctor->room : '' }}">
          </div>

          <div style="padding:15px;">
            <label for="">Doctor Image</label>
            @if(isset($doctor->image))
            <img width="200" height="200" src="/doctorimage/{{$doctor->image}}" alt="">
            @endif
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