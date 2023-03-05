<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Details</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="https://www.thesparksfoundationsingapore.org/images/logo_small.png" type="image/png">
    <style>
        .mt-0 {
            padding: 10px;
            top: 0;

        }

        * {
            font-family: Poppins;
        }
        #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 80%;
        }

        #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
        }

        #customers tr:nth-child(even){background-color: #f6e486;}

        #customers tr:hover {background-color: #f6e483;}

        #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #efa536;
        color: white;
        }
    </style>
</head>

<body>
    <?php
    include './connection2.php';
    $sql = "SELECT * FROM clients";
    $result = mysqli_query($conn, $sql);
    ?>
    <?php
    include '../html/nave.html';
    ?>
    <div class="bg-yellow-100 container">
        <br />
        <div class="row">
            <div class="col">
                <center>
                <div class="container-fluid table-responsive-sm">
                    <table class="table-auto" id="customers">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center py-2">Client Id</th>
                                <th scope="col" class="text-center py-2">Name</th>
                                <th scope="col" class="text-center py-2">E-Mail</th>
                                <th scope="col" class="text-center py-2">Bank Balance </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($result)) {
                                while ($rows = mysqli_fetch_assoc($result)) {
                            ?>
                                    <tr>
                                        <td class="center py-2"><?php echo (isset($rows['c_id']) ? $rows['c_id'] : ''); ?></td>
                                        <td class="center py-2"><?php echo (isset($rows['c_name']) ? $rows['c_name'] : ''); ?></td>
                                        <td class="center py-2"><?php echo (isset($rows['c_mail']) ? $rows['c_mail'] : ''); ?></td>
                                        <td class="center py-2"><?php echo (isset($rows['c_balance']) ? $rows['c_balance'] : ''); ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
                </center>
            </div>
        </div>

        <pre class="mt-4 text-gray-500 xl:mt-6 dark:text-gray-300">


        </pre>
    </div>
    <?php
        include_once "../html/footer.html"
    ?>
</body>

</html>