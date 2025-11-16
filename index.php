<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <?php
        require_once 'process.php';
    ?>

    <?php
        if (isset($_SESSION['message'])):?>
        <div class="alert alert-<?=$_SESSION['msg_type']?>">
            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>

<div class="container-md" style="margin-top: 100px;">
    <?php
        $mysqli = new mysqli('db', 'root', 'root', 'crud') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);

        //pre_r($result);
        //pre_r($result->fetch_assoc());
    ?>

        <div class="row justify-content-center">
            <table class="table"> 
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th colspan="2">Action</th>
                    </tr>    
                </thead>
                <?php
                while ($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['location'];?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>

    <?php    
        function pre_r( $array ) {
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }
    ?>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="process.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter your name">
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location:</label>
                    <input type="text" id="location" name="location" class="form-control" value="<?php echo $location; ?>" placeholder="Enter your location">
                </div>
                <div class="mb-3">
                    <?php 
                    if ($update == true):
                    ?>
                    <button type="submit" class="btn btn-info" name="update">Update</button>
                    <?php else: ?>
                    <button type="submit" class="btn btn-primary" name="save">Save</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>