    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    </head>

    <body>
        <form method="post" action="<?php (isset($_POST['submit_btn'])) ? print site_url('UserController/register') :  print site_url('UserController/update') ; ?>">
            <label for="fname">First Name:</label>
            <input type="text" id="fname" name="fname"
                value="<?php $this->editUser ? print($this->editUser[0]->fname) : "" ?>" required> <br><br>

            <label for="lname">Last Name:</label>
            <input type="text" id="lname" name="lname"
                value="<?php $this->editUser ? print($this->editUser[0]->lname) : "" ?>" required> <br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email"
                value="<?php $this->editUser ? print($this->editUser[0]->email) : "" ?>" required> <br><br>

            <?php if ($this->editUser == null): ?>
                <button type="submit" class="submit_btn" id="submit_btn" name="submit_btn"> Submit </button>
            <?php endif; ?>

            <?php if ($this->editUser): ?>
                <form method="post" action="<?php echo site_url("UserController/update"); ?>">
                    <button type="update" class="update_btn" id="update_btn" name="update_btn" value="<?php $this->editUser ? print($this->editUser[0]->id) : "" ?>"> Update </button>
                </form> <br>
            <?php endif; ?>
        </form> <br />

        <table border="2" id="userTable">
            <thead>
                <tr>
                    <th>fname</th>
                    <th>lname</th>
                    <th></th>
                </tr>
            </thead>
            <?php foreach ($this->data as $user): ?>
                <tbody>
                    <tr>
                        <td> <?php echo $user['fname'] ?> </td>
                        <td> <?php echo $user['lname'] ?></td>
                        <td>
                            <input type="hidden" name="id" value="<?php echo $user['Id']; ?>" />
                            <form method="post" action="<?php echo site_url("UserController/edit"); ?>">
                                <button name="edit_btn" class="edit_btn" value="<?php echo $user['Id'] ?>"> Edit </button>
                            </form>
                            <form method="post" action="<?php echo site_url("UserController/delete"); ?>">
                                <!-- onclick=" echo $userControllerObj->edit($user['Id']);   -->
                                <button name="delete_btn" class="delete_btn" value="<?php echo $user['Id'] ?>"> Delete </button>
                            </form>
                        </td>
                </tbody>
            <?php endforeach; ?>
        </table>
    </body>

    <script>
        $(document).ready(function() {
            $('.edit_btn').click(function() {
                $('#update_btn').show();
                $('#submit_btn').hide();
            })


            // $("#userTable").DataTable({
            // paging: true,
            // searching: true,
            // ordering: true,
            // order: [2, 'desc'],
            // sort: [2, 'desc'],
            // lengthMenu: [25, 50],
            // pageLength: 25,
            // columnDefs: [{
            //     targets: -1,
            //     orderable: false
            // }]
            // });
        })
    </script>

    </html>