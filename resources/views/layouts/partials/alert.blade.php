@if(session()->has('message'))
        <div class="alert-message alert-{{ session('message_type') }}">
            {{ session('message') }}
        </div>
@endif
