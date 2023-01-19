<?php
include("connection.php");
include("jadwal.php");

put_to_json();

session_start();

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="bg-white p-1" style="color:black">WEB 2</div>
                <div class="sidebar-brand-text mx-3">Kel 2</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Data Casis -->
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">
                    <span>Lihat Jadwal</span></a>
            </li>

            <!-- Nav Item - Data Jadwal -->
            <li class="nav-item active">
                <a class="nav-link" href="admin/data_jadwal.php">
                    <span>Data Jadwal</span></a>
            </li>

            <!-- Divider -->
            <!-- <hr class="sidebar-divider"> -->

            <!-- Nav Item - Settings -->
            <!-- <li class="nav-item active">
                <a class="nav-link" href="#">
                    <span>Settings</span></a>
            </li> -->

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Logout -->
                    <form action="" method="post">
                        <button type="submit" name="logout" class="btn btn-danger logout-btn">Logout</button>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <?php                            
                    $file = 'jadwal.json';
                    $json_data = file_get_contents($file);
                    $jadwal = json_decode($json_data, true);
                    if(!empty($jadwal)) {  
                    // foreach ($jadwal as $class => $days) {
                        $page = isset($_GET['page']) ? $_GET['page'] : 1; // set default page to 1
                        $items_per_page = 1; // number of items to display per page
                        $total_items = count($jadwal); // total number of items in the $jadwal array
                        $total_pages = ceil($total_items/$items_per_page); // calculate total number of pages
                        $offset = ($page - 1) * $items_per_page; // calculate the offset for the current page
                        $paginated_jadwal = array_slice($jadwal, $offset, $items_per_page); // slice the $jadwal array according to the offset and items per page
                        foreach ($paginated_jadwal as $class => $days) {
                ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="pagination-wrapper">
                        <?php if($page > 1): ?>
                            <a href="?page=<?php echo $page-1; ?>" class="prev-page btn btn-primary">Prev</a>
                        <?php endif; ?>
                        <?php if($page < $total_pages): ?>
                            <a href="?page=<?php echo $page+1; ?>" class="prev-page btn btn-primary">Next</a>
                            <?php endif; ?>
                    </div>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-center mb-4" align="center">
                        <?php
                            echo "<h1 class='h3 mb-0 text-gray-800'>";
                            echo $class;
                            echo "</h1>";
                        ?>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Hari</th>
                                    <th scope="col">Slot Waktu</th>
                                    <th scope="col">Mata Kuliah</th>
                                    <th scope="col">Dosen</th>
                                    <th scope="col">Ruang</th>
                                    <th scope="col">JJ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $file = 'jadwal.json';
                                    $json_data = file_get_contents($file);
                                    $jadwal = json_decode($json_data, true);

                                    echo "<tr>";
                                    foreach ($days as $day => $schedule) {
                                        echo "<tr>";
                                        echo "<td rowspan='13' style='vertical-align:middle; text-align:center;'>$day</td>"; 
                                        $max_slot = 12;
                                        $current_slot = 1;
                                        foreach ($schedule as $session) {
                                            $max = intval($session['max']);
                                            $min = intval($session['min']);
                                            $jj = $max - $min + 1;
                                            // buat ngisi row kosong sebelum $min
                                            if ($min >= $current_slot) {
                                                for ($i = $current_slot + 1; $i <= $min; $i++) {
                                                    cekWaktu($i);
                                                    echo "<tr>";
                                                    echo "<td>" . $_SESSION['slot_waktu'] . "</td>";
                                                    echo "<td></td>";
                                                    echo "<td></td>";
                                                    echo "<td></td>";
                                                    echo "<td></td>";
                                                    echo "</tr>";
                                                }
                                                $current_slot = $min;
                                            }
                                            // buat loop setiap matkul, dosen, ruang sebanyak max
                                            for ($i = $current_slot; $i <= $max; $i++) {
                                                if ($i >= $min) {
                                                    $current_slot++;
                                                    if ($current_slot > $max_slot) {
                                                        break;
                                                    }
                                                    cekWaktu($current_slot);
                                                    echo "<tr>";
                                                    echo "<td>" . $_SESSION['slot_waktu'] . "</td>";
                                                    echo "<td>" . $session['matkul'] . "</td>";
                                                    echo "<td>" . $session['dosen'] . "</td>";
                                                    echo "<td>" . $session['ruang'] . "</td>"; 
                                                    if($i == $min) {
                                                        echo "<td>" . $jj . "</td>";
                                                    } else {
                                                        echo "<td></td>";
                                                    }
                                                    echo "</tr>";
                                                } else {
                                                    cekWaktu($current_slot);
                                                    echo "<tr>";
                                                    echo "<td>" . $_SESSION['slot_waktu'] . "</td>";
                                                    echo "<td></td>";
                                                    echo "<td></td>";
                                                    echo "<td></td>";
                                                    echo "<td></td>";
                                                    echo "</tr>";
                                                }
                                            }
                                            
                                        }
                                        for ($i = $current_slot + 1; $i <= $max_slot; $i++) {
                                            cekWaktu($i);
                                            echo "<tr>";
                                            echo "<td>". $_SESSION['slot_waktu'] . "</td>";
                                            echo "<td></td>";
                                            echo "<td></td>";
                                            echo "<td></td>";
                                            echo "<td></td>";
                                            echo "</tr>";
                                        }
                                        echo "<tr>";
                                    }
                                    echo "</tr>";
                                ?>
                            </tbody>
                        </table>
                        
                    </div>
                    <!-- /.container-row -->
                </div>
                <!-- /.container-fluid -->
                <?php } ?>
                <?php
                    } else {?>
                <div class="container-fluid">
                    <h1>Tolong masukkan data jadwal terlebih dahulu pada data jadwal!!!</h1>
                </div>
                <?php } ?>
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>