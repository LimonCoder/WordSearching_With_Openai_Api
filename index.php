<?php
require_once 'classes/Openai.php';

$response = [];

if (isset($_POST['submit'])) {
    $api = new Openai();
    $search_values = $_POST['search'];
    $response = json_decode($api->search('file-Nb30LyUEQEdRknTGDpo1xZsw', $search_values), true);

}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/paginate.css" rel="stylesheet">
    <title>Search</title>
</head>
<body>
<div class="container">
    <div class="form">
        <form action="" method="post">
            <input class="search" type="text" id="search" placeholder="search here....." name="search" required>
            <input class="submit" type="submit" name="submit" value="Search">
        </form>
    </div>
    <div class="results">
        <p>Search result for : <?= (isset($_POST['search'])) ? $_POST['search'] : '' ?> </p>

        <?php if (isset($response['data']) && count($response['data']) > 0) { ?>
            <div class="search_list">

                <table id="example" style="width:100%">
                    <thead>
                    <tr>
                        <th>Name</th>

                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    foreach ($response['data'] as $item) { ?>
                        <tr>
                            <td>
                                <h4>Meta-data : <?= $item['metadata'] ?></h4>
                                <h5> Score : <?= $item['score'] ?> </h5>
                                <br>
                                <p style="text-align: justify" ><?= $item['text'] ?> </p>
                            </td>
                        </tr>
                    <?php }


                    ?>

                    </tbody>

                </table>

            </div>

        <?php } ?>

    </div>

</div>
<script src="assets/js/jquery.js"></script>
<script src="assets/js/paginate.js"></script>


<script>

    $(document).ready(function () {
        $('#example').DataTable();
    });

</script>


</body>
</html>

