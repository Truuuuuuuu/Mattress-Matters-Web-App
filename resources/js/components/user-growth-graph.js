
import ApexCharts from 'apexcharts';
function renderUserGrowthChart() {
    const el = document.querySelector("#userGrowthChart");
    if (!el) return;

    const data = JSON.parse(el.dataset.chart);

    const options = {
        chart: {
            height: 280,
            type: "area",
            toolbar: { show: false }
        },

        dataLabels: {
            enabled: false
        },

        series: [
            {
                name: "Users",
                data: data.values
            }
        ],

        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.7,
                opacityTo: 0.9,
                stops: [0, 90, 100]
            }
        },

        stroke: {
            curve: "smooth",
            width: 3
        },

        xaxis: {
            categories: data.labels
        },

        colors: ['#3b82f6'],

        grid: {
            borderColor: '#e5e7eb'
        },

        tooltip: {
            theme: 'light'
        }
    };

    new ApexCharts(el, options).render();
}

document.addEventListener('DOMContentLoaded', renderUserGrowthChart);
