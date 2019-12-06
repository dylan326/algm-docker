@foreach (json_decode($userTimelogs) as $log) 

<h3>User: {{ $log->user_name }}</h3>
<p>Seconds Logged: {{ $log->seconds }}</p>
<p>Issue ID: {{ $log->issue_id }}</p>
<hr>
@endforeach

