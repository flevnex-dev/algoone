const header = document.querySelector("header");
if (header) {
  window.addEventListener("scroll", function () {
    if (window.pageYOffset > 100) {
      header.classList.add("scrolled");
    } else {
      header.classList.remove("scrolled");
    }
  });
}

// Chart data will be processed inside DOMContentLoaded to ensure window.payoutChartData is available

function formatCurrency(value, showSign = false) {
  const absValue = Math.abs(value);
  const sign = showSign && value !== 0 ? (value > 0 ? "+" : "-") : "";
  if (absValue >= 1000000) return `${sign}$${(absValue / 1000000).toFixed(1)}M`;
  if (absValue >= 1000) return `${sign}$${(absValue / 1000).toFixed(1)}K`;
  return `${sign}$${absValue.toLocaleString()}`;
}

document.addEventListener("DOMContentLoaded", () => {
  const canvas = document.getElementById("cumulativeChart");
  if (!canvas) return;

  const ctx = canvas.getContext("2d");
  if (!ctx) return;

  // Process dynamic chart data from server
  let payoutChartData = [];
  
  if (window.payoutChartData && window.payoutChartData.length > 0) {
    // Transform server data format (month: '2024-01', amount: 1000) to chart format
    payoutChartData = window.payoutChartData.map((item) => {
      const date = new Date(item.month + '-01');
      return {
        month: date.toLocaleDateString('en-US', { month: 'short' }),
        value: parseFloat(item.amount) || 0
      };
    });
  } else {
    // Default fallback data if no server data available
    payoutChartData = [
      { month: "Jan", value: 0 },
      { month: "Feb", value: 800000 },
      { month: "Mar", value: 850000 },
      { month: "Apr", value: 1000000 },
      { month: "May", value: 1200000 },
      { month: "Jun", value: 1400000 },
      { month: "Jul", value: 1700000 },
      { month: "Aug", value: 1900000 },
      { month: "Sep", value: 2100000 },
      { month: "Oct", value: 2300000 },
      { month: "Nov", value: 2500000 },
      { month: "Dec", value: 2700000 },
    ];
  }

  const payoutLabels = payoutChartData.map((d) => d.month);
  const payoutValues = payoutChartData.map((d) => d.value);

  // Calculate dynamic max value for chart
  const maxValue = Math.max(...payoutValues, 0);
  let maxTick = 3400000; // Default max
  
  if (maxValue > 0) {
    // Calculate appropriate max tick based on max value
    if (maxValue >= 1000000) {
      maxTick = Math.ceil(maxValue * 1.2 / 1000000) * 1000000;
    } else if (maxValue >= 1000) {
      maxTick = Math.ceil(maxValue * 1.2 / 1000) * 1000;
    } else {
      maxTick = Math.ceil(maxValue * 1.2);
    }
  }
  
  const targetTicks = [0, maxTick * 0.25, maxTick * 0.5, maxTick * 0.75, maxTick];
  const targetTickLabels = targetTicks.map((tick) => {
    if (tick >= 1000000) return `$${(tick / 1000000).toFixed(1)}M`;
    if (tick >= 1000) return `$${(tick / 1000).toFixed(1)}K`;
    return `$${tick}`;
  });

  let payoutChartInstance = null;
  let resizeTimeout = null;

  function buildGradient(chartArea) {
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
  }

  function makePayoutChart() {
    if (payoutChartInstance) {
      payoutChartInstance.destroy();
      payoutChartInstance = null;
    }

    payoutChartInstance = new Chart(ctx, {
      type: "line",
      data: {
        labels: payoutLabels,
        datasets: [
          {
            label: "Monthly Payout",
            data: payoutValues,
            fill: true,
            backgroundColor: (context) => {
              const area = context.chart?.chartArea;
              if (!area) return "rgba(11, 100, 244, 0.30)";
              return buildGradient(area);
            },
            borderColor: "#0B64F4",
            borderWidth: 3,
            tension: 0.4,
            pointRadius: 5,
            pointHoverRadius: 8,
            pointBackgroundColor: "#ffffff",
            pointBorderColor: "#0B64F4",
            pointBorderWidth: 2,
            pointHoverBackgroundColor: "#ffffff",
            pointHoverBorderColor: "#0B64F4",
            pointHoverBorderWidth: 3,
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        responsive: true,
        layout: {
          padding: { left: 16, right: 16, top: 16, bottom: 16 },
        },
        plugins: {
          legend: { display: false },
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
              title: (tooltipItems) =>
                tooltipItems?.length ? tooltipItems[0].label : "",
              label: (tooltipItem) => {
                const value = tooltipItem.parsed?.y;
                if (!Number.isFinite(value)) return "";
                const formatted = formatCurrency(value);
                return `Amount: ${formatted}`;
              },
            },
          },
        },
        interaction: {
          mode: "nearest",
          intersect: true,
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
            min: 0,
            max: maxTick,
            grid: {
              display: true,
              color: "rgba(148, 163, 184, 0.1)",
              drawBorder: false,
            },
            ticks: {
              color: "rgba(148, 163, 184, 0.8)",
              font: { family: "Montserrat", size: 11, weight: "500" },
              padding: 8,
              callback: (value) => {
                const idx = targetTicks.indexOf(value);
                if (idx !== -1) return targetTickLabels[idx];
                if (value % 1000000 === 0)
                  return `$${(value / 1000000).toFixed(1)}M`;
                return "";
              },
              autoSkip: false,
              maxTicksLimit: 5,
            },
            border: { display: false },
          },
        },
        animation: { duration: 600, easing: "easeOutQuart" },
      },
    });
  }

  function resizeChartCanvas() {
    const parent = canvas.parentElement;
    if (!parent) return;
    canvas.width = parent.offsetWidth;
    canvas.height = parent.offsetHeight;
    if (payoutChartInstance) payoutChartInstance.resize();
  }

  function handleResize() {
    if (resizeTimeout) clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
      resizeChartCanvas();
    }, 150);
  }

  makePayoutChart();
  resizeChartCanvas();
  window.addEventListener("resize", handleResize);
});
