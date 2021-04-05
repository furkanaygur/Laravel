@if (session()->has('message'))
    <div class="alert alert-{{ session('message_type') }}">
        {{ session('message') }}
    </div>
@endif

@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error )
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif