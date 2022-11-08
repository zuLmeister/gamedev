<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    

    <!-- Custom fonts for this template-->
    <link href="{{ asset(public_path('admin/vendor/fontawesome-free/css/all.min.css')) }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset(public_path('admin/css/sb-admin-2.min.css')) }}" rel="stylesheet">
    <link href="{{ asset(public_path('admin/css/email.css')) }}" rel="stylesheet">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    
    <style>
        .button {
            background-color: gray;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 15px;
            margin: 0 auto;
            display: block;
            margin-left: 40%;
            margin-right: 30%;
            }

        button:hover{
            opacity: 80%;
            cursor: pointer;
        }
    </style>


</head>



<body class="bg-gradient-primary">
    @include('sweetalert::alert')

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9" style="margin-top: 50px">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6" style="background-color: rgb(219, 215, 215)">
                                <div class="p-12">
                                    <div class="text-center">
                                        <h1 class="h3 text-gray-900 mb-4" style="text-align: center">Hello ini GameRev!</h1>
                                        <h3 class="text-gray-900 mb-4" style="text-align: center">Silahkan melakukan verifikasi akun dengan mengklik button dibawah ini</h3>
                                        <h3 class="text-gray-900 mb-4" style="text-align: center">{{$token}}</h3>
                                        <h4 class="text-gray-900 mb-4" style="margin-left: 25px">Bila tidak dapat menggunakan button di atas silahkan menggunakan link berikut: {{ url('/akun/verifikasi',$token)}}</h4>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

</body>

</html>