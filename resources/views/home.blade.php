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
                            :series="$chartData['transactionTimelineChart']['series']"
                            :labels="$chartData['transactionTimelineChart']['labels']"
                        />
                    </div>
                    <div class="col-md-6">
                        <x-inputs.chart 
                            chart-id="transactionCaregorywiseChart"
                            chart-type="pie"
                            chart-height="350"
                            :series="$chartData['transactionCategorywiseChart']['series']"
                            :labels="$chartData['transactionCategorywiseChart']['labels']"
                        />
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <x-inputs.chart 
                            chart-id="commissionTimelineChart"
                            chart-type="line"
                            chart-height="350"
                            :series="$chartData['commissionTimelineChart']['series']"
                            :labels="$chartData['commissionTimelineChart']['labels']"
                        />
                    </div>
                    <div class="col-md-6">
                        <x-inputs.chart 
                            chart-id="commissionCategorywiseChart"
                            chart-type="donut"
                            chart-height="350"
                            :series="$chartData['commissionCategorywiseChart']['series']"
                            :labels="$chartData['commissionCategorywiseChart']['labels']"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @endsection --}}
