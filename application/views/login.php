<head>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/sweetalert2/sweetalert2.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/adminlte/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <script type="text/javascript">
        var BASE_URL = '<?php echo base_url(); ?>';
        var CURRENT_PATH = window.location.href;
    </script>
</head>

<body class="hold-transition login-page bg-secondary bg-gradient">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Halaman</b>Login</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Monitoring</p>

                <form method="post" action="">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Username" id="username" name="username">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary btn-block" onclick="authLogin();">Sign in</button>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <script src="<?php echo base_url()?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/sweetalert2/sweetalert2.all.js"></script>

    <script type="text/javascript">
        $("#password").bind("enterKey", function(e) {
            authLogin();
        });

        $("#password").keyup(function(e) {
            if (e.keyCode == 13) {
                $(this).trigger("enterKey");
            }
        });

        function authLogin() {
            var USERNAME = $('#username').val();
            var PASSWORD = $('#password').val();

            if (USERNAME != '' && PASSWORD != '') {

                $.ajax({
                    url: BASE_URL + 'Backend/authLogin',
                    type: 'POST',
                    data: {
                        USERNAME: USERNAME,
                        PASSWORD: PASSWORD
                    },
                    success: function(response) {
                        console.log(response);
                        if (response == 'success') {
                            window.location = BASE_URL + 'backend'

                        } else {
                            Swal.fire('Error', 'Username atau Password Salah !', 'error');
                        }

                    }
                });

            } else {
                Swal.fire('Error', 'Username dan Password wajib diisi !', 'error')
            }
        }
    </script>
