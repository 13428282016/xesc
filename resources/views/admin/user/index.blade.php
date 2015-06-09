@extends('admin/layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">用户列表</div>
    <div class="panel-body">
    <table id="users" class="table table-hover">
    <thead>
    <th>OPEN_ID</th>
        <th>最近ip</th>
        <th>创建时间</th>
        <th>修改时间</th>
         
    </thead>
    <tbody>
    @foreach($users as $user)
    <tr>
    <td>{{$user->open_id}}</td>
    <td>{{$user->last_ip}}</td>
    <td>{{$user->created_at}}</td>
    <td>{{$user->updated_at}}</td>
    </tr>
    @endforeach

    </tbody>


    </table>


    </div>

    <div style="text-align: center">

    <?php echo $users->render()?>
    </div>


</div>

@endsection
