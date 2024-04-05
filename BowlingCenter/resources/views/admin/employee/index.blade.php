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
            <td><a href="{{route('admin.employee.edit',$user->id)}}">wijzig</a></td>
            <td><form action="{{ route('admin.employee.delete', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            </td>
        </tr>
        
        
        @endforeach
        <td><a href="{{route('admin.employee.create')}}">aanmaken</a></td>
    </table>
</x-admin-layout>
