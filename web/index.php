

<?php
/*************************************************************************************************
 * index.php
 *
 * Main page for the Hanover DPW Park Permitting application.
 *
 * This page will use the optional 'content' request parameter to include a specific page. If the
 * parameter is not specified then the default list page will be included.
 *************************************************************************************************/

include('library.php');
// print_r($_SESSION);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="styles.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        

        <title>Hanover Cyber Hawks</title>
    </head>

    <body>
        <div>
            <nav class="navbar navbar-expand-lg bg-dark-subtle">
                <div class="container-fluid">
                    <!-- <a class="navbar-brand" href="index.php">HHScyberhawks.com</a> -->
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link <?php print($content == 'slideshow' ? 'active' : ''); ?>" href="index.php?content=slideshow">HHS Cyber Hawks</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?php print($content == 'about' ? 'active' : ''); ?>" href="index.php?content=about">About</a>
                            </li>

                            <?php if(isset($_SESSION['userId'])) : ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php print($content == 'order' ? 'active' : ''); ?>" href="index.php?content=order">Order Pizza</a>
                                </li>
                            <?php endif ?>
                            
                        </ul>
                    <a class="text-decoration-none" <?php print($content == 'login' ? 'active' : ''); ?>" href="index.php?content=login">Login</a>
                    <!-- <a href="index.php?content=login" class="text-decoration-none"><h1>login</h1></a> -->

                </div>
            </nav>

        </div>

        <!-- Main Content -->
        <div class="container-fluid mt-3">
            <?php include(get_content() . '.php'); ?>
        </div>

    </body>
    <script>
        function showAlert(type, title, message) {
            $('#alert').hide();
            $('#alert').removeClass('alert-success alert-info alert-warning alert-danger').addClass('alert-' + type);
            $('#alertTitle').text(title);
            $('#alertMessage').html(message);
            $('#alert').fadeIn();
        }
    </script>
</html>