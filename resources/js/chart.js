import Chart from "chart.js/auto";
import formatCurrency from "./helper";

// Inherit font family
Chart.defaults.font.family = "inherit";
Chart.defaults.font.size = 40;

// Doughnut Chart
document.addEventListener("DOMContentLoaded", function () {
    const Doughnutctx = document.getElementById("myDoughnutChart");

    const lables = Object.keys(doughnutData);
    const data = Object.values(doughnutData);

    new Chart(Doughnutctx, {
        type: "doughnut",
        data: {
            labels: lables,
            datasets: [
                {
                    data,
                    backgroundColor: ["#4ade80", "#60a5fa", "#ef4444"],
                    borderColor: "#fff",
                    borderWidth: 2,
                    hoverOffset: 10,
                },
            ],
        },
        options: {
            responsive: true,
            cutout: "70%", // 🔘 Custom inner radius (can be number or %)
            plugins: {
                legend: {
                    position: "right",
                    labels: {
                        color: "#333",
                        font: {
                            size: 16,
                            weight: "bold",
                        },
                        padding: 20,
                        boxWidth: 20,
                    },
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            return `${context.label}: ${formatCurrency(
                                context.raw
                            )} `;
                        },
                    },
                },
                title: {
                    display: false,
                    font: {
                        size: 18,
                        family: "inherit",
                    },
                    padding: {
                        top: 10,
                        bottom: 30,
                    },
                },
            },
        },
    });

    // Graph Chart
    const ctx = document.getElementById("myChart").getContext("2d");
    const lineData = Object.values(graphData);

    new Chart(ctx, {
        type: "line",
        data: {
            labels: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec",
            ],
            datasets: [
                {
                    label: "Fees Deposit",
                    data: [...lineData[0]],
                    fill: true,
                    borderColor: "rgba(74, 222, 128, 1)",
                    backgroundColor: "rgba(74, 222, 128, 0.2)",
                    tension: 0.4,
                },
                {
                    label: "Salary Settled",
                    data: [...lineData[1]],
                    fill: true,
                    borderColor: "rgba(96, 165, 250, 1)",
                    backgroundColor: "rgba(96, 165, 250, 0.2)",
                    tension: 0.4,
                },
                {
                    label: "School Expenses",
                    data: [...lineData[2]],
                    fill: true,
                    borderColor: "rgba(239, 68, 68, 1)",
                    backgroundColor: "rgba(239, 68, 68, 0.2)",
                    tension: 0.4,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                title: { display: false },
                tooltip: {
                    mode: "index",
                    intersect: false,
                    callbacks: {
                        label: function (context) {
                            let label = context.dataset.label || "";
                            if (label) {
                                label += ": ";
                            }
                            const value = context.parsed.y || 0;
                            return label + "₹" + value.toLocaleString();
                        },
                    },
                },
            },
            interaction: {
                mode: "index",
                intersect: false,
            },
            scales: {
                x: {
                    grid: {
                        display: true,
                        color: "#ddd",
                        borderDash: [6, 4],
                    },
                    border: {
                        dash: [4, 6],
                    },
                    ticks: {
                        font: { family: "inherit", size: 16 },
                    },
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                        color: "#ddd",
                        borderDash: [6, 4],
                    },
                    border: {
                        dash: [4, 6],
                    },
                    ticks: {
                        font: { family: "inherit", size: 16 },
                        callback: function (value) {
                            return "₹" + value.toLocaleString();
                        },
                    },
                },
            },
        },
    });
});
