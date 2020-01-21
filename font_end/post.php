<?php require_once("header.inc.php"); ?>

    <li class="breadcrumb-item"><a href="#"><i class="fas fa-users-cog"></i> ALL POST</a></li>
</ol>

<div class="table-responsive">
    <table id="data" class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            <?php

            $link = mysqli_connect('localhost', 'root', '', 'adminlte');

            $db_sinfo = mysqli_query($link, "SELECT * FROM student_post");
            while ($row = mysqli_fetch_assoc($db_sinfo)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo ucwords($row['name']); ?></td>

                    <td><img style="width: 60px; height:50px;" src="img/<?php echo $row['photo']; ?>" alt=""></td>
                    <td>
                        <a href="update_student.php?id=<?php echo base64_encode($row['id']); ?>" class="btn btn-success"><i class="fas fa-user-edit"></i> Edit</a>&nbsp;&nbsp;
                        <a href="delete_student.php?id=<?php echo base64_encode($row['id']); ?>" class="btn btn-danger"><i class="fas fa-user-times"></i> Delete</a>
                    </td>
                </tr>

            <?php }

            ?>

        </tbody>
    </table>
</div>

<?php require_once("footer.inc.php"); ?>