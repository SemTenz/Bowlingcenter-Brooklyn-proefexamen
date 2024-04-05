<x-admin-layout>
    <form action="{{route('admin.employee.update',$user->id)}}" method="post">
        @csrf
        @method('put')
        <label for="name">Naam</label>
        <input type="text" name="name" id="name" value="{{$user->name}}">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{$user->email}}">
        <label for="usertype">Usertype</label>
        <input type="text" name="usertype" id="usertype" value="{{$user->usertype}}">

        <button type="submit">Aanpassen</button>
    </form>
</x-admin-layout>