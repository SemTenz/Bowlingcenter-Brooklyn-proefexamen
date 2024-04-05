<x-admin-layout>
    <form action="{{route('admin.users.edit',$users->id)}}" method="post">
        @csrf
        @method('PUT')
        <label for="name">naam:</label>
        <br>
        <input type="text" name="name" value="{{$users->name}}">
        <br><br>
        <label for="email">email:</label>
        <br>
        <input type="text" name="email" value="{{$users->email}}">
        <br><br>

        <label for="usertype">usertype:</label>
        <br>

        <select name="usertype" id="usertype">

            <option selected="selected" value="{{$users->usertype}}">
                {{$users->usertype}}
            </option>
            <option value="user" default>gebruiker</option>
            <option value="instructor">instructeur</option>

        </select>
        <br>
        <br>
        <button type="submit">Aanpassen</button>
    </form>
</x-admin-layout>