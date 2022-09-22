@component('mail::message')
Hi, {{ $data->username }},

{!! $data->body !!}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
