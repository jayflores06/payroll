<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['fname'])) {
    $userId = $_SESSION['id'];
    $sName = "localhost";
    $uName = "root";
    $pass = "";
    $db_name = "je_db";

    try {
        $conn = new PDO("mysql:host=$sName;dbname=$db_name", $uName, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!------Monserrat------->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" rel="stylesheet">

    <!------Icons------->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined"
      rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <!-----CSS--------->
	<link href="dashboard.css" rel="stylesheet">
	<title>Admin Dashboard</title>  
</head>
<body>
    <div class="grid-container">

    <!------Header---------->
    <header class="header">
        <div class="menu-icon" onclick="openSidebar()">
            <span class="material-icons-outlined">menu</span>
        </div>

        <div class="header-right">
            <h3 class="display-4 ">Welcome, <?=$_SESSION['fname']."!"?></h3>
        </div>
    </header>
    <!------End Header---------->

    <!------Side Bar---------->
    <aside id="sidebar">
        <div class="sidebar-title">
            <div class="sidebar-brand">
            <span class="material-icons-outlined">account_balance</span>Kodego Payroll
            </div>
            <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
        </div>

        <ul class="sidebar-list">
            <li class="sidebar-list-item">
                <span class="material-icons-outlined">dashboard</span><a href="home.php">Dashboard</a>
            </li>
            <li class="sidebar-list-item">
            <span class="material-icons-outlined">schedule</span><a href="attendance.php">Attendance</a>
            </li>
            <li class="sidebar-list-item">
                <span class="material-icons-outlined">request_page</span><a href="request.php">Request</a></li>
            </li>
        </ul>
        <a href="logout.php" class="btn btn-warning">Logout</a>
    </aside>
    <!------End Side Bar---------->

    <!------Main---------->
    <main class="main-container">
        <div class="main-title">
            <h2>Dashboard</h2>
        </div>

        <div class="main-cards">
            <div class="card">
                <div class="card-inner">
                <h3>Present</h3>
                    <span class="material-icons-outlined">people_alt</span>
                    <h1>
                        <?php
                            $timeIn = '0000-00-00';
                            $query = $conn->prepare('SELECT * FROM attendance WHERE user_id = ? AND time_in != ?');
                            $query->execute([$userId, $timeIn]);
                            $present = $query->rowCount();
                            echo $present;
                        ?>

                    </h1>
                </div>
            </div>

            <div class="card">
                <div class="card-inner">
                <h3> Absent</h3>
                <span class="material-icons-outlined">calendar_month</span>
                    <h1>
                    <?php
                            $query = $conn->prepare('SELECT * FROM attendance WHERE user_id = ? AND time_in = ?');
                            $timeIn = '0000-00-00';
                            $query->execute([$userId, $timeIn]);
                            $absent = $query->rowCount();
                            echo $absent;
                        ?>
                    </h1>
                </div>
            </div>
        </div>

        <div class="charts">
            <div class="charts-card">
                <h2 class="chart-title">Attendance</h2>
                <div id="bar-chart"></div>
            </div>
        </div>
    </main>
    <!------End Main---------->
    </div>

    <!--------Scripts------------------->
    <!--------Apex Charts------------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.37.1/apexcharts.min.js"></script>
    <!------JS---------->

    <script>

    
    // SIDEBAR TOGGLE

    var sidebarOpen = false;
    var sidebar = document.getElementById("sidebar");

    function openSidebar() {
        if(!sidebarOpen) {
            sidebar.classList.add("sidebar-responsive");
            sidebarOpen = true;
        }
    }

    function closeSidebar() {
        if(!sidebarOpen) {
            sidebar.classList.remove("sidebar-responsive");
            sidebarOpen = false;
        }
    }

    // --------CHARTS------------




    <?php
        //Attendance Data
        $query
    ?>

    // --------Bar Chart
    var barChartOptions = {
        series: [{
        data: [<?=$present?>,<?=$absent?>],
        name: "Attendance",
        }],
        chart: {
        type: 'bar',
        background: "transparent",
        height: 350,
        toolbar: {
            show: false,
        },
        },
        colors: [
        "#2962ff",
        "#d50000",
        "#2e7d32",
        "#ff6d00",
        "#583cb3",
        ],
        plotOptions: {
        bar: {
            distributed: true,
            borderRadius: 4,
            horizontal: false,
            columnWidth: "40%",
        },
        },
        dataLabels: {
        enabled: false,
        },
        fill: {
        opacity: 1,
        },
        grid: {
        borderColor: "#55596e",
        yaxis: {
            lines: {
            show: true,
            },
        },
        xaxis: {
            lines: {
            show: true,
            },
        },
        },
        legend: {
        showForSingleSeries: false,
        labels: {
            colors: "#f5f7ff",
        },
        show: true,
        width: 2,
        },
        tooltip: {
        shared: true,
        intersect: false,
        theme: "dark",
        }, 
        xaxis: {
            categories:[<?=$present?>,<?=$absent?>],
            title: {
                style: {
                color: "#f5f7ff",
                },
            },
            axisBorder: {
                show: true,
                color: "#55596e",
            },
            axisTicks: {
                show: true,
                color: "#55596e",
            },
            labels: {
                style: {
                colors: "#f5f7ff",
                },
            },
        },
            yaxis: {
            title: {
                text: "Count",
                style: {
                color: "#f5f7ff",
                },
            },
            axisBorder: {
                show: true,
                color: "#55596e",
            },
            axisTicks: {
                show: true,
                color: "#55596e",
            },
            labels: {
                style: {
                colors: "#f5f7ff",
                },
            },
        },
    };
    
    var barChart = new ApexCharts(document.querySelector("#bar-chart"), barChartOptions);
    barChart.render();
    

    </script>

</body>
</html>

<?php }else {
	header("Location: login.php");
	exit;
} ?>