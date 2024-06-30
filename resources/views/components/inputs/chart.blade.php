{{-- @props(['chartId', 'chartData', 'chartType', 'chartHeight', 'series', 'labels']) --}}

<div id="{{ $chartId }}" class="apex-chart"></div>

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts/dist/apexcharts.css">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var chart;
        var options = {
            chart: {
                type: '{{ $chartType }}',
                height: {{ $chartHeight }},
            },
            series: {!! json_encode($series) !!},
            @if (in_array($chartType, ['bar', 'line']))
                xaxis: {
                    categories: {!! json_encode($labels) !!}
                }
            @else
                labels: {!! json_encode($labels) !!}
            @endif
        };

        function renderChart() {
            if (chart) {
                chart.destroy();
            }

            chart = new ApexCharts(document.querySelector("#{{ $chartId }}"), options);
            chart.render()
                .then(function(event) {
                    console.log('Chart rendered successfully');
                })
                .catch(function(error) {
                    console.error('Error rendering chart:', error);
                });
        }

        renderChart();

        Livewire.on('updateChart', (chartData) => {
            var chart;
            var options = {
                chart: {
                    type: '{{ $chartType }}',
                    height: {{ $chartHeight }},
                },
                series: {!! json_encode($series) !!},
                @if (in_array($chartType, ['bar', 'line']))
                    xaxis: {
                        categories: {!! json_encode($labels) !!}
                    }
                @else
                    labels: {!! json_encode($labels) !!}
                @endif
            };

            renderChart();
        });
    });
</script>
@endpush
