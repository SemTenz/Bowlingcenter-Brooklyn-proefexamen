<x-admin-layout>


    <table>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>email</th>
            <th>usertype</th>

        </tr>


        @foreach ($users->Users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $users->usertype }}</td>
        </tr>

        <a href="{{route('admin.employee.edit',$user->id)}}">wijzig</a>
        <form action="{{ route('admin.employees.delete', $user->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        <a href="{{route('admin.employee.create',$user->id)}}">aanmaken</a>
        @endforeach
    </table>
</x-admin-layout>