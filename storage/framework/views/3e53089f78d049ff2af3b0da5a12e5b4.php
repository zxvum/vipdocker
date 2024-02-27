<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'timeout' => 5000,
    'closeButton' => true,
    'progress' => true
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'timeout' => 5000,
    'closeButton' => true,
    'progress' => true
]); ?>
<?php foreach (array_filter(([
    'timeout' => 5000,
    'closeButton' => true,
    'progress' => true
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div>
    <script>
        document.addEventListener('success', (event) => {
            toastr.success(event.detail.message, 'Успех!', {
                timeOut: <?php echo e($timeout); ?>,
                closeButton: <?php echo e($closeButton); ?>,
                progressBar: <?php echo e($progress); ?>

            });
        })
        document.addEventListener('warning', (event) => {
            toastr.warning(event.detail.message, 'Предупреждение!', {
                timeOut: <?php echo e($timeout); ?>,
                closeButton: <?php echo e($closeButton); ?>,
                progressBar: <?php echo e($progress); ?>

            });
        })
        document.addEventListener('error', (event) => {
            toastr.error(event.detail.message, 'Ошибка!', {
                timeOut: <?php echo e($timeout); ?>,
                closeButton: <?php echo e($closeButton); ?>,
                progressBar: <?php echo e($progress); ?>

            });
        })
    </script>
</div>
<?php /**PATH /var/www/html/resources/views/components/toasts.blade.php ENDPATH**/ ?>