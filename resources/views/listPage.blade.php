<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Image</th>
            <th>Address</th>
            <th>Gender</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($user_data))
            @foreach ($user_data as $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->fname }}</td>
                    {{-- <td><img src = "{{$data->img_path}}" height="40px" width="50px"></td> --}}
                    <td><a download="{{ $data->img_path }}" href="{{ $data->img_path }}" title="{{ $data->img_path }}">
                            <img alt="ImageName" src = "{{ $data->img_path }}" height="40px" width="50px"></td>
                    </a>
                    <td>{{ $data->address }}</td>
                    <td>{{ $data->gender }}</td>
                    <td>
                        <button onclick="editUser({{ $data->id }})">Edit</button>
                        <button onclick="deleteUser({{ $data->id }})">Delete</button>
                        {{-- <button onclick="">View</button> --}}
                        {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Open modal for @getbootstrap</button> --}}
                        <button onclick="showModal({{ $data->id }})" type="button" value="1">View</button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
<script>
    var table = $('#example').DataTable({
        'processing': false,
    });
</script>
