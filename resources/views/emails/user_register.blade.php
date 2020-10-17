<h1>{{ config('app.name') }}</h1>
<p>Hello {{ $user->full_name }},</p>
<p>Your account has been successfully registered.</p>
<p>To active your account, please click <a href="{{config('app.url')}}/user/active/{{$user->activation_code}}">here</a> or open the following link on the browser.</p>
Copy this link: <p>{{config('app.url')}}/user/active/{{$user->activation_code}}</p>
