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
        @endforeach
    </table>
</x-admin-layout>