<html>

<head>
    <title>Simple Invoice Template In Bootstrap 4</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style type="text/css">
        table {
            border-collapse: collapse;
        }


        .card {
            margin-bottom: 30px;
            border: 0;
        }

        header {
            background-color: #fff;
        }

        .card-header:first-child {
            border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0;
        }

        .text-center {
            text-align: center !important;
        }

        .card-header {
            padding: .75rem 1.25rem;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, .03);
            border-bottom: 1px solid rgba(0, 0, 0, .125);
        }

        .justify-content-between {
            -ms-flex-pack: justify !important;
            justify-content: space-between !important;
        }

        .row {
            display: -ms-flexbox !important;
            display: flex !important;
            -ms-flex-wrap: wrap !important;
            flex-wrap: wrap !important;
            margin-right: -15px !important;
            margin-left: -15px !important;
        }

        .mb-2,
        .my-2 {
            margin-bottom: .5rem !important;
        }

        @media (min-width: 768px) {
            .col-md-4 {
                -ms-flex: 0 0 33.333333% !important;
                flex: 0 0 33.333333% !important;
                max-width: 33.333333% !important;
            }

            .col-md-5 {
                -ms-flex: 0 0 41.666667% !important;
                flex: 0 0 41.666667% !important;
                max-width: 41.666667% !important;
            }

            .justify-content-md-between {
                -ms-flex-pack: justify !important;
                justify-content: space-between !important;
            }

            .col-md-6 {
                -ms-flex: 0 0 50% !important;
                flex: 0 0 50% !important;
                max-width: 50% !important;
            }
        }

        .mt-3,
        .my-3 {
            margin-top: 1rem !important;
        }

        .mt-5,
        .my-5 {
            margin-top: 3rem !important;
        }

        @media (min-width: 992px) {
            .col-lg-3 {
                -ms-flex: 0 0 25% !important;
                flex: 0 0 25% !important;
                max-width: 25% !important;
            }

            .col-lg-4 {
                -ms-flex: 0 0 33.333333% !important;
                flex: 0 0 33.333333% !important;
                max-width: 33.333333% !important;
            }
        }

        .card-body {
            flex: 1 1 auto !important;
            padding: 1.5rem !important;
        }

        .col-12 {
            -ms-flex: 0 0 100% !important;
            flex: 0 0 100% !important;
            max-width: 100% !important;
            width: 100%;
        }

        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        table {
            border-collapse: collapse;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        .mb-1,
        .my-1 {
            margin-bottom: .25rem !important;
        }

        .h6,
        h6 {
            font-size: 1rem;
        }

        .d-block {
            display: block !important;
        }

        .small,
        small {
            font-size: 80%;
            font-weight: 400;
        }

        .text-left {
            text-align: left !important;
        }

        .mt-3,
        .my-3 {
            margin-top: 1rem !important;
        }

        .card .card-footer,
        .card .card-header {
            background-color: #fff;
        }

        .text-right {
            text-align: right !important;
        }

        .card .card-footer,
        .card .card-header {
            background-color: #fff;
        }

        .ml-auto,
        .mx-auto {
            margin-left: auto !important;
        }

        .card-footer:last-child {
            border-radius: 0 0 calc(.25rem - 1px) calc(.25rem - 1px);
        }

        .card-footer {
            padding: .75rem 1.25rem;
            background-color: rgba(0, 0, 0, .03);
            border-top: 1px solid rgba(0, 0, 0, .125);
        }

        .card-body {
            flex: 1 1 auto;
            padding: 1.5rem;
        }

        .bg-default {
            background-color: #172b4d !important;
            color: white;
        }

        .table thead th {
            padding-top: .75rem;
            padding-bottom: .75rem;
            font-size: .65rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: .0625rem solid #dee2e6;
        }

        .text-muted {
            color: #8898aa !important;
        }

        .table td,
        .table th,
        .table td p {
            font-size: .8125rem;
            white-space: nowrap;
        }

        .table th {
            font-weight: 600;
        }

        .table td,
        .table th {
            padding: 1rem;
            vertical-align: top;
            border-top: .0625rem solid #dee2e6;
        }

        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-bottom: .5rem;
            font-family: inherit;
            font-weight: 400;
            line-height: 1.5;
            color: #32325d;
        }

        body {
            margin: 0;
            font-family: Open Sans, sans-serif !important;
            font-size: 1rem !important;
            font-weight: 400;
            line-height: 1.5;
            color: #525f7f;
            text-align: left;
            background-color: #fff;
        }

        @media (min-width: 1200px) {

            .container,
            .container-lg,
            .container-md,
            .container-sm,
            .container-xl {
                max-width: 1250px;
            }

        }

        @media (max-width: 575px) {

            .container,
            .container-fluid,
            .container-lg,
            .container-md,
            .container-sm,
            .container-xl {
                padding-right: 8px !important;
                padding-left: 8px !important;
            }


            .col-md-10 {
                padding-right: 0px !important;
                padding-left: 0px !important;
            }
        }

        .ml-auto,
        .mx-auto {
            margin-left: auto !important;
        }

        @media (min-width: 768px) {
            .col-md-10 {
                -ms-flex: 0 0 83.333333%;
                flex: 0 0 83.333333%;
                max-width: 83.333333%;
            }
        }

        .h3,
        h3 {
            font-size: 1.75rem;
        }

        .h4,
        h4 {
            font-size: 1.5rem;
        }

        .h5,
        h5 {
            font-size: 1.25rem;
            margin-top: 0px;
        }

        .h6,
        h6 {
            font-size: 1rem;
            margin-top: 0px;
        }

        .mr-auto,
        .mx-auto {
            margin-right: auto !important;
        }

        .ml-auto {
            margin-left: auto !important;
        }

        .col,
        .col-1,
        .col-10,
        .col-11,
        .col-2,
        .col-3,
        .col-4,
        .col-5,
        .col-6,
        .col-7,
        .col-8,
        .col-9,
        .col-auto,
        .col-lg,
        .col-lg-1,
        .col-lg-10,
        .col-lg-11,
        .col-lg-12,
        .col-lg-2,
        .col-lg-3,
        .col-lg-4,
        .col-lg-5,
        .col-lg-6,
        .col-lg-7,
        .col-lg-8,
        .col-lg-9,
        .col-lg-auto,
        .col-md,
        .col-md-1,
        .col-md-10,
        .col-md-11,
        .col-md-12,
        .col-md-2,
        .col-md-3,
        .col-md-4,
        .col-md-5,
        .col-md-6,
        .col-md-7,
        .col-md-8,
        .col-md-9,
        .col-md-auto,
        .col-sm,
        .col-sm-1,
        .col-sm-10,
        .col-sm-11,
        .col-sm-12,
        .col-sm-2,
        .col-sm-3,
        .col-sm-4,
        .col-sm-5,
        .col-sm-6,
        .col-sm-7,
        .col-sm-8,
        .col-sm-9,
        .col-sm-auto,
        .col-xl,
        .col-xl-1,
        .col-xl-10,
        .col-xl-11,
        .col-xl-12,
        .col-xl-2,
        .col-xl-3,
        .col-xl-4,
        .col-xl-5,
        .col-xl-6,
        .col-xl-7,
        .col-xl-8,
        .col-xl-9,
        .col-xl-auto {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        .lead,
        p,
        span {
            font-weight: 300;
            line-height: 1.7;
        }

        p {
            font-size: 1rem;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3 class="text-center p-4">Simple Invoice Template In Bootstrap 4</h3>
        <div class="bg-light p-5">
            <h1 class="text-center m-0">John Dean</h1>
            <div class="row pt-3 mb-2">
                <div class="col-md-6 pull-left"><img src="logo.png" class="img-responsive"></div>
                <div class="col-md-6 text-right">
                    <h5 class="pt-4">invoice #454</h5>
                    <p class="text-muted mb-0"><i>Due to: 4 Dec, 2019</i></p>
                </div>
            </div>
            <div class="row b-t pt-5">
                <div class="col-md-6 pt-3 center">
                    <h5>Client Information</h5>
                    <p>John Doe, Mrs Emma Downson<br>Acme Inc</p>
                    <p>Berlin, Germany<br>6781 45P</p>
                </div>
                <div class="col-md-6 text-right">
                    <h5>Payment Details</h5>
                    <p>VAT: 1425782</p>
                    <p>VAT ID: 10253642</p>
                    <p>Payment Type: Root</p>
                    <p>Name: John Doe</p>
                </div>
            </div>
            <table class="table">
                <tbody>
                    <tr>
                    </tr>
                </tbody>
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Quantity</td>
                        <td>Price</td>
                        <td>Total</td>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>ABC</td>
                        <td>3</td>
                        <td>$ 25</td>
                        <td>$ 75</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="bg-dark text-white p-5">
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-3 text-right">
                    <h6>Sub - Total amount</h6>
                    <h3 class="text-center">$33,350</h3>
                </div>
                <div class="col-md-2 text-right">
                    <h6>Discount</h6>
                    <h3>10%</h3>
                </div>
                <div class="col-md-3 text-right">
                    <h6>Grand Total</h6>
                    <h3>$234,234</h3>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
