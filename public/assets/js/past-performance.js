// Equity Growth Chart for Past Performance Page
document.addEventListener("DOMContentLoaded", function () {
  let weekChart = null;
  const canvas = document.getElementById("weekEquityGrowthChart");
  
  // Initialize chart with current week data
  if (canvas) {
    initializeChart();
  }

  // Handle week card clicks
  document.querySelectorAll('.week-card').forEach(card => {
    card.addEventListener('click', function() {
      const weekId = this.dataset.weekId;
      if (weekId) {
        loadWeekData(weekId);
      }
    });
  });

  function initializeChart() {
    if (!canvas) return;
    
    const chartLabels = JSON.parse(canvas.dataset.chartLabels || '[]');
    const chartData = JSON.parse(canvas.dataset.chartData || '[]');
    
    // Fallback to default if no data
    const labels = chartLabels.length > 0 ? chartLabels : ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
    const data = chartData.length > 0 ? chartData : [0, 0.7, 1.2, 2.3, 2.98];
    
    const ctx = canvas.getContext("2d");
    
    if (weekChart) {
      weekChart.destroy();
    }
    
    weekChart = new Chart(ctx, {
      type: "line",
      data: {
        labels: labels,
        datasets: [
          {
            label: "Equity Growth (%)",
            data: data,
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
      const chartParent = canvas.parentElement;
      if (!chartParent || !canvas) return;
      canvas.width = chartParent.offsetWidth;
      canvas.height = chartParent.offsetHeight;
      if (weekChart) {
        weekChart.resize();
      }
    }
    window.addEventListener("resize", resizeChartCanvas);
    resizeChartCanvas();
  }

  function loadWeekData(weekId) {
    // Update active state
    document.querySelectorAll('.week-card').forEach(card => {
      card.classList.remove('active', 'bg-blue-600', 'border-2', 'border-blue-400');
    });
    
    const clickedCard = document.querySelector(`[data-week-id="${weekId}"]`);
    if (clickedCard) {
      clickedCard.classList.add('active', 'bg-blue-600', 'border-2', 'border-blue-400');
    }

    // Fetch week data via AJAX
    fetch(`/api/week/${weekId}`)
      .then(response => response.json())
      .then(data => {
        if (data.success && data.week) {
          updateWeekDisplay(data.week, data.performance);
          
          // Update chart if performance data exists
          if (data.performance && data.performance.chart_labels && data.performance.chart_data) {
            updateChart(data.performance.chart_labels, data.performance.chart_data);
          }
        }
      })
      .catch(error => {
        console.error('Error loading week data:', error);
      });
  }

  function updateWeekDisplay(week, performance) {
    // Update week summary section
    const weekSummarySection = document.getElementById('weekSummarySection');
    if (weekSummarySection) {
      const title = weekSummarySection.querySelector('[data-admin="weekSummaryTitle"]');
      if (title) {
        title.textContent = `Week ${week.start_date} - ${week.end_date}`;
      }
      
      const accountSize = weekSummarySection.querySelector('[data-admin="accountSize"]');
      if (accountSize) {
        accountSize.textContent = `Account Size: $${parseFloat(week.account_size).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
      }
      
      const netGain = weekSummarySection.querySelector('[data-admin="netGainLabel"]');
      if (netGain) {
        const sign = week.total_gain >= 0 ? '+' : '';
        netGain.textContent = `Net Weekly Gain ${sign}${parseFloat(week.total_gain).toFixed(2)}%`;
      }
      
      const endingDate = weekSummarySection.querySelector('[data-admin="endingDate"]');
      if (endingDate) {
        endingDate.textContent = `Ending: ${week.end_date_full}`;
      }
    }

    // Update performance breakdown section
    if (performance) {
      const breakdownSection = document.getElementById('performanceBreakdownSection');
      if (breakdownSection) {
        // Update stats
        const totalGain = breakdownSection.querySelector('[data-admin="totalGain"]');
        if (totalGain && performance.total_gain !== null) {
          const sign = performance.total_gain >= 0 ? '+' : '';
          totalGain.textContent = `${sign}${parseFloat(performance.total_gain).toFixed(2)}%`;
        }
        
        const accuracy = breakdownSection.querySelector('[data-admin="accuracy"]');
        if (accuracy && performance.trade_accuracy !== null) {
          accuracy.textContent = `${Math.round(performance.trade_accuracy)}%`;
        }
        
        const riskReward = breakdownSection.querySelector('[data-admin="riskReward"]');
        if (riskReward && performance.risk_reward_ratio !== null) {
          riskReward.textContent = parseFloat(performance.risk_reward_ratio).toFixed(1);
        }
        
        const drawdown = breakdownSection.querySelector('[data-admin="drawdown"]');
        if (drawdown && performance.largest_drawdown !== null) {
          drawdown.textContent = `${parseFloat(performance.largest_drawdown).toFixed(2)}%`;
        }

        // Update markets traded
        if (performance.markets_traded && performance.markets_traded.length > 0) {
          const marketsContainer = breakdownSection.querySelector('.space-y-3');
          if (marketsContainer) {
            marketsContainer.innerHTML = performance.markets_traded.map((market, index) => `
              <div class="bg-blue-900/20 border border-blue-500/10 rounded-lg px-4 py-3 flex items-center justify-between text-white/90">
                <span>${market.market || 'N/A'}</span>
                <span class="text-blue-300 font-semibold">${market.volume_percentage || 0}% of volume</span>
              </div>
            `).join('');
          }
        }

        // Update daily performance
        if (performance.daily_performance && performance.daily_performance.length > 0) {
          const dailyContainer = breakdownSection.querySelector('.divide-y');
          if (dailyContainer) {
            dailyContainer.innerHTML = performance.daily_performance.map(day => {
              const isNegative = day.change && day.change.includes('-');
              const textColor = isNegative ? 'text-red-400' : 'text-emerald-400';
              return `
                <div class="grid grid-cols-3 px-4 py-3 items-center">
                  <span>${day.day || 'N/A'}</span>
                  <span class="font-semibold text-center ${textColor}">${day.change || 'N/A'}</span>
                  <span class="text-right">${day.equity || 'N/A'}</span>
                </div>
              `;
            }).join('');
          }
        }
      }
    }
  }

  function updateChart(labels, data) {
    if (!weekChart) return;
    
    weekChart.data.labels = labels.length > 0 ? labels : ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
    weekChart.data.datasets[0].data = data.length > 0 ? data : [0, 0.7, 1.2, 2.3, 2.98];
    weekChart.update();
  }
});
