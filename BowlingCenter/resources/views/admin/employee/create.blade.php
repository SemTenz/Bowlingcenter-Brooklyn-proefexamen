<x-admin-layout>
    <form action="{{ route('admin.employee.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="form-group">
            <select name="usertype" id="usertype">

                {{-- <option selected="selected" value="{{$users->usertype}}">
                {{$users->usertype}}
                </option> --}}
                <option value="3" default>gebruiker</option>
                <option value="2">Medewerker</option>
        </div>
        <div>
            <input type="hidden" name="password" value="password">
        </div>
        </select>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</x-admin-layout>