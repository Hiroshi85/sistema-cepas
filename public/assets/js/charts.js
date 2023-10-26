const config = {
  colors: {
    primary: '#111827',
    secondary: '#8592a3',
    success: '#22C55E',
    info: '#03c3ec',
    warning: '#BF8009',
    danger: '#ff3e1d',
    dark: '#233446',
    black: '#000',
    white: '#fff',
    body: '#f4f5fb',
    headingColor: '#566a7f',
    axisColor: '#a1acb8',
    borderColor: '#eceef1',
    purple: '#775DD0',
  }
};
// Growth Chart - Radial Bar Chart
// --------------------------------------------------------------------
var current = localStorage.getItem('theme');
var color = current == "dark" ? config.colors.body : config.colors.primary;
var growthChartOptions = {
  series: [0],
  labels: [''],
  chart: {
    height: 240,
    type: 'radialBar'
  },
  plotOptions: {
    radialBar: {
      size: 150,
      offsetY: 10,
      startAngle: -150,
      endAngle: 150,
      hollow: {
        size: '55%'
      },
      track: {
        background: 'transparent',
        strokeWidth: '100%'
      },
      dataLabels: {
        name: {
          offsetY: 15,
          color: color,
          fontSize: '15px',
          fontWeight: '600',
          fontFamily: 'Public Sans'
        },
        value: {
          offsetY: -25,
          color: color,
          fontSize: '22px',
          fontWeight: '500',
          fontFamily: 'Public Sans'
        }
      }
    }
  },
  colors: [color],
  fill: {
    type: 'gradient',
    gradient: {
      shade: current,
      shadeIntensity: 1,
      gradientToColors: [color],
      inverseColors: true,
      opacityFrom: 1,
      opacityTo: 0.5,
      stops: [30, 60, 100]
    }
  },
  stroke: {
    dashArray: 5
  },
  grid: {
    padding: {
      top: -30,
      bottom: -40
    }
  },
  states: {
    hover: {
      filter: {
        type: 'none'
      }
    },
    active: {
      filter: {
        type: 'none'
      }
    }
  }
};

function gcThemeModeOptions(theme) {
  let color = theme == "dark" ? config.colors.body : config.colors.primary;
  return {
    plotOptions: {
      radialBar: {
        dataLabels: {
          name: {
            color: color
          },
          value: {
            color: color
          }
        }
      }
    },
    colors: [color],
    fill: {
      gradient: {
        gradientToColors: [color],
      }
    },
  }
}

// Bar Chart - Actual vs Expected)
// --------------------------------------------------------------------
var optionsBarChart = {
  series: [
    // {
    //   name: 'Actual'
    //   data: {}
    // }
  ],
  chart: {
    height: 350,
    type: 'bar'
  },
  plotOptions: {
    bar: {
      horizontal: true,
    }
  },
  colors: [config.colors.primary, config.colors.danger],
  dataLabels: {
    enabled: false,
    formatter: function (val, opt) {
      const goals =
        opt.w.config.series[opt.seriesIndex].data[opt.dataPointIndex]
          .goals

      if (goals && goals.length) {
        return `${val} / ${goals[0].value}`
      }
      return val
    }
  },
  legend: {
    show: true,
    showForSingleSeries: true,
    customLegendItems: ['Admisión', 'Matrículas', 'Objetivo'],
    markers: {
      fillColors: [config.colors.primary, config.colors.danger, config.colors.warning]
    },
    labels: {
      colors: [current == "dark" ? config.colors.secondary : config.colors.primary, config.colors.danger, config.colors.warning]
    }
  },
  xaxis: {
    labels: {
      style: {
        colors: [current == "dark" ? config.colors.axisColor : ""]
      }
    }
  },
  yaxis: {
    labels: {
      style: {
        colors: [current == "dark" ? config.colors.axisColor : ""]
      }
    }
  }
};

function bcThemeModeOptions(theme) {
  let color = theme == "dark" ? config.colors.body : config.colors.primary;
  return {
    legend: {
      labels: {
        colors: [theme == "dark" ? config.colors.secondary : config.colors.primary, config.colors.danger, config.colors.warning]
      }
    },
    xaxis: {
      labels: {
        style: {
          colors: [theme == "dark" ? config.colors.axisColor : ""]
        }
      }
    },
    yaxis: {
      labels: {
        style: {
          colors: [theme == "dark" ? config.colors.axisColor : ""]
        }
      }
    },
    title:{
      style: {
        color: theme == "dark" ? config.colors.white : config.colors.primary 
      }
    }
  }
}