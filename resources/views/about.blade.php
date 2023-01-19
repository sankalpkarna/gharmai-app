<x-header title="About"/>
<h1>About Me</h1>

<h2>{{URL::current()}}</h2>

<br />

<a href = "{{URL::to('/welcome')}}">Home</a>

@include('welcome')