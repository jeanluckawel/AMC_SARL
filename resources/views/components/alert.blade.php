@php
    $alerts = [
        'success' => [
            'class' => 'alert-success',
            'icon' => 'bi-check-circle-fill',
        ],
        'error' => [
            'class' => 'alert-danger',
            'icon' => 'bi-x-circle-fill',
        ],
        'warning' => [
            'class' => 'alert-warning',
            'icon' => 'bi-exclamation-triangle-fill',
        ],
        'info' => [
            'class' => 'alert-info',
            'icon' => 'bi-info-circle-fill',
        ],
    ];
@endphp

<div class="flash-container">

    @foreach($alerts as $type => $alert)

        @if(session($type))

            <div
                class="alert {{ $alert['class'] }} alert-dismissible fade show flash-alert shadow"
                role="alert"
            >
                <i class="bi {{ $alert['icon'] }} me-2"></i>

                <span>{{ session($type) }}</span>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"
                ></button>
            </div>

        @endif

    @endforeach

</div>

<style>
    .flash-container {
        position: fixed;
        top: 20px;
        right: 20px;
        width: 360px;
        max-width: calc(100vw - 40px);
        z-index: 99999;
    }

    .flash-alert {
        border-radius: 0;
        margin-bottom: 10px;
    }

    @media (max-width: 576px) {
        .flash-container {
            top: 10px;
            right: 10px;
            left: 10px;
            width: auto;
            max-width: none;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const flashAlerts = document.querySelectorAll('.flash-alert');

        flashAlerts.forEach(function (alert) {

            setTimeout(function () {

                const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);

                bsAlert.close();

            }, 30000);

        });

    });
</script>
