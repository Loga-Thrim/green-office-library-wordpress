/**
 * Charts Script for Green Library Theme
 * Using Chart.js for data visualization
 */

(function() {
    'use strict';

    // Wait for DOM and Chart.js to be ready
    document.addEventListener('DOMContentLoaded', function() {
        
        // Sample data (in real application, this would come from database)
        const chartData = {
            electricity: {
                labels: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
                datasets: [
                    { label: '2565', data: [15000, 21000, 45000, 24000, 36000, 33000, 32000, 37000, 31000, 25000, 36000, 37000], backgroundColor: '#4a7c59' },
                    { label: '2566', data: [16000, 24000, 27000, 23000, 36000, 20000, 33000, 38000, 30000, 33000, 32000, 27000], backgroundColor: '#f39c12' },
                    { label: '2567', data: [14000, 18000, 44000, 27000, 34000, 45000, 31000, 37000, 28000, 40000, 38000, 17000], backgroundColor: '#3498db' },
                    { label: '2568', data: [14000, 21000, 26000, 19000, 29000, 32000, 29000, 32000, 32000, 26000, 33000, 18000], backgroundColor: '#16a085' }
                ]
            },
            water: {
                labels: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
                datasets: [
                    { label: '2565', data: [2000, 2100, 1800, 2000, 1900, 2200, 2100, 2300, 1900, 2500, 2400, 2000], backgroundColor: '#3498db' },
                    { label: '2566', data: [2200, 2000, 2000, 2100, 2200, 2000, 2000, 2100, 1900, 2000, 2300, 2100], backgroundColor: '#f39c12' },
                    { label: '2567', data: [1900, 2100, 2700, 2100, 2100, 2900, 2400, 3100, 2200, 2500, 2600, 2000], backgroundColor: '#e74c3c' },
                    { label: '2568', data: [2100, 2500, 2000, 2100, 2000, 2100, 2500, 2500, 2500, 2400, 2700, 1800], backgroundColor: '#16a085' }
                ]
            },
            paper: {
                labels: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
                datasets: [
                    { label: '2565', data: [4500, 4200, 3000, 4400, 4800, 3200, 3500, 3800, 4000, 4200, 4600, 3500], backgroundColor: '#e91e63' },
                    { label: '2566', data: [3800, 3200, 4000, 3500, 3200, 2800, 3200, 3500, 3800, 4100, 3600, 3300], backgroundColor: '#9c27b0' },
                    { label: '2567', data: [2600, 3300, 4200, 3000, 2800, 3500, 3300, 4200, 3200, 3200, 3800, 3000], backgroundColor: '#3498db' },
                    { label: '2568', data: [2500, 2700, 3200, 3300, 2900, 3000, 3500, 3200, 3000, 3100, 4200, 2700], backgroundColor: '#16a085' }
                ]
            },
            waste: {
                labels: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
                datasets: [
                    { label: '2565', data: [10000, 10000, 9000, 11000, 13000, 15000, 15000, 18000, 12000, 21000, 17000, 18000], backgroundColor: '#e91e63' },
                    { label: '2566', data: [9500, 9800, 10500, 13500, 14000, 14500, 15000, 18500, 15000, 20500, 20000, 18500], backgroundColor: '#9c27b0' },
                    { label: '2567', data: [15000, 13500, 10000, 15000, 16000, 23500, 14500, 19000, 16500, 23000, 19500, 22000], backgroundColor: '#3498db' },
                    { label: '2568', data: [14500, 9500, 9500, 13500, 14500, 15500, 15500, 16000, 16500, 17500, 21500, 18500], backgroundColor: '#16a085' }
                ]
            }
        };

        // Chart configuration
        const chartOptions = {
            responsive: true,
            maintainAspectRatio: true,
            aspectRatio: 2,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        font: {
                            family: "'Sarabun', sans-serif",
                            size: 12
                        },
                        padding: 15
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: {
                            family: "'Sarabun', sans-serif"
                        }
                    }
                },
                x: {
                    ticks: {
                        font: {
                            family: "'Sarabun', sans-serif"
                        }
                    }
                }
            }
        };

        // Initialize charts
        const charts = {};

        // Electricity Chart
        const electricityCtx = document.getElementById('electricityChart');
        if (electricityCtx) {
            charts.electricity = new Chart(electricityCtx, {
                type: 'bar',
                data: chartData.electricity,
                options: chartOptions
            });
        }

        // Water Chart
        const waterCtx = document.getElementById('waterChart');
        if (waterCtx) {
            charts.water = new Chart(waterCtx, {
                type: 'bar',
                data: chartData.water,
                options: chartOptions
            });
        }

        // Paper Chart
        const paperCtx = document.getElementById('paperChart');
        if (paperCtx) {
            charts.paper = new Chart(paperCtx, {
                type: 'bar',
                data: chartData.paper,
                options: chartOptions
            });
        }

        // Waste Chart
        const wasteCtx = document.getElementById('wasteChart');
        if (wasteCtx) {
            charts.waste = new Chart(wasteCtx, {
                type: 'bar',
                data: chartData.waste,
                options: chartOptions
            });
        }

        // Note: Filter functionality would require backend API
        // For now, filters are displayed but not functional
        console.log('Green Library Charts initialized');
    });

})();
