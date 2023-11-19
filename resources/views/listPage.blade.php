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
        "searching": false,
        "dom": 'rtip',
        columnDefs: [{
            orderable: false,
            targets: [2, 3, 4, 5]
        }]
    });

    function deleteUser(id) {
        if (confirm("Are yor sure you want to delete?")) {
            $.ajax({
                url: "{{ route('deleteuser') }}",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id
                },
                success: function(data) {
                    // console.log(data);
                    call_datatable();
                }
            });
        }
    }

    function showModal(id) {
        // you can do anything with data, or pass more data to this function.
        // $("#myModal .modal-title").html(data)
        $.ajax({
            url: "{{ route('viewuser') }}",
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'id': id
            },
            success: function(data) {
                // console.log(data);
                $('#idModal').html('');
                $('#idModal').html(data);
                $("#exampleModal").modal();
            }
        });
    }

    function editUser(id) {
        $.ajax({
            url: "{{ route('edituser') }}",
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'id': id
            },
            success: function(data) {
                console.log(data);
                $('#edit_user_id').val(data.id);
                $('#fname').val(data.fname);
                $('#address').val(data.address);
                $('input[name=gender][value="' + data.gender + '"]').prop("checked", true);

                // call_datatable();
            }
        });
    }
</script>
