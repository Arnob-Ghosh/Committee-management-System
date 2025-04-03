@extends('layouts.master')
@section('title', 'Job Seeker List')



@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div><!-- /.col -->
            </div><!-- /.row mb-2 -->
        </div><!-- /.container-fluid -->
    </div> <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-header bg-primary d-flex align-items-center">
                            <h5 class=" text-white mb-0 flex-grow-1">Job Seeker Information</h5>
                            {{-- <div class="flex-shrink-0">
                                <a href="{{ route('create.bankUser') }}" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#..">
                                    <i class="bi-plus-circle"> Add New Bank User</i>
                                </a>
                                <a href="{{ route('pending.bankUser') }}" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#..">
                                    <i class="bi-plus-circle"> Pending Bank User</i>
                                </a>
                            </div> --}}
                        </div>
                        <div class="card-body mt-2" id="show_all_bankUsers">
                          {{-- <h5 class="card-title">Bank User Information</h5> --}}
                          @if ($jobSeekers->count() > 0)
                                <!-- Table with stripped rows -->
                                <div class="">
                                    <table class="table table-bordered table-striped datatable" id="myTable">
                                        <thead>
                                        <tr>
                                            <th scope="col">#Sl.</th>
                                            <th scope="col">Job ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Father Name</th>
                                            <th scope="col">Mother Name</th>
                                            <th scope="col">District</th>
                                            <th scope="col">Upzila</th>
                                            <th scope="col">Union</th>
                                            <th scope="col">Village</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                            <th scope="col">Present Address</th>
                                            <th scope="col">Permanent Address</th>
                                            <th scope="col">Education Details</th>
                                            <th scope="col">Comment</th>
                                            <th scope="col">Feedback</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ( $jobSeekers as $key => $jobSeeker )
                                                <tr>
                                                    <th scope="row">{{ ++$key}}</th>
                                                    <td>{{ $jobSeeker->job_id }}</td>
                                                    <td>{{ $jobSeeker->name }}</td>
                                                    <td>{{ $jobSeeker->email }}</td>
                                                    <td>{{ $jobSeeker->contact }}</td>
                                                    <td>{{ $jobSeeker->father_name }}</td>
                                                    <td>{{ $jobSeeker->mother_name }}</td>
                                                    <td>{{ $jobSeeker->district }}</td>
                                                    <td>{{ $jobSeeker->thana->name }}</td>
                                                    <td>{{ $jobSeeker->union->name }}</td>
                                                    <td>{{ $jobSeeker->village }}</td>
                                                    <td>
                                                        @if( $jobSeeker->status == 'Processing' )
                                                            <span class="badge bg-primary">Processing</span>
                                                        @elseif( $jobSeeker->status == 'Pending' )
                                                            <span class="badge bg-warning">Pending</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="" class="btn btn-outline-success btn-sm mb-2 editIcon" data-bs-toggle="modal" data-bs-target="#editJobSeekerModal{{ $jobSeeker->id }}">
                                                            <i class="fas fa-edit" style="color: green"></i>
                                                        </a>
                                                        <a href="" class="btn btn-outline-danger btn-sm deleteIcon" data-bs-toggle="modal" data-bs-target="#deleteJobSeekerModal{{ $jobSeeker->id }}">
                                                            <i class="fas fa-trash" style="color: red"></i>
                                                        </a>
                                                    </td>
                                                    <td>{{ $jobSeeker->present_address }}</td>
                                                    <td>{{ $jobSeeker->permanent_address }}</td>
                                                    <td>{{ $jobSeeker->education_details }}</td>
                                                    <td>{{ $jobSeeker->comment }}</td>
                                                    <td>{{ $jobSeeker->feedback }}</td>
                                                </tr>
<!-- Modal -->
<div class="modal fade" id="deleteJobSeekerModal{{ $jobSeeker->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you confirm to delect this Candidate Status Info?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="action-bar">
                    <ul>
                        <li>
                            <form action="{{ route('destroy.jobSeeker', $jobSeeker->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Yes</button>
                            </form>
                        </li>
                        <li>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
                                                @include('backend.jobSeeker.edit_modal_page')
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <!-- End Table with stripped rows -->
                          @else
                            <div class="alert alert-info" role="alert">
                                <strong> Sorry ! </strong> No Found in <b>Any Member</b>.
                            </div>

                          @endif

                        </div>
                    </div> <!-- Card -->

                </div> <!-- /.col-lg-6 -->
            </div><!-- /.row -->
        </div> <!-- container-fluid -->
    </div> <!-- /.content -->
</div> <!-- /.content-wrapper -->



@endsection

@include('backend.jobSeeker.jobSeeker_js')
