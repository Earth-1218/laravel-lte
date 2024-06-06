@props(['options', 'key', 'textField'])

<div class="input-group mb-3">
    <select
        {{ $attributes }}
        wire:model.defer="{{ $key }}"
        name="{{ $key }}"
        class="form-control @errorClass($key)"
        placeholder="{{ trans("validation.attributes.$key") }}"
        multiple
    >
        @foreach($options as $option)
            <option value="{{ $option->id }}">{{ $option->$textField }}</option>
        @endforeach
    </select>

    <x-inputs.fa fontAwesome="fa-list" />

    <x-inputs.error field="{{ $key }}" />
</div>

@push('scripts')
    <script>
        // Add the script to initialize Select2
        $(document).ready(function () {
            $('select[name="{{ $key }}"]').select2({
                placeholder:"Select Multiple"
            });
        });

        // Livewire hook to reinitialize Select2 after Livewire updates the DOM
        Livewire.hook('afterDomUpdate', () => {
            $('select[name="{{ $key }}"]').select2({
                placeholder:"{{ $key }}"
            });
        });
    </script>
@endpush
