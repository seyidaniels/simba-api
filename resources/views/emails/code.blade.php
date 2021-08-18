@component('mail::message')
# Reset Password

Hi <b>{{$firstname}}</b>, <br>

You requested for a password reset <br><br>

Your Code to reset is:<br>

<h3>{{$code}}</h3>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
