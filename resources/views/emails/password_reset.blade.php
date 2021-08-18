@component('mail::message')
# Reset Password

Hi <b>{{$firstname}}</b>, <br>

You requested for a password reset :)<br><br>
Click on the below link to reset your password

@component('mail::button', ['url' => env('APP_URL')."password/reset/".$token])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
