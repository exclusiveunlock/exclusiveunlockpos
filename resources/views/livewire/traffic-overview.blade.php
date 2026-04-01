<div wire:poll.10s class="p-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg transition duration-300 ease-in-out hover:shadow-xl">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Visits Today</h2>
            <p class="text-4xl font-bold text-primary-600 dark:text-primary-400">{{ $totalVisitsToday }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg transition duration-300 ease-in-out hover:shadow-xl">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Visits This Week</h2>
            <p class="text-4xl font-bold text-primary-600 dark:text-primary-400">{{ $totalVisitsWeek }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg transition duration-300 ease-in-out hover:shadow-xl">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Visits This Month</h2>
            <p class="text-4xl font-bold text-primary-600 dark:text-primary-400">{{ $totalVisitsMonth }}</p>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg mb-6">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-5">Filters</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div>
                <label for="startDate" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Start Date</label>
                <input type="date" id="startDate" wire:model.live="startDate" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white px-3 py-2">
            </div>
            <div>
                <label for="endDate" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">End Date</label>
                <input type="date" id="endDate" wire:model.live="endDate" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white px-3 py-2">
            </div>
            <div>
                <label for="filterSource" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Traffic Source</label>
                <select id="filterSource" wire:model.live="filterSource" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white px-3 py-2">
                    <option value="">All</option>
                    <option value="Organic">Organic</option>
                    <option value="Social">Social</option>
                    <option value="Direct">Direct</option>
                    <option value="Referral">Referral</option>
                </select>
            </div>
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Search (IP/URL)</label>
                <input type="text" id="search" wire:model.live="search" placeholder="Search IP or URL" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white px-3 py-2">
            </div>
        </div>
        <div class="mt-6 text-right">
            <button wire:click="resetFilters" class="px-6 py-2 bg-primary-600 text-white font-semibold rounded-lg shadow-md hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-opacity-75 transition duration-300 ease-in-out">Reset Filters</button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-5">Traffic Sources</h2>
            <canvas id="trafficSourceChart"></canvas>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-5">Top 5 Visited URLs</h2>
            <canvas id="topUrlsChart"></canvas>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-5">Latest Visits</h2>
        <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Timestamp</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">IP Address</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Visited URL</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Referer</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">User Agent</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($latestVisits as $visit)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">{{ $visit->created_at->format('Y-m-d H:i:s') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">{{ $visit->ip }}</td>
                            <td class="px-6 py-4 text-sm text-primary-600 dark:text-primary-400 truncate max-w-xs">{{ $visit->url }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">{{ $visit->referer ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200 truncate max-w-xs">{{ $visit->user_agent ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200 text-center">No visits found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $latestVisits->links() }}
        </div>
    </div>

    @script
    <script>
        // Chart.js initialization (place this in a separate JS file or within a <script> tag in your layout)
        // This is a basic setup. You'll need to ensure Chart.js is loaded.
        const trafficSourceCtx = document.getElementById('trafficSourceChart');
        const topUrlsCtx = document.getElementById('topUrlsChart');

        let trafficSourceChart;
        let topUrlsChart;

        const renderCharts = (trafficSources, topUrls) => {
            if (trafficSourceChart) trafficSourceChart.destroy();
            trafficSourceChart = new Chart(trafficSourceCtx, {
                type: 'pie',
                data: {
                    labels: Object.keys(trafficSources),
                    datasets: [{
                        data: Object.values(trafficSources),
                        backgroundColor: [
                            '#4CAF50', '#2196F3', '#FFC107', '#F44336', '#9C27B0'
                        ],
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: false,
                            text: 'Traffic Sources'
                        }
                    }
                }
            });

            if (topUrlsChart) topUrlsChart.destroy();
            topUrlsChart = new Chart(topUrlsCtx, {
                type: 'bar',
                data: {
                    labels: Object.keys(topUrls),
                    datasets: [{
                        label: 'Visits',
                        data: Object.values(topUrls),
                        backgroundColor: '#03A9F4',
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false,
                        },
                        title: {
                            display: false,
                            text: 'Top 5 Visited URLs'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += context.parsed.y;
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        };

        // Listen for Livewire updates to re-render charts
        Livewire.on('pg:livewire-charts-update', (data) => {
            renderCharts(data.trafficSources, data.topUrls);
        });

        // Initial render
        renderCharts(@json($trafficSources), @json($topUrls));
    </script>
    @endscript
</div>
