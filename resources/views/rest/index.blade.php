@include('cdn');
<h1>User List</h1>

<div class="container">
<table class="table table-striped table-bordered table-hover">
<thead class="thead-dark">
    <tr>
        <th>ID</th>
        <th>Email</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Photo</th>
    </tr>
</thead>
<tbody>
    @foreach($data as $d)
    <tr>
        <td>{{$d['id']}}</td>
        <td>{{$d['email']}}</td>
        <td>{{$d['first_name']}}</td>
        <td>{{$d['last_name']}}</td>
        <td><img src={{$d['avatar']}} alt="" /></td>
    </tr>
    @endforeach
</tbody>
</table>
</div>