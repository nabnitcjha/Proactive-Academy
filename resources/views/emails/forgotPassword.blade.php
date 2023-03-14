@component('mail::message')
# Introduction

Hi, {{$user->name}} <br><br>
Please click on below buttom to reset the password

@component('mail::button', ['url' => '/#/reset-password/'.$user->id])
Change Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
