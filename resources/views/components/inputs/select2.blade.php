@props(['placeholder' => 'Select Options', 'id'])

<div wire:ignore>
    <select {{ $attributes }} id="{{ $id }}" class="form-control select2" data-placeholder="{{ $placeholder }}" style="width: 100%;">
        {{ $slot }}
    </select>
</div>

<script>
    $(function() {
        $('.select2').select2({
            theme: 'bootstrap4',
        })

        $('#{{ $id }}').on('change', function () {
            @this.set('{{ $id }}', $('#{{ $id }}').val())
        })
    })
</script>
