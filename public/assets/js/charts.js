document.addEventListener("DOMContentLoaded", () => {
  const chartConfigs = {
    account1: {
      data: [0, 45, 85, 125, 154.63],
      color: "#0B64F4",
      label: "Account #1",
    },
    account2: {
      data: [0, 35, 95, 200, 325.97],
      color: "#0B64F4",
      label: "Account #2",
    },
    account3: {
      data: [0, 15, 30, 45, 56.26],
      color: "#0B64F4",
      label: "Account #3",
    },
  };

  const labels = ["Jul '23", "Sep '23", "Nov '23", "Jan '24", "Apr '24"];

  document.querySelectorAll(".account-chart").forEach((canvas) => {
    const chartId = canvas.dataset.chartId;
    const config = chartConfigs[chartId];
    if (!config || typeof Chart === "undefined") return;

    canvas.style.width = "100%";
    canvas.style.height = "100%";

    const ctx = canvas.getContext("2d");

    new Chart(ctx, {
      type: "line",
      data: {
        labels,
        datasets: [
          {
            label: config.label,
            data: config.data,
            borderColor: config.color,
            backgroundColor: (context) => {
              const { chart } = context;
              const { ctx, chartArea } = chart;
              if (!chartArea) return null;
              const r = parseInt(config.color.slice(1, 3), 16);
              const g = parseInt(config.color.slice(3, 5), 16);
              const b = parseInt(config.color.slice(5, 7), 16);
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
            fill: true,
            tension: 0.4,
            borderWidth: 3,
            pointRadius: 5,
            pointHoverRadius: 8,
            pointBackgroundColor: "#ffffff",
            pointBorderColor: config.color,
            pointBorderWidth: 2,
            pointHoverBackgroundColor: "#ffffff",
            pointHoverBorderColor: config.color,
            pointHoverBorderWidth: 3,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { display: false },
          tooltip: {
            enabled: true,
            backgroundColor: "rgba(255, 255, 255, 0.98)",
            titleColor: "#0f172a",
            bodyColor: config.color,
            borderColor: "rgba(203, 213, 225, 0.5)",
            borderWidth: 1,
            padding: 12,
            cornerRadius: 8,
            caretSize: 6,
            displayColors: false,
            titleFont: { family: "Montserrat", size: 13, weight: "400" },
            bodyFont: { family: "Montserrat", size: 14, weight: "300" },
            bodySpacing: 6,
            callbacks: {
              title: (ctx) => (ctx?.length ? ctx[0].label : ""),
              label: (ctx) => {
                const raw = ctx.parsed?.y;
                if (!Number.isFinite(raw))
                  return `Growth: ${ctx.formattedValue}%`;

                const formatted = Number.isInteger(raw) ? raw : raw.toFixed(2);

                // Calculate change from previous point
                const prev =
                  ctx.dataIndex > 0
                    ? ctx.chart.data.datasets[ctx.datasetIndex].data[
                        ctx.dataIndex - 1
                      ]
                    : null;

                if (prev === null || ctx.dataIndex === 0) {
                  return `Growth: ${formatted}%`;
                }

                const delta = raw - prev;
                const deltaFormatted = Number.isInteger(delta)
                  ? delta
                  : delta.toFixed(2);
                const sign = delta > 0 ? "+" : "";

                return [
                  `Growth: ${formatted}%`,
                  `Change: ${sign}${deltaFormatted}%`,
                ];
              },
            },
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
              callback: (value) => `${value}%`,
            },
            border: { display: false },
          },
        },
        interaction: {
          mode: "index",
          intersect: false,
        },
        onHover: (event, activeElements) => {
          event.native.target.style.cursor = activeElements.length
            ? "pointer"
            : "default";
        },
        animation: {
          duration: 1200,
          easing: "easeInOutQuart",
        },
      },
    });
  });
});
