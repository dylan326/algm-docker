
<a href="/" style="display: block;
    width: 115px;
    height: 25px;
    background: #4E9CAF;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    color: white;
    font-weight: bold; text-decoration: none;">Back Home</a>
@if($totalSeconds->isEmpty())
<h5>No API Data, please run the command: <span style="color: green;"> php artisan add:apidata</span></h5>
@else
@foreach (json_decode($totalSeconds) as $seconds) 
  @if($seconds->component_id == 1)
  <h3>Component: DevOps</h3>
  @elseif($seconds->component_id == 2)
  <h3>Component: Design</h3>
  @elseif($seconds->component_id == 3)
  <h3>Component: Back-end</h3>
  @else
  <h3>Component: Front-end</h3>
  @endif

<p>Total seconds logged: {{ $seconds->total_seconds }}</p>
<p>Total number of users who worked on this component: {{ $seconds->numOfUsers }}</p>
<hr>
@endforeach
@endif



