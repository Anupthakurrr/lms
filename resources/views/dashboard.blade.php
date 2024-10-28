<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
          
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div class="bg-gray-800 p-4 rounded-lg shadow-md text-center text-white">
                    <h3 class="text-lg font-bold">Total Courses</h3>
                    <p class="text-2xl">{{ $coursesCount }}</p>
                </div>
                <div class="bg-gray-800 p-4 rounded-lg shadow-md text-center text-white">
                    <h3 class="text-lg font-bold">Total Instructors</h3>
                    <p class="text-2xl">{{ $instructorsCount }}</p>
                </div>
                <div class="bg-gray-800 p-4 rounded-lg shadow-md text-center text-white">
                    <h3 class="text-lg font-bold">Total Users</h3>
                    <p class="text-2xl">{{ $usersCount }}</p>
                </div>
            </div>

            <div class="chart-container mb-8">
                <canvas id="myChart" class="bg-white dark:bg-gray-900"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="lineChart" class="bg-white dark:bg-gray-900"></canvas>
            </div>
        </div>
    </div>



    <script>
        // Bar Chart
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Courses', 'Instructors', 'Users'],
                datasets: [{
                    label: 'Count',
                    data: [{{ $coursesCount }}, {{ $instructorsCount }}, {{ $usersCount }}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)',
                        },
                        ticks: {
                            color: 'white',
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)',
                        },
                        ticks: {
                            color: 'white',
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: 'white',
                        }
                    }
                }
            }
        });

        // Line Chart
        const lineCtx = document.getElementById('lineChart').getContext('2d');
        const lineChart = new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'User Registrations',
                    data: [12, 19, 3, 5, 2, 3, 10],
                    fill: false,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)',
                        },
                        ticks: {
                            color: 'white',
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)',
                        },
                        ticks: {
                            color: 'white',
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: 'white',
                        }
                    }
                }
            }
        });
    </script>

    <style>
        .chart-container {
            position: relative;
            width: 100%;
            height: 400px; /* Adjust the height as needed */
        }
    </style>
</x-app-layout>
