"use strict";

function getData(dataR) {
    for (var dates = Array(), finaldata = [], i = dataR.length - 1; i >= 0; i--) finaldata.push(dataR[i]);
    dataR.forEach(element => {
        finaldata.push(element)
    });
    for (let index = 0; index < dataR.length; index++) {
        var date = new Date;
        date.setDate(date.getDate() + (index - dataR.length + 1)), dates.push(date.getDate() + "/" + (date.getMonth() + 1))
    } 

    var chartColors_default = {
      primary: "#00D1B2",
      info: "#209CEE",
      danger: "#FF3860"
  }
      var ctx = document.getElementById('big-line-chart').getContext('2d');
      var data = {
    "labels": dates,
    "datasets": [
      {
        "label": "cases",
        "backgroundColor": chartColors_default.primary,
        "fill": !1,
        "data": finaldata,
        "borderColor": chartColors_default.primary,
        "borderWidth": "2"
      }
    ]
  };
      var options = {
      "maintainAspectRatio": !1,
      "title": {
      "display": false,
      "position": "bottom",
      "fullWidth": true,
      "fontColor": "#aa7942",
      "fontSize": 16
    },
    "legend": {
      "display": false,
      "fullWidth": false,
      "position": "top"
    },
    "scales": {
      "yAxes": [
        {
          "ticks": {
            "beginAtZero": true,
            "display": true,

            "stepSize": 1
          },
          "gridLines": {
            "display": true,
            "lineWidth": 2,
            "drawOnChartArea": true,
            "drawBorder": !1,
            "drawTicks": true,
            "tickMarkLength": 1,
            "offsetGridLines": true,
            "zeroLineColor": "#949494",
            "color": "rgba(29,140,248,0.0)",
            "zeroLineWidth": 2
          },
          "scaleLabel": {
            "display": false,
            "labelString": ""
          },
          "display": true,
          "type": "linear",
          "position": "left"
        }
      ],
      "xAxes": {
        "0": {
          "ticks": {
            "display": true,
            "fontSize": 14,
            "fontStyle": "italic"
          },
          "display": true,
          "gridLines": {
            "display": true,
            "lineWidth": 2,
            "drawBorder": !1,
            "drawOnChartArea": false,
            "drawTicks": true,
            "tickMarkLength": 12,
            "zeroLineWidth": 2,
            "offsetGridLines": true,
            "color": "rgba(225,78,202,0.1)",
            "zeroLineColor": "#919191"
          },
          "scaleLabel": {
            "fontSize": 16,
            "display": true,
            "fontStyle": "normal"
          }
        }
      }
    },
    "responsive": !0,
    "tooltips": {
      "enabled": true,
      "mode": "single",
      "position": "nearest",
      "caretSize": 10,
      "backgroundColor": "#3b3b3b"
    },
    "animation": {
      "duration": "2500"
    }
    
}
var myChart = new Chart(ctx, {
  type: 'bar',
  data: data,
  options: options
});
}