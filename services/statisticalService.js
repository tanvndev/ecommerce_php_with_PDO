try {
  fetch('admin/statistical/amountStatistical')
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      console.log(data);
      if (data.code == 200) {
        createChartAmount(data.data);
        createChartOrderTotal();
      }
    });
} catch (error) {
  console.log(error);
}

let dataAmount = [];
let dataTotalOrder = [];
function createChartAmount(dataQW) {
  const data = [
    {
      order_month: 1,
      total_orders: 0,
      total_amount: 0,
    },
    {
      order_month: 2,
      total_orders: 0,
      total_amount: 0,
    },
    {
      order_month: 3,
      total_orders: 0,
      total_amount: 0,
    },
    {
      order_month: 4,
      total_orders: 0,
      total_amount: 0,
    },
    {
      order_month: 5,
      total_orders: 0,
      total_amount: 0,
    },
    {
      order_month: 6,
      total_orders: 0,
      total_amount: 0,
    },
    {
      order_month: 7,
      total_orders: 0,
      total_amount: 0,
    },
    {
      order_month: 8,
      total_orders: 0,
      total_amount: 0,
    },
    {
      order_month: 9,
      total_orders: 0,
      total_amount: 0,
    },
    {
      order_month: 10,
      total_orders: 0,
      total_amount: 0,
    },
    {
      order_month: 11,
      total_orders: 0,
      total_amount: 0,
    },
    {
      order_month: 12,
      total_orders: 0,
      total_amount: 0,
    },
  ];
  data.forEach((item, index) => {
    const matchingItem = dataQW.find(
      (qwItem) => qwItem.order_month === item.order_month,
    );

    if (matchingItem) {
      // Update the values in the data array
      data[index].total_amount = +matchingItem.total_amount;
      data[index].total_orders = +matchingItem.total_orders;
    }
  });
  data.map((item) => {
    dataAmount.push(item.total_amount);
    dataTotalOrder.push(item.total_orders);
  });

  let options = {
    series: [
      {
        name: 'Doanh thu',
        data: dataAmount,
      },
    ],
    chart: {
      height: 320,
      type: 'area',
      dropShadow: {
        enabled: true,
        top: 10,
        left: 0,
        blur: 3,
        color: '#720f1e',
        opacity: 0.01,
      },
      toolbar: {
        show: true,
      },
      zoom: {
        enabled: true,
      },
    },
    markers: {
      strokeWidth: 4,
      strokeColors: '#ffffff',
      hover: {
        size: 9,
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      curve: 'smooth',
      lineCap: 'butt',
      width: 4,
    },
    legend: {
      show: false,
    },
    colors: ['#0da487'],
    fill: {
      type: 'gradient',
      gradient: {
        shadeIntensity: 1,
        opacityFrom: 0.7,
        opacityTo: 0.6,
        stops: [0, 90, 100],
      },
    },
    grid: {
      xaxis: {
        lines: {
          borderColor: 'transparent',
          show: true,
        },
      },
      yaxis: {
        lines: {
          borderColor: 'transparent',
          show: false,
        },
      },
      padding: {
        right: -112,
        bottom: 0,
        left: 15,
      },
    },
    responsive: [
      {
        breakpoint: 1200,
        options: {
          grid: {
            padding: {
              right: -95,
            },
          },
        },
      },
      {
        breakpoint: 992,
        options: {
          grid: {
            padding: {
              right: -69,
            },
          },
        },
      },
      {
        breakpoint: 767,
        options: {
          chart: {
            height: 200,
          },
        },
      },
      {
        breakpoint: 576,
        options: {
          yaxis: {
            labels: {
              show: false,
            },
          },
        },
      },
    ],
    yaxis: {
      labels: {
        formatter: function (value) {
          return formatCurrency(value);
        },
      },
      crosshairs: {
        show: true,
        position: 'back',
        stroke: {
          color: '#b6b6b6',
          width: 1,
          dashArray: 5,
        },
      },
      tooltip: {
        enabled: true,
      },
    },
    xaxis: {
      categories: [
        'Tháng 1',
        'Tháng 2',
        'Tháng 3',
        'Tháng 4',
        'Tháng 5',
        'Tháng 6',
        'Tháng 7',
        'Tháng 8',
        'Tháng 9',
        'Tháng 10',
        'Tháng 11',
        'Tháng 12',
      ],
      range: undefined,
      axisBorder: {
        low: 0,
        offsetX: 0,
        show: false,
      },
      axisTicks: {
        show: false,
      },
    },
  };

  const reportChart = document.querySelector('#report-chart');
  if (reportChart) {
    var chart = new ApexCharts(reportChart, options);
    chart.render();
  }
}

function createChartOrderTotal() {
  let options = {
    series: [
      {
        name: 'Lượt bán',
        data: dataTotalOrder,
      },
    ],

    chart: {
      height: 320,
      toolbar: {
        show: true,
      },
      zoom: {
        enabled: true,
      },
    },

    legend: {
      show: false,
    },

    colors: ['#0da487', '#2483e2'],

    markers: {
      size: 1,
    },

    // grid: {
    //   show: false,
    //   xaxis: {
    //     lines: {
    //       show: false,
    //     },
    //   },
    // },
    yaxis: {
      labels: {
        formatter: function (value) {
          return parseInt(value);
        },
      },
    },

    xaxis: {
      categories: [
        'T1',
        'T2',
        'T3',
        'T4',
        'T5',
        'T6',
        'T7',
        'T8',
        'T9',
        'T10',
        'T11',
        'T12',
      ],
      labels: {
        show: true,
      },
    },

    responsive: [
      {
        breakpoint: 1400,
        options: {
          chart: {
            height: 300,
          },
        },
      },

      {
        breakpoint: 992,
        options: {
          chart: {
            height: 210,
            width: '100%',
            offsetX: 0,
          },
        },
      },

      {
        breakpoint: 578,
        options: {
          chart: {
            height: 200,
            width: '105%',
            offsetX: -20,
            offsetY: 10,
          },
        },
      },

      {
        breakpoint: 430,
        options: {
          chart: {
            width: '108%',
          },
        },
      },

      {
        breakpoint: 330,
        options: {
          chart: {
            width: '112%',
          },
        },
      },
    ],
  };
  const earningChart = document.querySelector('#earning-chart');
  if (earningChart) {
    var chart2 = new ApexCharts(earningChart, options);
    chart2.render();
  }
}

//api
try {
  fetch('admin/statistical/getProdForCateChart')
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      if (data.code == 200) {
        createChartProductCate(data.data);
      }
    });
} catch (error) {
  console.log(error);
}

