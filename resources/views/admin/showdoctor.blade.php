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
        <div class="container-fluid">
            @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
            @elseif(Session::has('fail'))
            <dv class="alert alert-danger">{{Session::get('fail')}}</dv>
            @endif

            <div class="container" align="center" style="padding-top:50px;">
                <table class="table">
                    <thead>
                        <td>Doctor Name</td>
                        <td>Phone</td>
                        <td>Specility</td>
                        <td>Room No.</td>
                        <td>Image</td>
                        <td>Delete</td>
                        <td>Update</td>
                    </thead>
                    <tbody>
                        @foreach($doctor as $doc)
                        <tr>
                            <td>{{ $doc->name }}</td>
                            <td>{{ $doc->phone }}</td>
                            <td>{{ $doc->speciality }}</td>
                            <td>{{ $doc->room }}</td>
                            <td><img height="100" width="100" src="doctorimage/{{ $doc->image }}" alt="doctorimg"></td>
                            <td><a href="{{url('deletedoctor',$doc->id)}}" class="btn btn-danger">Delete</a></td>
                            <td><a href="{{url('edit', $doc->id) }}" class="btn btn-primary">Update</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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