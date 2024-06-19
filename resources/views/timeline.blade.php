@section('title')
    Loan status history
@endsection

@section('content-header')
<x-content-header>
    Loan status history
</x-content-header>
@endsection
@php
    $data = ['date'=> now()]
@endphp
<div class="">
    <x-inputs.timeline  data="@json($data)" />
</div>
