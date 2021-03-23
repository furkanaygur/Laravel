<h1>{{ config('app.name') }}</h1>
<p>Successfully Saved {{ $user->full_name }}</p>
<a href="{{ config('app.url') }}/users/activation/{{ $user->activation_key }}"> Click Here </a>
<p>{{ config('app.url') }}/users/activation/{{ $user->activation_key }}</p>