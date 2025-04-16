<?php

// include DIRPATH. '/controllers/Signup_controller.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

</head>

<body>
    <h2>Signup Form</h2>
    <form method="post" action="<?php echo site_url('SignupController/register'); ?>">
        <label for="fname">First Name:</label>
        <input type="text" id="fname" name="fname" required> <br><br>

        <label for="lname">Last Name:</label>
        <input type="text" id="lname" name="lname" required> <br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required> <br><br>

        <button type="submit" class="submit_btn" id="submit_btn" name="submit_btn"> Submit </button>
    </form> <br /> <br />

    <table id="userTable" border="1">
        <thead>
            <tr>
                <td>fname</td>
                <td>lname</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

</body>
<script>
    $(document).ready(function() {
        $("#userTable").DataTable({
            paging: true,
            searching: true,
            ordering: true,
            order: [2, 'desc'],
            sort: [2, 'desc'],
            lengthMenu: [25, 50],
            pageLength: 25,
            // columnDefs: [{
            //     targets: -1,
            //     orderable: false
            // }]
        });
    })
</script>

</html>