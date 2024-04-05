<x-admin-layout>
    <form action="{{route('admin.employee.edit',$user->id)}}" method="post">
        @csrf
        @method('PUT')
        <label for="name">Naam</label>
        <input type="text" name="name" id="name" value="{{$user->name}}">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{$user->email}}">
        <label for="usertype">Usertype</label>
        <select name="usertype" id="usertype" value="{{$user->usertype}}">
            <option value="3" default>gebruiker</option>
            <option value="2">Medewerker</option>
        </select>

        <button type="submit">Aanpassen</button>
    </form>
</x-admin-layout>