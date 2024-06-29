@props(['key' => 'dateRange', 'dateFormat'])

<div>
    <input type="text" name="{{ $key }}" id="{{ $key }}" class="form-control"  />
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
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
                format: "{{ $dateFormat }}",
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
            var selectedDateRange = start.format('{{ $dateFormat }}') + ' - ' + end.format('{{ $dateFormat }}');
            console.log('New date range selected: ' + selectedDateRange + ' (predefined range: ' + label + ')');

            @this.set('{{ $key }}', selectedDateRange);
        });

        calendarInput.on('apply.daterangepicker', function(ev, picker) {
            var selectedDateRange = picker.startDate.format('{{ $dateFormat }}') + ' - ' + picker.endDate.format('{{ $dateFormat }}');
            @this.set('{{ $key }}', selectedDateRange);
        });

        calendarInput.on('cancel.daterangepicker', function(ev, picker) {
            @this.set('{{ $key }}', '');
        });
    });
</script>
@endpush
    