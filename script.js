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

// --------Bar Chart
var barChartOptions = {
    series: [{
      data: [9, 1, 8, 1],
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
  


