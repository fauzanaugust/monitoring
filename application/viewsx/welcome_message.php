<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>Monitoring | Kelurahan Jatiuwung</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url()?>assets/css/bootstrap/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css');?>">

    <style>

    </style>
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url()?>assets/css/bootstrap/carousel.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/vendor/leaflet/leaflet.css" rel="stylesheet">
    <script src="<?php echo base_url()?>assets/vendor/leaflet/leaflet.js"></script>

    <script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />


</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-secondary">
            <a class="navbar-brand" href="#">Monitoring</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo base_url(); ?>">Home</a>
                    </li>
                </ul>
                <form class="form-inline mt-2 mt-md-0">
                    <button class="btn btn-warning my-2 my-sm-0" type="button" onclick="javascript:location.href='<?php echo base_url('backend'); ?>'">Login</button>
                </form>
            </div>
        </nav>
    </header>

    <main role="main">
        <?php
        $this->load->view($ftemplate);
    ?>

        <!-- FOOTER -->
        <footer class="container">
            <p class="float-right"><a href="#">Back to top</a></p>
            <p>&copy; 2021 Kelurahan Jatiuwung | Page rendered in <strong>{elapsed_time}</strong> seconds.</p>
        </footer>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')
    </script>
    <script src="<?php echo base_url()?>assets/js/bootstrap/bootstrap.bundle.js"></script>


</body>

</html>