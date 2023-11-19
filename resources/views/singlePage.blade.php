<html>

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>Single Page Application</title>

    <link href="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-1.13.8/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>

<body>
    <div class="container">
        <h2>User Form</h2>
        <form id="userForm" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="fname">Name:</label>
                <input type="text" class="form-control" id="fname" name="fname">
                <input type="hidden" name="edit_user_id" id="edit_user_id">
            </div>
            <div class="form-group">
                <label for="fileToUpload">Image:</label>
                <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address">
            </div>
            <label class="control-label">Gender:</label>
            <div class="row form-group">
                <div class="col-md-6">
                    <label class="radio-inline">
                        <input type="radio" name="gender" value="Male" />Male
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="gender" value="Female" />Female
                    </label>
                </div>
            </div>
            <button type="submit" name="submit" id="submit" class="btn btn-default">Submit</button>
        </form>
        <div id="user_table">
        </div>
    </div>

        {{-- modal start --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">User Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id = "idModal">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- modal end --}}

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-1.13.8/datatables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        call_datatable();
        $("form#userForm").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var radioValue = $("input[name='gender']:checked").val();
                if ($('#fname').val() !== '' && $('#fileToUpload').val() !== '' && $('#address').val() !== '' && radioValue) {
                $.ajax({
                    url: "{{ route('adduser') }}",
                    type: 'POST',
                    data: formData,
                    success: function(data) {
                        // alert(data)
                        console.log(data);
                        $('form#userForm')[0].reset();
                        $('#edit_user_id').val('');
                        call_datatable();
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
        });

        function call_datatable() {
            $.ajax({
                url: "{{ route('listdata') }}",
                type: 'GET',
                success: function(data) {
                    $('#user_table').html('');
                    $('#user_table').html(data);
                },
            });
        }
    </script>
</body>

</html>
