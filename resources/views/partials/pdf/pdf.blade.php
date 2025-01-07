<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            margin: 0;
            padding: 0;
        }

        /* Remove excessive padding for all elements */
        th, td {
            padding: 3px !important;
        }

        .page {
            position: relative;
            min-height: calc(50vh - 20px); /* Fit two pages evenly */
            padding: 15px;
        }

        /* Footer */
        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            /* background-color: #003300; */
            /* color: white; */
            /* text-align: center; */
            padding: 0;
        }

        .foot{
            padding: 10px;
        }

        .hr{
            border: 1px solid black;
            padding: 0;
            margin: 0;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            footer {
                position: fixed;
                bottom: 0;
                page-break-before: avoid;
                page-break-after: avoid;
            }

            .page {
                /* Prevent automatic page breaks */
                page-break-after: auto;
                page-break-before: auto;
                page-break-inside: avoid; /* Prevent page breaks inside this element */
            }

            /* Ensure no additional blank pages */
            .page:last-child {
                page-break-after: auto; /* Avoid forcing a page break after the last page */
            }

            /* Control page breaks for the second page */
            .page:nth-child(2) {
                page-break-before: always; /* Ensure second page starts on a new page */
            }
        }
    </style>

</head>
<body>
    <!-- Page 1 -->
    <div class="page">
        <div class="container mt-3">
            <header>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered border-dark" style="width: 100%;">
                            <tr>
                                <td style="width: 40%;">
                                    <table class="table table-bordered border-dark" style="width: 100%;">
                                        <tr>
                                            <td>
                                                <img src="dist/images/logos/logo.png" class="dark-logo img1 pb-2" style="width: 100px; height: 100px; border: 1px solid black;" alt="Logo">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div style="border: 1px solid black;"><span class="ps-3">No.:</span></div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="width: 10%;"></td>
                                <td style="width: 50%;">
                                    <table class="table table-bordered border-dark" style="width: 100%;">
                                        <tr>
                                            <td colspan="2" style="background: navy; color: white; text-align: center;">CLIENT DETAILS</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 40%;">Date:</td>
                                            <td style="width: 60%;"></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 40%;">Passenger Name:</td>
                                            <td style="width: 60%;"></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 40%;">Contact Email:</td>
                                            <td style="width: 60%;"></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 40%;">Contact No:</td>
                                            <td style="width: 60%;"></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 40%;">Tour Consultant:</td>
                                            <td style="width: 60%;"></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 40%;">Source / Agent:</td>
                                            <td style="width: 60%;"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </header>

            <main>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered border-dark">
                            <tr>
                                <th colspan="2" class="text-center" style="background: navy; color: white;">Description</th>
                                <th class="text-center" style="background: navy; color: white;">Qty</th>
                                <th class="text-center" style="background: navy; color: white;">Amount $</th>
                                <th class="text-center" style="background: navy; color: white;">Amount Rs.</th>
                            </tr>
                            <tr>
                                <th colspan="5" class="text-center" style="background: #e8e9eb;">Ticket reservation Button and booking details</th>
                            </tr>
                            <tr>
                                <td style="width: 20%;"><strong>Ticket :</strong></td>
                                <td style="width: 45%;"></td>
                                <td class="text-center" style="width: 7%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                            </tr>
                            <tr>
                                <td style="width: 20%;"><strong>Airline Details :</strong></td>
                                <td style="width: 45%;"></td>
                                <td class="text-center" style="width: 7%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                            </tr>
                            <tr>
                                <td style="width: 20%;"><strong>Booking Summary :</strong></td>
                                <td style="width: 45%;"></td>
                                <td class="text-center" style="width: 7%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                            </tr>
                            <tr>
                                <th colspan="5" class="text-center" style="background: #e8e9eb;">Hotel reservation Button and booking details</th>
                            </tr>
                            <tr>
                                <td style="width: 20%;"><strong>Type of Hotel</strong></td>
                                <td style="width: 45%;"></td>
                                <td class="text-center" style="width: 7%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                            </tr>
                            <tr>
                                <td style="width: 20%;"><strong>Hotel Location 1</strong></td>
                                <td style="width: 45%;"></td>
                                <td class="text-center" style="width: 7%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                            </tr>
                            <tr>
                                <td style="width: 20%;"><strong>Hotel Location 2</strong></td>
                                <td style="width: 45%;"></td>
                                <td class="text-center" style="width: 7%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                            </tr>
                            <tr>
                                <td style="width: 20%;"><strong>Hotel Location 3</strong></td>
                                <td style="width: 45%;"></td>
                                <td class="text-center" style="width: 7%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                            </tr>
                            <tr>
                                <td style="width: 20%;"><strong>Hotel Location 4</strong></td>
                                <td style="width: 45%;"></td>
                                <td class="text-center" style="width: 7%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                            </tr>
                            <tr>
                                <th colspan="5" class="text-center" style="background: #e8e9eb;">Food & Beverage</th>
                            </tr>
                            <tr>
                                <td style="width: 20%;"><strong>Type of Food</strong></td>
                                <td style="width: 45%;"></td>
                                <td class="text-center" style="width: 7%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                            </tr>
                            <tr>
                                <td style="width: 20%;"><strong>Meals</strong></td>
                                <td style="width: 45%;"></td>
                                <td class="text-center" style="width: 7%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                            </tr>
                            <tr>
                                <th colspan="5" class="text-center" style="background: #e8e9eb;">Tour Location Transport</th>
                            </tr>
                            <tr>
                                <td style="width: 20%;"><strong>Hotel Location 1</strong></td>
                                <td style="width: 45%;"></td>
                                <td class="text-center" style="width: 7%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                            </tr>
                            <tr>
                                <td style="width: 20%;"><strong>Hotel Location 2</strong></td>
                                <td style="width: 45%;"></td>
                                <td class="text-center" style="width: 7%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                            </tr>
                            <tr>
                                <td style="width: 20%;"><strong>Hotel Location 3</strong></td>
                                <td style="width: 45%;"></td>
                                <td class="text-center" style="width: 7%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                            </tr>
                            <tr>
                                <td style="width: 20%;"><strong>Hotel Location 4</strong></td>
                                <td style="width: 45%;"></td>
                                <td class="text-center" style="width: 7%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                            </tr>
                            <tr>
                                <td style="width: 20%;"><strong>Hotel Location 5</strong></td>
                                <td style="width: 45%;"></td>
                                <td class="text-center" style="width: 7%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                            </tr>
                            <tr>
                                <th colspan="5" class="text-center" style="background: #e8e9eb;">Other Services</th>
                            </tr>
                            <tr>
                                <td style="width: 20%;"><strong>Wheelchair Services</strong></td>
                                <td style="width: 45%;"></td>
                                <td class="text-center" style="width: 7%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                            </tr>
                            <tr>
                                <th colspan="2" class="text-end" style="background: #e8e9eb;">Total</th>
                                <td class="text-center" style="width: 7%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                            </tr>
                            <tr>
                                <th colspan="2" class="text-end" style="background: #e8e9eb;">VAT</th>
                                <td class="text-center" style="width: 7%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                            </tr>
                            <tr>
                                <th colspan="2" class="text-end" style="background: #e8e9eb;">Grand Total</th>
                                <td class="text-center" style="width: 7%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                                <td class="text-center" style="width: 14%;"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Page 2 -->
    <div class="page">
        <div class="container mt-3">
            <header>
                <div class="row">
                    <div class="col-md-12">
                        <table style="width: 100%;">
                            <tr>
                                <th style="width: 50%;"></th>
                                <th class="text-end" style="width: 50%;">
                                    <table class="table table-bordered border-dark">
                                        <tr>
                                            <td><img src="" alt="Logo"></td>
                                        </tr>
                                    </table>
                                </th>
                            </tr>
                        </table>
                    </div>
                </div>
            </header>
            <main>
                <div class="row">
                    <div class="col-md-12">
                        <table style="width: 100%;">
                            <tr>
                                <th><strong><u>Terms and Conditions</u></strong></th>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-12">
                        <table style="width: 100%; line-height: 1.5; text-align: justify;">
                            <tr>
                                <td>
                                    <ul>
                                        <li>All payments must be made in full, before commencement of the course.</li>
                                        <li>Admission is not guaranteed if complete payment is not made.</li>
                                        <li>
                                            Please carry a form of government ID at the time of attending the course or training
                                            session.
                                        </li>
                                        <li>
                                            If there is a replacement candidate and the attending candidate is different from the
                                            initial registration, a nomination letter from the registered candidate should be
                                            availed, to complete the admission process.
                                        </li>
                                        <li>
                                            Candidates arriving 30 minutes after the start of the training session will not be
                                            admitted and will have to reschedule the session with the training manager
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-12">
                        <table style="width: 100%;">
                            <tr>
                                <th><strong><u>Refund Timelines</u></strong></th>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-12">
                        <table style="width: 100%; line-height: 1.5; text-align: justify;">
                            <tr>
                                <td>
                                    <ul>
                                        <li>
                                            90% of the course fee will be refunded for cancellation requests made 30 days
                                            before the commencement of course.
                                        </li>
                                        <li>
                                            75% of the course fee will be refunded for cancellation requests made 10 days
                                            before the commencement of course.
                                        </li>
                                        <li>
                                            Any Cancellation requests made less than 10 days of the commencement of the
                                            course will not be entertained.
                                        </li>
                                        <li>
                                            For Individual clients, candidate replacement would be allowed in the scenario of a
                                            non-refund.
                                        </li>
                                        <li>
                                            The same is not applicable for Corporate Clients.
                                        </li>
                                        <li>
                                            In the event of a training session being cancelled by ATSM, the same shall be
                                            rescheduled or 100% refund of the course fee shall be done.
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div>
            <div><hr class="hr" style="border: 1px solid black;"></div>
            <div class="foot" style="background: navy; margin: 0;">
                <img src="" alt="Footer Images" style="height: 50px;">
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
