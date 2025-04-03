@extends('layouts.master')
@section('title', 'News ticker List')



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
                        <div class="card-header bg-info">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h5 class="mb-0">Manage All News Ticker</h5>
                                </div>
                                <div class="dropdown options ms-auto">
                                    <div>
                                        <a href="{{ route('news.ticker.create') }}" class="btn btn-danger btn-sm">Add News Tricker</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            @if( $newsTickers->count() > 0 )
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-border" id="newsTable">
                                        <thead class="table-dark">
                                            <tr>
                                            <th scope="col">#SL.</th>
                                            <th scope="col">image</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Short Description</th>
                                            {{-- <th scope="col">Long Description</th> --}}
                                            <th scope="col">Breaking News</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($newsTickers as $key => $newsTicker)
                                                <tr>
                                                <th scope="row">{{ ++$key }}</th>
                                                <td>
                                                    @if ( !is_null($newsTicker->image) )
                                                        <img src="{{ asset('images/news/' . $newsTicker->image ) }}" alt="" width="50">
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    @if( $newsTicker->speech_role == "President" )
                                                        <span class="badge bg-primary">President</span>
                                                    @elseif( $newsTicker->speech_role == "Secretary" )
                                                        <span class="badge bg-info">Secretary</span>
                                                    @elseif( $newsTicker->speech_role == "Mission and Vision" )
                                                        <span class="badge bg-warning">Mission and Vision</span>
                                                    @elseif( $newsTicker->speech_role == "Headlines" )
                                                        <span class="badge bg-info">Headlines</span>
                                                    @elseif( $newsTicker->speech_role == "Notice Board" )
                                                        <span class="badge bg-dark">Notice Board</span>
                                                    @endif
                                                </td>
                                                <td>{{ $newsTicker->short_desc }}</td>
                                                {{-- <td>{{ $newsTicker->long_desc }}</td> --}}
                                                <td>
                                                    @if ( !is_null($newsTicker->headline) )
                                                        {{ $newsTicker->headline }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    @if( $newsTicker->status == 1 )
                                                        <span class="badge bg-success">Active</span>
                                                    @elseif( $newsTicker->status == 0 )
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="action-bar">
                                                        <ul>
                                                            <li>
                                                                <a href="{{ route('news.ticker.edit', $newsTicker->id) }}">
                                                                    <i class="fas fa-edit" style="color: green"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="" data-bs-toggle="modal" data-bs-target="#deleteNewsTicker{{ $newsTicker->id }}" >
                                                                    <i class="fas fa-trash" style="color: red"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
        <!-- Modal -->
        <div class="modal fade" id="deleteNewsTicker{{ $newsTicker->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are you confirm to delect this NewsTicker?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="action-bar">
                            <ul>
                                <li>
                                    <form action="{{ route('news.ticker.destroy', $newsTicker->id) }}" method="POST">
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
        $('#newsTable').DataTable();
    });
</script>

@endsection
