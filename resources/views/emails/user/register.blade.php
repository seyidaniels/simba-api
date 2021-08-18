@component('mail::message')
# Dear {{ $user->fullName() }}

Your Registration to Sensei has been successful

Keep asking Questions


Thanks,<br>
{{ config('app.name') }}
@endcomponent
