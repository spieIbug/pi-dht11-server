<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="node_modules/admin-lte/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="node_modules/admin-lte/dist/css/skins/_all-skins.min.css">
    <title>DHT11 sensor capture</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/toastr/build/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="lib/ow/example/leaflet/leaflet.css" />
    <link rel="stylesheet" type="text/css" href="lib/ow/leaflet-openweathermap.css" />
    <link rel="stylesheet" type="text/css" href="lib/ow/example/files/map.css" />
    <script src="lib/ow/example/leaflet/leaflet.js"></script>
    <script src="lib/ow/example/leaflet/Permalink.js"></script>
    <script src="lib/ow/example/leaflet/Permalink.Layer.js"></script>
    <script src="lib/ow/example/leaflet/Permalink.Overlay.js"></script>
    <script src="lib/ow/example/leaflet/leaflet-flattrbutton.js"></script>
    <script src="lib/ow/leaflet-openweathermap.js"></script>
    <!--[if lt IE 9]><script type="text/javascript" src="files/excanvas.js"></script><![endif]-->
    <link rel="stylesheet" type="text/css" href="lib/ow/example/leaflet/leaflet-languageselector.css" />
    <script src="lib/ow/example/leaflet/leaflet-languageselector.js"></script>
    <script src="lib/ow/example/files/map_i18n.js"></script>
    <script src="lib/ow/example/files/map.js"></script>
  
    <style>
        canvas {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
        }
    </style>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-black sidebar-mini">
<div class="wrapper">
        <header class="main-header">
          <a href="#" class="logo">
            <span class="logo-mini"><b>PI</b>Wt</span>
            <span class="logo-lg"><b>PI</b>Weather</span>
          </a>
          <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="hidden-xs"><?php echo $_SESSION["username"]; ?></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="user-header">
                      <p>
                        <?php echo $_SESSION["username"]; ?>
                        <small>Member since Dec. 2017</small>
                      </p>
                    </li>
                    <li class="user-footer">
                      <div class="pull-left">
                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                      </div>
                      <div class="pull-right">
                        <a href="../api/logout" class="btn btn-default btn-flat">Sign out</a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
        </header>
        <aside class="main-sidebar">
          <section class="sidebar">
            <ul class="sidebar-menu" data-widget="tree">
                <li>
                  <a href="../"><i class="fa fa-home"></i> <span>Home</span></a>
                </li>
                <li class="bg-green">
                  <a><i class="fa fa-map"></i> <span>Map</span></a>
                </li>
            </ul>
          </section>
        </aside>
        <div class="content-wrapper">
          <section class="content-header">
            <h1>
              Rasperry PI Weather
              <small>Weather map visualization</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-map"></i> Map</a></li>
            </ol>
          </section>
      
          <!-- Main content -->
          <section class="content">
              <div class="col-md-12">
                <div class="box box-default box-solid">
                  <div class="box-header with-border">
                      <h3 class="box-title">Map</h3>
                  </div>
                  <div class="box-body" style="height:100vh">
                      <div id="map"></div>  
                  </div>
                </div>
              </div>
          </section>
        </div>
        <footer class="main-footer">
          <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.0
          </div>
          <strong>Copyright &copy; 2017.</strong>
        </footer>
      </div>
      <!-- ./wrapper -->
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/admin-lte/dist/js/adminlte.min.js"></script>
    <script src="node_modules/moment/min/moment.min.js"></script>
    <script src="node_modules/toastr/build/toastr.min.js"></script>
    <script src="node_modules/chart.js/dist/Chart.min.js"></script>
    <script>
    initMap();
    $(document).ready(function () {
        $('.sidebar-menu').tree()
    })
    </script>
</body>
</html>