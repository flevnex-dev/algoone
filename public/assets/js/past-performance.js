// Equity Growth Chart for Past Performance Page
document.addEventListener("DOMContentLoaded", function () {
  var ctx = document.getElementById("weekEquityGrowthChart");
  if (!ctx) return;

  ctx = ctx.getContext("2d");
  var myChart = new Chart(ctx, {
    type: "line",
    data: {
      labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
      datasets: [
        {
          label: "Equity Growth (%)",
          data: [0, 0.7, 1.2, 2.3, 2.98],
          fill: true,
          backgroundColor: (context) => {
            const { chart } = context;
            const { ctx, chartArea } = chart;
            if (!chartArea) return null;
            const r = 11;
            const g = 100;
            const b = 244;
            const gradient = ctx.createLinearGradient(
              0,
              chartArea.top,
              0,
              chartArea.bottom
            );
            gradient.addColorStop(0, `rgba(${r}, ${g}, ${b}, 0.30)`);
            gradient.addColorStop(0.5, `rgba(${r}, ${g}, ${b}, 0.15)`);
            gradient.addColorStop(1, `rgba(${r}, ${g}, ${b}, 0.00)`);
            return gradient;
          },
          borderColor: "#0B64F4",
          borderWidth: 3,
          pointRadius: 5,
          pointHoverRadius: 8,
          pointBackgroundColor: "#ffffff",
          pointBorderColor: "#0B64F4",
          pointBorderWidth: 2,
          pointHoverBackgroundColor: "#ffffff",
          pointHoverBorderColor: "#0B64F4",
          pointHoverBorderWidth: 3,
          tension: 0.4,
        },
      ],
    },
    options: {
      maintainAspectRatio: false,
      responsive: true,
      plugins: {
        legend: {
          display: false,
        },
        tooltip: {
          enabled: true,
          backgroundColor: "#ffffff",
          titleColor: "#64748b",
          bodyColor: "#0B64F4",
          borderColor: "rgba(203, 213, 225, 0.3)",
          borderWidth: 1,
          padding: 12,
          cornerRadius: 8,
          caretSize: 6,
          displayColors: false,
          titleFont: { family: "Montserrat", size: 13, weight: "400" },
          bodyFont: { family: "Montserrat", size: 13, weight: "500" },
          bodySpacing: 4,
          titleSpacing: 6,
          callbacks: {
            title: (ctx) => (ctx?.length ? ctx[0].label : ""),
            label: (ctx) => {
              const value = ctx.parsed?.y;
              if (!Number.isFinite(value)) return "";
              const formatted = value.toFixed(1);

              // Calculate change from previous point
              const prevIndex = ctx.dataIndex - 1;
              const prevValue =
                prevIndex >= 0
                  ? ctx.chart.data.datasets[ctx.datasetIndex].data[prevIndex]
                  : null;

              if (prevValue === null || ctx.dataIndex === 0) {
                return `Growth: ${formatted}%`;
              }

              const change = value - prevValue;
              const changeFormatted = change.toFixed(1);
              const sign = change > 0 ? "+" : "";

              return [
                `Growth: ${formatted}%`,
                `Change: ${sign}${changeFormatted}%`,
              ];
            },
          },
        },
      },
      layout: {
        padding: {
          left: 16,
          right: 16,
          top: 16,
          bottom: 16,
        },
      },
      scales: {
        x: {
          display: true,
          grid: {
            display: true,
            color: "rgba(148, 163, 184, 0.1)",
            drawBorder: false,
          },
          ticks: {
            color: "rgba(148, 163, 184, 0.8)",
            font: { family: "Montserrat", size: 10, weight: "500" },
            padding: 8,
          },
          border: { display: false },
        },
        y: {
          display: true,
          beginAtZero: true,
          grid: {
            display: true,
            color: "rgba(148, 163, 184, 0.1)",
            drawBorder: false,
          },
          ticks: {
            color: "rgba(148, 163, 184, 0.8)",
            font: { family: "Montserrat", size: 11, weight: "500" },
            padding: 8,
          },
          border: { display: false },
        },
      },
    },
  });

  // Make sure canvas resizes with parent div width
  function resizeChartCanvas() {
    var chartParent = document.getElementById(
      "weekEquityGrowthChart"
    ).parentElement;
    var canvas = document.getElementById("weekEquityGrowthChart");
    if (!chartParent || !canvas) return;
    canvas.width = chartParent.offsetWidth;
    canvas.height = chartParent.offsetHeight;
    myChart.resize();
  }
  window.addEventListener("resize", resizeChartCanvas);
  resizeChartCanvas();
});
