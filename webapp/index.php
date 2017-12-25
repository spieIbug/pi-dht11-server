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
                <li class="bg-green">
                  <a href="../"><i class="fa fa-home"></i> <span>Home</span></a>
                </li>
                <li>
                  <a href="./map"><i class="fa fa-map"></i> <span>Map</span></a>
                </li>
            </ul>
          </section>
        </aside>
        <div class="content-wrapper">
          <section class="content-header">
            <h1>
              Rasperry PI Weather
              <small>DHT11 visualization</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
            </ol>
          </section>
      
          <!-- Main content -->
          <section class="content">
              <div class="col-md-4">
                <div class="box box-default box-solid">
                  <div class="box-header with-border">
                      <h3 class="box-title">Settings & Controls</h3>
                  </div>
                  <div class="box-body">
                      <div class="form-group">
                          <label>Number of data to display</label>
                          <div class="input-group input-group-sm">
                            <input type="number" class="form-control" id="limit" min="10" max="1000">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-info btn-flat" onclick="updateLimit()">Validate</button>
                            </span>
                          </div>
                          <hr/>
                          <div class="form-group">
                              <label>Controls</label>
                              <div class="input-group input-group-sm">
                                <button  class="btn btn-success" onclick="on()"><i class="fa fa-toggle-on"></i> On</button>
                                <button  class="btn btn-danger" onclick="off()"><i class="fa fa-power-off"></i> Off</button>
                                <!--button  class="btn btn-warning" onclick="launch()"><i class="fa fa-play"></i> Launch capture</button-->
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
                <div class="box box-default box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">OpenWeather Data</h3>
                    </div>
                    <div class="box-body">
                        <dl class="dl-horizontal">
                            <dt>Temp</dt>
                            <dd id="owTemp"></dd>
                            <dt>Humidity</dt>
                            <dd id="owHumidity"></dd>
                            <dt>Pressure</dt>
                            <dd id="owPressure"></dd>
                            <dt>Wind degree</dt>
                            <dd id="owWindDegree"></dd>
                            <dt>Wind speed</dt>
                            <dd id="owWindSpeed"></dd>
                          </dl>
                    </div>
                  </div>
              </div>
              <div class="col-md-8">
                  <div class="box box-default box-solid">
                      <div class="box-header with-border">
                        <h3 class="box-title">Realtime visualization</h3>
                        <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                  title="Collapse">
                            <i class="fa fa-minus"></i></button>
                          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                        </div>
                      </div>
                      <div class="box-body">
                        <canvas id="canvas"></canvas> 
                      </div>
                  </div>
              </div>
            <!-- Default box -->
            <div class="box col-md-8">
              
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
    <script src="js/app.js"></script>
    <script src="js/weather.js"></script>
    <script>
    $(document).ready(function () {
        $('.sidebar-menu').tree()
    })
    </script>
</body>
</html>