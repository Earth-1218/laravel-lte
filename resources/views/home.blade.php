@section('title')
    Home
@endsection

@section('content-header')
<x-content-header>
    Home
</x-content-header>
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <x-inputs.range-calendar  key="calendar" />
            </div>

            <div class="card-body">
                <x-inputs.chart chartId="exampleChart" :chartData="$chartData" />
            </div>
        </div>
    </div>
</div>
