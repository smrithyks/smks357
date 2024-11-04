<?php if (!empty($details)){?>
<div class="col-lg-12">
          <p>
            <label>Profile </label>
        </p>
        <?php
        ?>
        <table class="table table-hover table-bordered personal-task" id ="tbl_commission" border='1'>
            <tbody>
                <tr>
                    <th>Name</th>    
                    <td><?php echo $details['name']; ?></td>
                </tr>
                <tr>
                    <th>Address</th>   
                    <td><?php echo $details['address']; ?></td>
                </tr>
                <tr>
                    <th>Phone</th> 
                    <td><?php echo $details['phone']; ?></td>
                </tr>
                <tr>
                    <th>Designation</th> 
                    <td><?php echo $details['designation']; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <br></br>
    <button type="button" onclick="homeview();">Home</button>
    <?php } ?>
    <script>
        function homeview() {
            window.location.href = '<?= site_url("user/login") ?>'; 
        }
    </script>