function createChartProductCate(data) {
  const series = [];
  const labels = [];
  data.map((dataProdCate) => {
    labels.push(dataProdCate.name);
    series.push(dataProdCate.product_count);
  });

  let options = {
    series,
    labels,
    chart: {
      width: '100%',
      height: 325,
      type: 'donut',
    },

    legend: {
      fontSize: '14px',
      position: 'bottom',
      offsetX: 1,
      offsetY: -1,

      markers: {
        width: 10,
        height: 10,
      },

      itemMargin: {
        vertical: 2,
      },
    },

    plotOptions: {
      pie: {
        startAngle: -90,
        endAngle: 320,
      },
    },

    dataLabels: {
      enabled: true,
    },

    responsive: [
      {
        breakpoint: 1835,
        options: {
          chart: {
            height: 320,
          },

          legend: {
            position: 'right',

            itemMargin: {
              horizontal: 5,
              vertical: 1,
            },
          },
        },
      },

      {
        breakpoint: 1388,
        options: {
          chart: {
            height: 330,
          },

          legend: {
            position: 'bottom',
          },
        },
      },

      {
        breakpoint: 1275,
        options: {
          chart: {
            height: 300,
          },

          legend: {
            position: 'bottom',
          },
        },
      },

      {
        breakpoint: 1158,
        options: {
          chart: {
            height: 280,
          },

          legend: {
            fontSize: '10px',
            position: 'bottom',
            offsetY: 10,
          },
        },
      },

      {
        theme: {
          mode: 'dark',
          palette: 'palette1',
          monochrome: {
            enabled: true,
            color: '#255aee',
            shadeTo: 'dark',
            shadeIntensity: 0.65,
          },
        },
      },

      {
        breakpoint: 598,
        options: {
          chart: {
            height: 280,
          },

          legend: {
            fontSize: '12px',
            position: 'bottom',
            offsetX: 5,
            offsetY: -5,

            markers: {
              width: 10,
              height: 10,
            },

            itemMargin: {
              vertical: 1,
            },
          },
        },
      },
    ],
  };

  const productCate = document.querySelector('#productCate');
  if (productCate) {
    var chart3 = new ApexCharts(productCate, options);
    chart3.render();
  }
}
