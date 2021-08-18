@extends('layouts.email.main')

@section('content')

<table width="100%" cellpadding="0" cellspacing="0"
    style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
    <tr
        style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
        <td class="content-block"
            style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;"
            valign="top">
            Hi <b>{{$firstname}}</b>, <br>
        </td>
    </tr>
    <tr
        style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
        <td class="content-block"
            style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;"
            valign="top">
            Hello your accout has been created successfully :)<br><br>
            Copy this code <b>{{$token}}</b> or click on the button below to confirm your Email.

        </td>
    </tr>
    <tr
        style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
        <td class="content-block"
            style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;"
            valign="top">
            <center>
                {{-- <a href="{{ url('auth/verify-email',$token) }}" class="btn-primary" --}}
                <a href="{{ env('SPA_BASE_URL')."/auth/verify-email/".$token }}" class="btn-primary"
                    style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #5fbeaa; margin: 0; border-color: #5fbeaa; border-style: solid; border-width: 10px 20px;">Confirm
                    Email Address</a>
            </center>

        </td>
    </tr>
    <tr
        style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
        <td class="content-block"
            style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px; float: right"
            valign="top">
            Fitbud Team
        </td>
    </tr>
</table>

@endsection