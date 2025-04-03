@extends('layouts.master')
@section('title', 'Union List')



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

                    <div class="card radius-10 w-100">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h5 class="mb-0">Manage All Unions</h5>
                                </div>
                                <div class="dropdown options ms-auto">
                                    <div>
                                        <a href="{{ route('union.create') }}" class="btn btn-primary btn-sm">Add Union</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            @if( $unions->count() > 0 )
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-border" id="unionTable">
                                        <thead class="table-dark">
                                            <tr>
                                            <th scope="col">#SL.</th>
                                            <th scope="col">Union Name</th>
                                            <th scope="col">Thana Name</th>
                                            <th scope="col">District Name</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @php $i=1; @endphp
                                            @foreach($unions as $union)
                                                <tr>
                                                <th scope="row">{{ $i }}</th>
                                                <td>{{ $union->name }}</td>
                                                <td>{{ $union->thana->name }}</td>
                                                <td>{{ $union->district->name }}</td>
                                                <td>
                                                    @if( $union->status == 1 )
                                                        <span class="badge bg-primary">Active</span>
                                                    @elseif( $union->status == 0 )
                                                        <span class="badge bg-warning">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="action-bar d-flex">
                                                        <ul>
                                                            <li>
                                                                <a href="{{ route('union.edit', $union->id) }}">
                                                                    <i class="fas fa-edit" style="color: green"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="" data-bs-toggle="modal" data-bs-target="#deleteUnion{{ $union->id }}" >
                                                                    <i class="fas fa-trash" style="color: red"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
        <!-- Modal -->
        <div class="modal fade" id="deleteUnion{{ $union->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are you confirm to delect this Union?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="action-bar">
                            <ul>
                                <li>
                                    <form action="{{ route('union.destroy', $union->id) }}" method="POST">
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
                                                </tr>
                                                @php $i++; @endphp
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            @else
                               <div class="alert alert-info">Sorry! No Data Found in System Database</div>
                            @endif

                        </div>
                    </div>

                </div>
            </div><!-- /.row -->
        </div> <!-- container-fluid -->
    </div> <!-- /.content -->
</div> <!-- /.content-wrapper -->

@endsection

@section('script')
{{-- <script type="text/javascript" src="{{asset('js/backend/smartPhone.js')}}"></script> --}}
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#unionTable').DataTable();
    });
</script>

@endsection
