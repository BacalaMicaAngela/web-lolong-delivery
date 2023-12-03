<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recycle Bin</title>

    <!-- Add your CSS styles or include external stylesheets here -->

    <style>
        /* Add your custom styles here */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Add any additional styles as needed */
    </style>
</head>

<body>

    <div class="container">
        <h1>Recycle Bin</h1>

        @if(count($deletedUsers) > 0)
            <table>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Deleted At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($deletedUsers as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->deleted_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No items in the Recycle Bin.</p>
        @endif
    </div>

    <script>
        $(document).ready(function() {
            // Add the following code to set the 'active' class for the Recycle Bin link
            $('.list-group-item').removeClass('active'); // Remove active class from all links
            $('.list-group-item[href="/recycleBin"]').addClass('active'); // Add active class to Recycle Bin link
        });

        // Your JavaScript code for handling restore actions
        $(document).on('click', '.restoreBtn', function () {
            var userId = $(this).data('id');

           
        });
    </script>
</body>

</html>
