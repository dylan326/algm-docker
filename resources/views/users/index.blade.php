<a href="/" style="display: block;
    width: 115px;
    height: 25px;
    background: #4E9CAF;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    color: white;
    font-weight: bold; text-decoration: none;">Back Home</a>
@if($userTimelogs->isEmpty())
<h5>No API Data, please run the command:<span style="color: green;"> php artisan add:apidata</span></h5>
@else
@foreach (json_decode($userTimelogs) as $log) 

<h3>User: {{ $log->user_name }}</h3>
<p>Seconds Logged: {{ $log->seconds }}</p>
<p>Issue ID: {{ $log->issue_id }}</p>
<hr>
@endforeach
@endif

