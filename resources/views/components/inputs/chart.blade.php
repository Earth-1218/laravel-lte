@props(['chartId', 'chartData'])

<div id="{{ $chartId }}" class="apex-chart"></div>

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts/dist/apexcharts.css">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('livewire:load', function () {
        console.log('Livewire loaded'); // Debugging line

        var options = {
            chart: {
                type: 'pie',
                height: 350,
            },
            series: @json(array_values($chartData)),
            labels: @json(array_keys($chartData))
        };

        var chart = new ApexCharts(document.querySelector("#{{ $chartId }}"), options);
        chart.render()
            .then(function() {
                console.log('Chart rendered successfully'); // Debugging line
            })
            .catch(function(error) {
                console.error('Error rendering chart:', error); // Debugging line
            });

        Livewire.on('updateChart', function (newData) {
            chart.updateSeries([{
                data: newData.series
            }]);
            chart.updateOptions({
                labels: newData.labels
            });
        });
    });
</script>
@endpush
