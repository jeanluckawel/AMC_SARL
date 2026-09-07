@extends('layouts.admin')

@section('content')

    <div class="container">

        <h1>Audit Logs</h1>

        <div id="audit-logs">

            @foreach($auditLogs as $log)

                <div
                    id="audit-log-{{ $log->id }}"
                    class="audit-log"
                >

                    <strong>
                        {{ $log->user?->name ?? 'Système' }}
                    </strong>

                    <span>
                    {{ $log->description }}
                </span>

                    <small>
                        {{ $log->logged_at?->format('d/m/Y H:i:s') }}
                    </small>

                </div>

            @endforeach

        </div>

        {{ $auditLogs->links() }}

    </div>

@endsection
