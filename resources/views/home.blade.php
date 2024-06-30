@section('title', 'Home')

@section('content-header')
<x-content-header>
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Home</h3>
        <x-inputs.range-calendar 
            key="dateRange"
            date-format="YYYY-MM-DD"
        />
    </div>
</x-content-header>
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <x-inputs.chart 
                            chart-id="transactionTimelineChart"
                            chart-type="bar"
                            chart-height="400"
                            :series="$chartData['earningsChart']['series']"
                            :labels="$chartData['earningsChart']['labels']"
                        />
                    </div>
                    <div class="col-md-6">
                        <x-inputs.chart 
                            chart-id="transactionCaregorywiseChart"
                            chart-type="pie"
                            chart-height="350"
                            :series="$chartData['transactionsPieChart']['series']"
                            :labels="$chartData['transactionsPieChart']['labels']"
                        />
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <x-inputs.chart 
                            chart-id="commissionTimeline"
                            chart-type="line"
                            chart-height="350"
                            :series="$chartData['salesChart']['series']"
                            :labels="$chartData['salesChart']['labels']"
                        />
                    </div>
                    <div class="col-md-6">
                        <x-inputs.chart 
                            chart-id="commissionCategorywise"
                            chart-type="donut"
                            chart-height="350"
                            :series="$chartData['transactionsDonutChart']['series']"
                            :labels="$chartData['transactionsDonutChart']['labels']"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @endsection --}}
