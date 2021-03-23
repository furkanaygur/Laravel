@if (session()->has('message'))
        <div class="container">
            <div class="col-md-12" style="padding: 0">
                <div class="alert alert-{{ session('message_type') }}">
                    {{ session('message') }}
                </div>
            </div>
        </div>
@endif