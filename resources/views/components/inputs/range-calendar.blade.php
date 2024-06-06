@props(['key'])

<div class="text-left input-group mb-3">
    <input
        {{ $attributes }}
        type="text"
        id="{{ $key }}"
        name="{{ $key }}"
        class="form-control @errorClass($key)"
        placeholder="{{ trans("validation.attributes.$key") }}"
    >

    <x-inputs.fa fontAwesome="fa-edit" />

    <x-inputs.error field="{{ $key }}" />
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:load', function () {
        var calendarInput = $('input[name="{{ $key }}"]');

        calendarInput.daterangepicker({
            opens: 'right',
            showDropdowns: true,
            showWeekNumbers: true,
            showISOWeekNumbers: true,
            timePickerSeconds: true,
            maxSpan: {
                days: 7
            },
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            locale: {
                format: "DD/MM/YYYY",
                separator: " - ",
                applyLabel: "Apply",
                cancelLabel: "Cancel",
                fromLabel: "From",
                toLabel: "To",
                customRangeLabel: "Custom",
                weekLabel: "W",
                daysOfWeek: [
                    "Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"
                ],
                monthNames: [
                    "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
                ],
                firstDay: 1
            },
            alwaysShowCalendars: true,
            startDate: moment().startOf('month'),
            endDate: moment().endOf('month')
        }, function(start, end, label) {
            var selectedDateRange = start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD');
            console.log('New date range selected: ' + selectedDateRange + ' (predefined range: ' + label + ')');

            // Trigger Livewire update
            @this.set('{{ $attributes->whereStartsWith('wire:model')->first() }}', selectedDateRange);
        });

        // Trigger change when the page loads to set the initial value
        calendarInput.on('apply.daterangepicker', function(ev, picker) {
            var selectedDateRange = picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD');
            @this.set('{{ $attributes->whereStartsWith('wire:model')->first() }}', selectedDateRange);
        });

        // Clear the date range when "Cancel" is clicked
        calendarInput.on('cancel.daterangepicker', function(ev, picker) {
            @this.set('{{ $attributes->whereStartsWith('wire:model')->first() }}', '');
        });
    });
</script>
@endpush
