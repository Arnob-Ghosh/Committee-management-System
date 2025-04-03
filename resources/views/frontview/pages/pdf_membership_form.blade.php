<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Membership Form</title>
    {{-- <style>
        body {
            height: 842px;
            width: 595px;
            /* to centre page on screen*/
            margin-left: auto;
            margin-right: auto;
        }
    </style> --}}
    <style> 

    .line-above {
        border-top: 1px solid black; /* Line above the text */
        display: inline-block;
        padding-top: 5px; /* Space between line and text */
        margin-top: 10px; /* Space above the line */
    }
</style>
    <style>
        @media {
            body{
                width: 27cm;
                height: 29.7cm;
                /* change the margins as you want them to be. */
                /* size: 7in 9.25in; */
                margin: 18mm 16mm 27mm 65mm;
            }
        }
    </style>
  </head>
  <body>

    <section>
        <div class="container" id="content">
            <div class="row">
                <div class="col-lg-8">
                    <div class="text-center mt-5" style="margin-left: 200px">
                        <h4 class="text-info">Dohar-Nawabgonj Bankers Association</h4>
                        <h6>Snehalaya, 102/1-A, Naya Paltan (6th Floor) </h6>
                        <h6>Box-Culvert Road, Dhaka-1000 </h6>
                        <h6>Phone: 01977449960, 01799384759 </h6>
                        <h6>e-mail : <a href="">info.dnba@gmail.com</a></h6>
                    </div>
                </div>
                <div class="col-lg-2 mt-5 border" style="margin-left: 100px">
                    <img src="{{ asset('images/user/' . $download_pdf->image) }}" alt="" class="img-fluid">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 offset-lg-4 mt-2">
                    <h5 class="text-center text-success"><u>Membership Form</u></h5>
                </div>
                <div class="col-lg-12 mx-2">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="my-3"><strong>Membership No:</strong> {{ $download_pdf->member_id }}</p>
                            <p><strong>1. Name:</strong> {{ $download_pdf->name }}</p>
                            <p><strong>2. Father's Name:</strong> {{ $download_pdf->father_name }}</p>
                            <p><strong>3. Mother's Name:</strong> {{ $download_pdf->mother_name }}</p>
                            <p><strong>4. Spouse Name:</strong> {{ $download_pdf->spouse_name }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>5. Date of Birth:</strong> {{ date('d-m-Y', strtotime($download_pdf->birth_date)) }}</p>

                        </div>
                        <div class="col-md-4">
                            <p><strong>,Blood Group:</strong> {{ $download_pdf->blood_group }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>,Nationality:</strong> Bangladeshi</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>6. National ID No:</strong> {{ $download_pdf->nid }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Religion:</strong> {{ $download_pdf->religion }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>7. Contact: Phone:</strong> {{ $download_pdf->contact }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Mobile:</strong>{{ $download_pdf->mobile }}</p>
                        </div>
                        <div class="col-md-12">
                            <p><strong>8. E-mail:</strong> {{ $download_pdf->email }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>9. Address (Permanent):Village:</strong> {{ $download_pdf->village->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Postal Code.:</strong> {{ $download_pdf->post_office }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong> Union:</strong> {{ $download_pdf->union->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Upazila:</strong> Nawabgonj,<b> Dist:</b> Dhaka. </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>10. Address (Office): Designation:</strong> {{ $download_pdf->designation_id }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Office/Branch:</strong> {{ $download_pdf->branch }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>11. Division/Section:</strong> {{ $download_pdf->section }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Bank:</strong> {{ $download_pdf->bank_name }}</p>
                        </div>
                        <div class="col-md-12">
                            <p><strong>12. Address (Present):</strong> {{ $download_pdf->present_address }}</p>
                        </div>
                        <div class="col-md-12">
                            <p><strong>13. Facebook ID:</strong> {{ $download_pdf->facebook_id }}</p>
                        </div>
                        <div class="col-md-12 mt-3">
                            <p><strong>I hereby declare that the information given are complete and correct. I understand and agree to abide by the terms and conditions of the association.</strong></p>
                        </div>
                        <div class="col-md-9"></div>
                        <div class="col-md-3 mt-3 pt-3 pb-5">
                            <img src="{{ asset('images/signature/' . $download_pdf->signature) }}" alt="" class="img-fluid" style="margin: 0px 80px" width="70px">
                            <h6 class="line-above"> Applicant's Signature and Date</h6>
                        </div>
                        <div class="col-md-2 my-5">
                            <h6 class="line-above">Member Secretary</h6>
                        </div>
                        <div class="col-md-8"></div>
                        <div class="col-md-2 my-5">
                            <h6 class="line-above" >Convenor</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="text-center">
        <div class="btn-group btn-group-sm d-print-none mb-4">
        <a href="javascript:window.print()" class="btn btn-light border text-black-100 shadow-none"><i class="fa fa-print"></i> Print</a>
        <button type="button" id="btnExport" class="btn btn-light border text-black-100 shadow-none"><i class="fa fa-download"></i> Download</button>
        </div>
    </footer>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- PDF File Generate -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#btnExport').click(function (e) {
                e.preventDefault();
                html2canvas(document.querySelector('#content')).then((canvas) => {
                    let base64image = canvas.toDataURL('image/png');
                    // console.log(base64image);
                    let pdf = new jsPDF('p', 'px', [2000, 1700]); // 3508px x 2480px
                    pdf.addImage(base64image, 'PNG', 15, 15, 1250, 1280);
                    // pdf.addImage(base64image, 'PNG', 25, 25, 1300, 1200);
                    pdf.save('Membership-Form.pdf');
                });
            });
        });
    </script>

  </body>
</html>
