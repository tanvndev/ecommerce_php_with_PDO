try {
  fetch('admin/getProdForCateChart')
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      createChartAmount(data);
    });
} catch (error) {
  console.log(error);
}

function createChartAmount(dataQW) {
  const data = [];

  dataQW.forEach((element) => {
    data.push(element);
  });
  let options = {
    series: [
      {
        name: 'series1',
        data: [60, 70, 54, 51, 42, 109, 100],
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
        opacity: 0.15,
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
          return value + 'đ';
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
        'Jan',
        'Feb',
        'Mar',
        'April',
        'May',
        'June',
        'July',
        'Aug',
        'Sep',
        'Oct',
        'Nov',
        'Dec',
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
// var options = {
//   series: [
//     {
//       // name: "High - 2013",
//       data: [35, 41, 62, 42, 13, 18, 29, 37, 36, 51, 32, 35],
//     },

//     {
//       // name: "Low - 2013",
//       data: [87, 57, 74, 99, 75, 38, 62, 47, 82, 56, 45, 47],
//     },
//   ],

//   chart: {
//     height: 320,
//     toolbar: {
//       show: true,
//     },
//     zoom: {
//       enabled: true,
//     },
//   },

//   legend: {
//     show: false,
//   },

//   colors: ['#0da487', '#2483e2'],

//   markers: {
//     size: 1,
//   },

//   // grid: {
//   //   show: false,
//   //   xaxis: {
//   //     lines: {
//   //       show: false,
//   //     },
//   //   },
//   // },

//   xaxis: {
//     categories: [
//       'Jan',
//       'Feb',
//       'Mar',
//       'April',
//       'May',
//       'June',
//       'July',
//       'Aug',
//       'Sep',
//       'Oct',
//       'Nov',
//       'Dec',
//     ],
//     labels: {
//       show: false,
//     },
//   },

//   responsive: [
//     {
//       breakpoint: 1400,
//       options: {
//         chart: {
//           height: 300,
//         },
//       },
//     },

//     {
//       breakpoint: 992,
//       options: {
//         chart: {
//           height: 210,
//           width: '100%',
//           offsetX: 0,
//         },
//       },
//     },

//     {
//       breakpoint: 578,
//       options: {
//         chart: {
//           height: 200,
//           width: '105%',
//           offsetX: -20,
//           offsetY: 10,
//         },
//       },
//     },

//     {
//       breakpoint: 430,
//       options: {
//         chart: {
//           width: '108%',
//         },
//       },
//     },

//     {
//       breakpoint: 330,
//       options: {
//         chart: {
//           width: '112%',
//         },
//       },
//     },
//   ],
// };
// const earningChart = document.querySelector('#earning-chart');
// if (earningChart) {
//   var chart2 = new ApexCharts(earningChart, options);
//   chart2.render();
// }

//api
try {
  fetch('admin/getProdForCateChart')
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      createChartProductCate(data);
    });
} catch (error) {
  console.log(error);
}

function createChartProductCate(data) {
  const series = [];
  const labels = [];
  data.map((dataProdCate) => {
    labels.push(dataProdCate.category_name);
    series.push(dataProdCate.product_count);
  });

  let options = {
    series,
    labels,
    chart: {
      width: '100%',
      height: 350,
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
        endAngle: 270,
      },
    },

    dataLabels: {
      enabled: false,
    },

    responsive: [
      {
        breakpoint: 1835,
        options: {
          chart: {
            height: 245,
          },

          legend: {
            position: 'bottom',

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
