<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>
    <h1>Registered Users</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Designation</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($details as $user){ ?>
                <tr>
                    <td><?php echo $user->id ?></td>
                    <td><?php echo $user->name ?></td>
                    <td><?php echo $user->email ?></td>
                    <td><?php echo $user->address ?></td>
                    <td><?php echo $user->phone ?></td>
                    <td><?php echo $user->designation ?></td>
                    <td><?php echo $user->created_date_time ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br></br>
    <a href="<?= site_url('admin/export_excel') ?>">Download Excel</a>
    <a href="<?= site_url('admin/export_pdf') ?>">Download PDF</a>
    <button type="button" onclick="adminhomeview();">Home</button>
</body>
</html>
<script>
        function adminhomeview() {
            window.location.href = '<?= site_url("user/login") ?>'; 
        }
    </script>
