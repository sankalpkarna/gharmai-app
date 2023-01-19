@include('cdn');
<div class="container" align="center">
<h2>Update User</h2></br></br>
@if(session('username'))
<h4>Data saved for {{session('username')}}</h4>
@endif

<form action="/user/update" method="POST" enctype="multipart/form-data">
    @csrf
<div class="form-group">
    <input type="hidden" name="id" value="{{$user['id']}}">
    <input type="text" name="username" placeholder="Enter Username" value="{{$user['name']}}"><br/><br/>
</div>
<div class="form-group">
    <input type="password" name="password" placeholder="Enter Password"  value="{{$user['password']}}"> <br /><br/>
</div>
<div class="form-group">
    <input type="text" name="email" placeholder="Enter Email" value="{{$user['email']}}"><br/><br/>
</div>
    <input type="file" name="profilepic">
    <button>Upload Image</button>
    <br/>
    <button type="Submit" class="btn btn-primary">Update User</button>
</form>
</div>
