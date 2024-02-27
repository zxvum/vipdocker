@props([
    'timeout' => 5000,
    'closeButton' => true,
    'progress' => true
])

<div>
    <script>
        document.addEventListener('success', (event) => {
            toastr.success(event.detail.message, 'Успех!', {
                timeOut: {{ $timeout }},
                closeButton: {{ $closeButton }},
                progressBar: {{ $progress }}
            });
        })
        document.addEventListener('warning', (event) => {
            toastr.warning(event.detail.message, 'Предупреждение!', {
                timeOut: {{ $timeout }},
                closeButton: {{ $closeButton }},
                progressBar: {{ $progress }}
            });
        })
        document.addEventListener('error', (event) => {
            toastr.error(event.detail.message, 'Ошибка!', {
                timeOut: {{ $timeout }},
                closeButton: {{ $closeButton }},
                progressBar: {{ $progress }}
            });
        })
    </script>
</div>
