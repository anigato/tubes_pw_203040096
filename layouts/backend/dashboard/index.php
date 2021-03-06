<?php
require '../session_isset.php';
// require '../../../php/function.php';
require '../function.php';

$totalProduk = query('SELECT COUNT(id) as jumlah FROM products')[0];
$totalStok = query('SELECT SUM(stok) as jumlah FROM products')[0];
$totalUser = query('SELECT count(id) as jumlah FROM users')[0];
$totalAdmin =  query('SELECT COUNT(id) as jumlah FROM user_admin')[0];

$jumlahSSD = query('SELECT COUNT(id) as jumlah FROM products WHERE category = "SSD"')[0];
$jumlahHDD = query('SELECT COUNT(id) as jumlah FROM products WHERE category = "HDD"')[0];
$jumlahSSHD = query('SELECT COUNT(id) as jumlah FROM products WHERE category = "SSHD"')[0];
$jumlahNVME = query('SELECT COUNT(id) as jumlah FROM products WHERE category = "SSD NVME"')[0];

$stockLow = query('SELECT * FROM products ORDER BY stok ASC LIMIT 6');

$WarningStokProduct = query('SELECT * FROM products WHERE stok BETWEEN 0 AND 10 ORDER BY stok ASC LIMIT 5');

$stokTerbanyak = query('SELECT * FROM products WHERE stok BETWEEN 11 AND 1000 ORDER BY stok DESC');

$waitConfirmOrder = query("SELECT COUNT(id) as jumlah FROM orders where status = 0")[0];
$waitSentOrder = query("SELECT COUNT(id) as jumlah FROM orders where status = 1")[0];
$waitPaymentOrder = query("SELECT COUNT(id) as jumlah FROM orders where status = 2")[0];
$newOrder = query("SELECT COUNT(id) as jumlah FROM orders where status = 3")[0];
$onShipOrder = query("SELECT COUNT(id) as jumlah FROM orders where status = 4")[0];
$successOrder = query("SELECT COUNT(id) as jumlah FROM orders where status = 5")[0];
$CancelOrder = query("SELECT COUNT(id) as jumlah FROM orders where status = 6")[0];

$topSale = query("SELECT SUM(order_details.qty) AS jumlah, order_details.id_product FROM orders,order_details WHERE orders.status = 4 OR orders.status = 5 GROUP BY order_details.id_product ORDER BY jumlah DESC LIMIT 4");

