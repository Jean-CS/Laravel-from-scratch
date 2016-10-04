@if (Session::has('alert_message'))
    <div class="Alert Alert--{{ ucwords(Session::get('alert_class')) }}">
        {{ session('alert_message') }}
    </div>
@endif
