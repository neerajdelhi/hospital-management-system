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
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Doctor Name</th>
                        <th>Date</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Approved</th>
                        <th>Canceled</th>
                    </thead>
                    <tbody>
                        @foreach($appointment as $appoint)
                        <tr>
                            <td>{{$appoint->name}}</td>
                            <td>{{$appoint->email}}</td>
                            <td>{{$appoint->phone}}</td>
                            <td>{{$appoint->doctor}}</td>
                            <td>{{$appoint->date}}</td>
                            <td>{{$appoint->message}}</td>
                            <td>{{$appoint->status}}</td>
                            <td><a href="{{url('appointmentApprove',$appoint->id)}}" class="btn btn-success">Approve</a></td>
                            <td><a href="{{url('appointmentCancel',$appoint->id)}}" class="btn btn-danger">Cancel</a></td>
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