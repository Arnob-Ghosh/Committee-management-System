@extends('layouts.master')
@section('title', 'contact list')



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

                    <div class="card card-primary">
                        <div class="card-header">
                            <h5 class="m-0"><strong><i class="fas fa-clipboard-list"></i> CONTACT</strong></h5>
                        </div>
                        <div class="card-body">
                            <!-- <h6 class="card-title">Special title treatment</h6> -->
                            <!-- Table -->

                            <div class="pt-3">
                                <div class="table-responsive">
                                    <table id="category_table" class="display table-bordered" width="100%">
                                        <thead>
                                            <tr>

                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Subjiect</th>
                                                <th>Phone</th>
                                                <th>message</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div> <!-- Card-body -->
                    </div> <!-- Card -->

                </div> <!-- /.col-lg-6 -->
            </div><!-- /.row -->
        </div> <!-- container-fluid -->
    </div> <!-- /.content -->
</div> <!-- /.content-wrapper -->





@endsection

@section('script')

<script >
    fetchCategory();
function fetchCategory() {
    $.ajax({
        type: "GET",
        url: "/contact-list-data",
        dataType: "json",
        success: function (response) {
            $("tbody").html("");
            $.each(response.data, function (key, item) {
                $("tbody").append(
                    "<tr>\
					<td>" +
                        item.name +
                        '</td>\
						<td>' +
                        item.email +
                        '</td>\
                        <td>' +
                        item.subject +
                        '</td>\
                        <td>\
                            '+item.phone +'\
        			    </td>\
                        <td>\
                            '+item.message +'\
        			    </td>\
        		</tr>'
                );
            });
        },
    });
}
</script>


@endsection