$orderToday = query("SELECT SUM(total_qty) as qty, SUM(total_price) as price, COUNT(id) as jumlah FROM orders where status IN(0,1,4,5) AND DATE(order_time) = DATE(NOW())")[0];
$orderYesaterday = query("SELECT SUM(total_qty) as qty, SUM(total_price) as price, COUNT(id) as jumlah FROM orders where status IN(0,1,4,5) AND DATE(order_time) = DATE(NOW()-INTERVAL 1 day)")[0];
$order2Days = query("SELECT SUM(total_qty) as qty, SUM(total_price) as price, COUNT(id) as jumlah FROM orders where status IN(0,1,4,5) AND DATE(order_time) = DATE(NOW()-INTERVAL 2 day)")[0];
$order3Days = query("SELECT SUM(total_qty) as qty, SUM(total_price) as price, COUNT(id) as jumlah FROM orders where status IN(0,1,4,5) AND DATE(order_time) = DATE(NOW()-INTERVAL 3 day)")[0];
$order4Days = query("SELECT SUM(total_qty) as qty, SUM(total_price) as price, COUNT(id) as jumlah FROM orders where status IN(0,1,4,5) AND DATE(order_time) = DATE(NOW()-INTERVAL 4 day)")[0];
$order5Days = query("SELECT SUM(total_qty) as qty, SUM(total_price) as price, COUNT(id) as jumlah FROM orders where status IN(0,1,4,5) AND DATE(order_time) = DATE(NOW()-INTERVAL 5 day)")[0];
$order6Days = query("SELECT SUM(total_qty) as qty, SUM(total_price) as price, COUNT(id) as jumlah FROM orders where status IN(0,1,4,5) AND DATE(order_time) = DATE(NOW()-INTERVAL 6 day)")[0];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ADMIN Panel</title>

  <?php require_once '../../../themes/backend/parts/link-header.php' ?>
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../../../themes/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../../themes/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../../../themes/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../../../themes/plugins/summernote/summernote-bs4.min.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <!-- <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div> -->

    <!-- Navbar -->
    <?php require_once '../../../themes/backend/parts/navbar.php'; ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php require_once '../../../themes/backend/parts/sidebar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info py-3">
                <div class="inner">
                  <h3><?= $totalProduk['jumlah'] ?><sup style="font-size: 20px"> Units</sup></h3>
                </div>
                <div class="icon">
                  <i class="fas fa-tags"></i>
                </div>
                <div class="small-box-footer">Total Of All Products <i class="fas fa-arrow-circle-right"></i></div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success py-3">
                <div class="inner">
                  <h3><?= $totalStok['jumlah'] ?><sup style="font-size: 20px"> Pcs</sup></h3>
                </div>
                <div class="icon">
                  <i class="fas fa-cubes"></i>
                </div>
                <div class="small-box-footer">Total Of All Producs Stock <i class="fas fa-arrow-circle-right"></i></div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning py-3">
                <div class="inner">
                  <h3><?= $totalAdmin['jumlah'] ?><sup style="font-size: 20px"> Users</sup></h3>
                </div>
                <div class="icon">
                  <i class="fas fa-user-tie"></i>
                </div>
                <div class="small-box-footer">Total Of User Admin <i class="fas fa-arrow-circle-right"></i></div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger py-3">
                <div class="inner">
                  <h3><?= $totalUser['jumlah'] ?><sup style="font-size: 20px"> Users</sup></h3>

                  <p></p>
                </div>
                <div class="icon">
                  <i class="fas fa-user"></i>
                </div>
                <div class="small-box-footer">Total Of All User <i class="fas fa-arrow-circle-right"></i></div>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <div class="row">
            <div class="col-md-6">
              <!-- DONUT CHART -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Total Products per Category</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="categoryChart" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
            <div class="col-md-6">
              <!-- BAR CHART -->
              <div class="card card-warning">
                <div class="card-header">
                  <h3 class="card-title">Product Stock is Low!!</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <table class="table table-condensed" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;">
                    <?php foreach ($stockLow as $product) : ?>
                      <tr class="<?= ($product['stok'] < 10) ? 'text-danger font-weight-bold' : '' ?>">
                        <td><?= $product['name'] ?></td>
                        <td><?= $product['stok'] ?> Pcs</td>
                      </tr>
                    <?php endforeach; ?>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>


          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info py-3">
                <div class="inner">
                  <h3><?= $newOrder['jumlah'] ?></h3>
                </div>
                <div class="icon">
                  <i class="far fa-bookmark"></i>
                </div>
                <a href="../orders/index_unpaid.php" class="small-box-footer">New Order Unpaid <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success py-3">
                <div class="inner">
                  <h3><?= $waitPaymentOrder['jumlah'] ?></h3>
                </div>
                <div class="icon">
                  <i class="fas fa-money-bill-wave"></i>
                </div>
                <a href="../orders/index_wait_payment.php" class="small-box-footer">Waiting Payment Order <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning py-3">
                <div class="inner">
                  <h3><?= $waitConfirmOrder['jumlah'] ?></h3>
                </div>
                <div class="icon">
                <i class="fas fa-dolly-flatbed"></i>
                </div>
                <a href="../orders/index_wait_confirm.php" class="small-box-footer">Waiting Confirmation Order <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger py-3">
                <div class="inner">
                  <h3><?= $waitSentOrder['jumlah'] ?></h3>

                  <p></p>
                </div>
                <div class="icon">
                <i class="fas fa-shipping-fast"></i>
                </div>
                <a href="../orders/index_process.php" class="small-box-footer">Waiting Sent Order <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>


          <div class="row">
            <div class="col-md-6">
              <!-- DONUT CHART -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Percentage Orders</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="successCancel" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
            <div class="col-md-6">
              <!-- BAR CHART -->
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Top Sale Product!!</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="topSale" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>

          <!-- /.row -->
          <!-- Main row -->

          <div class="row">
            <section class="col-lg-12 connectedSortable">
              <!-- solid sales graph -->
              <div class="card">
                <div class="card-header border-0">
                  <h3 class="card-title">
                    <i class="fas fa-th mr-1"></i>
                    Sales this Week
                  </h3>

                  <div class="card-tools">
                    <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="saleChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-footer -->
              </div>
              <!-- /.card -->

            </section>
          </div>

          <section class="col-lg-12 connectedSortable">
            <!-- solid sales graph -->
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-th mr-1"></i>
                  Earning this Week
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="earningChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->

          </section>
        </div>
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php require_once '../../../themes/backend/parts/footer.php'; ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery UI 1.11.4 -->
  <script src="../../../themes/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- ChartJS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.0/chart.min.js" integrity="sha512-yadYcDSJyQExcKhjKSQOkBKy2BLDoW6WnnGXCAkCoRlpHGpYuVuBqGObf3g/TdB86sSbss1AOP4YlGSb6EKQPg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Sparkline -->
  <script src="../../../themes/plugins/sparklines/sparkline.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="../../../themes/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="../../../themes/plugins/moment/moment.min.js"></script>
  <script src="../../../themes/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="../../../themes/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="../../../themes/plugins/summernote/summernote-bs4.min.js"></script>
  
  <?php require_once '../../../themes/backend/parts/script-body.php' ?>
  <script>
    $(function() {

      var categoryChartCanvas = $('#categoryChart').get(0).getContext('2d')
      var donutData = {
        labels: [
          "SSD (<?= $jumlahSSD['jumlah'] ?>)", "HDD (<?= $jumlahHDD['jumlah'] ?>)", "SSHD (<?= $jumlahSSHD['jumlah'] ?>)", "SSD NVME (<?= $jumlahNVME['jumlah'] ?>)"
        ],
        datasets: [{
          data: [
            <?= $jumlahSSD['jumlah'] ?>, <?= $jumlahHDD['jumlah'] ?>, <?= $jumlahSSHD['jumlah'] ?>, <?= $jumlahNVME['jumlah'] ?>
          ],
          backgroundColor: ['#00f5d4', '#9b5de5', '#38b000', '#f15bb5'],
        }]
      }
      var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
      }
      new Chart(categoryChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
      })


      var barData = {
        labels: [
          "",
          <?php foreach ($topSale as $row) {
            $id_product = $row['id_product'];
            $product = query("SELECT * FROM products WHERE id = $id_product")[0];
            echo "'" . strtoupper(shortString($product['name'], 15)) . "',";
          } ?> ""
        ],
        datasets: [{
          label: 'Top Sales Product',
          backgroundColor: '#00ff2f',
          borderColor: 'rgba(60,141,188,0.8)',
          pointRadius: false,
          pointColor: '#3b8bba',
          pointStrokeColor: 'rgba(217, 15, 15,1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data: [
            0,
            <?php foreach ($topSale as $row) {
              echo $row['jumlah'] . ",";
            } ?>
            0
          ]
        }]
      }

    })

    var topSaleCanvas = $('#topSale').get(0).getContext('2d')
    var topSaleData = {
      labels: [
        <?php foreach ($topSale as $row) {
          $id_product = $row['id_product'];
          $product = query("SELECT * FROM products WHERE id = $id_product")[0];
          echo "'" . strtoupper(shortString($product['name'], 100)) . "',";
        } ?>
      ],
      datasets: [{
        data: [
          <?php foreach ($topSale as $row) {
            echo $row['jumlah'] . ",";
          } ?>
        ],
        backgroundColor: ['#28a745', '#17a2b8', '#ffc107', '#dc3545'],
        hoverOffset: 5,
      }]
    }
    var pieOptions = {
      maintainAspectRatio: false,
      responsive: true,
    }
    new Chart(topSaleCanvas, {
      type: 'pie',
      data: topSaleData,
      options: pieOptions
    })


    var successCancelCanvas = $('#successCancel').get(0).getContext('2d')
    var successCancelData = {
      labels: [
        "Successful (<?= $successOrder['jumlah'] ?>)", "Shipped (<?= $onShipOrder['jumlah'] ?>)", "Canceled (<?= $CancelOrder['jumlah'] ?>)"
      ],
      datasets: [{
        data: [<?= $successOrder['jumlah'] ?>, <?= $onShipOrder['jumlah'] ?>, <?= $CancelOrder['jumlah'] ?>],
        backgroundColor: ['#28a745', '#17a2b8', '#dc3545'],
        hoverOffset: 5,
      }]
    }
    var polarOptions = {
      maintainAspectRatio: false,
      responsive: true,
    }
    new Chart(successCancelCanvas, {
      type: 'polarArea',
      data: successCancelData,
      options: polarOptions
    })

    // Sales graph chart
    var salesGraphChartCanvas = $('#saleChart').get(0).getContext('2d')
    var saleData = {
      datasets: [{
        label: 'Order',
        data: [<?= $order6Days['jumlah'] ?>, <?= $order5Days['jumlah'] ?>, <?= $order4Days['jumlah'] ?>, <?= $order3Days['jumlah'] ?>, <?= $order2Days['jumlah'] ?>, <?= $orderYesaterday['jumlah'] ?>, <?= $orderToday['jumlah'] ?>],
        backgroundColor: [
          'rgba(255, 99, 132, 0.8)',
          'rgba(232, 62, 140, 0.8)',
          'rgba(52, 58, 64, 0.8)',
          'rgba(111, 66, 193, 0.8)',
          'rgba(255, 193, 7, 0.8)',
          'rgba(23, 162, 184, 0.8)',
          'rgba(40, 167, 70, 0.8)'
        ],
        borderColor: [
          'rgba(255,99,132,1)',
          'rgba(232, 62, 140, 1)',
          'rgba(52, 58, 64, 1)',
          'rgba(111, 66, 193, 1)',
          'rgba(255, 193, 7, 1)',
          'rgba(23, 162, 184, 1)',
          'rgba(40, 167, 70, 1)'
        ],
        borderWidth: 1,
        order: 2
      }, {
        type: 'line',
        label: 'Product',
        backgroundColor: '#dc3545',
        borderColor: '#dc3545',
        pointRadius: false,
        pointColor: 'rgba(210, 214, 222, 1)',
        pointStrokeColor: 'rgba(255,99,132,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data: [<?= $order6Days['qty'] ?>, <?= $order5Days['qty'] ?>, <?= $order4Days['qty'] ?>, <?= $order3Days['qty'] ?>, <?= $order2Days['qty'] ?>, <?= $orderYesaterday['qty'] ?>, <?= $orderToday['qty'] ?>],
        borderWidth: 3,
        tension: 0.4,
        order: 1
      }],
      labels: ['6 Days Ago', '5 Days Ago', '4 Days Ago', '3 Days Ago', '2 Days Ago', 'Yesterday', 'Today'],
    }

    var salesGraphChartOptions = {
      maintainAspectRatio: false,
      datasetFill: false,
      responsive: true,
      legend: {
        display: false
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
    var salesGraphChart = new Chart(salesGraphChartCanvas, {
      type: 'bar',
      data: saleData,
      options: salesGraphChartOptions
    })


    var earningChartCanvas = $('#earningChart').get(0).getContext('2d')
    var earningData = {
      datasets: [{
        type: 'line',
        label: 'Total Earnings',
        pointRadius: false,
        backgroundColor: '#dc3545',
        borderColor: 'rgb(23, 162, 184)',
        pointRadius: true,
        pointColor: 'rgba(210, 214, 222, 1)',
        pointStrokeColor: 'rgba(255,99,132,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data: [<?= $order6Days['price'] ?>, <?= $order5Days['price'] ?>, <?= $order4Days['price'] ?>, <?= $order3Days['price'] ?>, <?= $order2Days['price'] ?>, <?= $orderYesaterday['price'] ?>, <?= $orderToday['price'] ?>],
        borderWidth: 3,
        tension: 0.3,
        order: 1
      }],
      labels: ['6 Days Ago', '5 Days Ago', '4 Days Ago', '3 Days Ago', '2 Days Ago', 'Yesterday', 'Today'],
    }

    var salesGraphChartOptions = {
      maintainAspectRatio: false,
      responsive: true,
      plugins: {
        legend: {
          display: false
        }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
    var salesGraphChart = new Chart(earningChartCanvas, {
      type: 'bar',
      data: earningData,
      options: salesGraphChartOptions
    })
  </script>
</body>

</html>