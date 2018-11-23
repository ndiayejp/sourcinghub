@component('mail::message')
# Bonjour

- {{ $name }}
- {{ $email }}

@component('mail::panel')
{{ $msg }}
@endcomponent



Merci,<br>
{{ config('app.name') }}
@endcomponent
