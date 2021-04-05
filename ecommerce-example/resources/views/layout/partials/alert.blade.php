@if (session()->has('message'))
<style>
    .alert-box {
      position: absolute;
      z-index: 9999;
      width: 100%;
      text-align: center;
    }
  </style>

  <div class="alert-box">
    <div class="alert alert-{{ session('message_type') }}">
        {{ session('message') }}
    </div>
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