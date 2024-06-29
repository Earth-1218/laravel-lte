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

{{-- @section('content') --}}
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <x-inputs.chart 
                            chart-id="transactionsPieChart"
                            chart-type="pie"
                            chart-height="350"
                            :series="$chartData['transactionsPieChart']['series']"
                            :labels="$chartData['transactionsPieChart']['labels']"
                        />
                    </div>
                    <div class="col-md-6">
                        <x-inputs.chart 
                            chart-id="transactionsDonutChart"
                            chart-type="donut"
                            chart-height="350"
                            :series="$chartData['transactionsDonutChart']['series']"
                            :labels="$chartData['transactionsDonutChart']['labels']"
                        />
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <x-inputs.chart 
                            chart-id="earningsChart"
                            chart-type="bar"
                            chart-height="400"
                            :series="$chartData['earningsChart']['series']"
                            :labels="$chartData['earningsChart']['labels']"
                        />
                    </div>
                    <div class="col-md-6">
                        <x-inputs.chart 
                            chart-id="salesChart"
                            chart-type="line"
                            chart-height="350"
                            :series="$chartData['salesChart']['series']"
                            :labels="$chartData['salesChart']['labels']"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @endsection --}}
