<!DOCTYPE html>
<html lang="en">

<head>
    <title>Transaction History</title>
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
        .a2{
            width:100%;
            text-align:center;
            height: 100px;
            background-color: #fbca15;
            padding-top:30px;
            font-size:30px
        }
    </style>
</head>

<body>
    <?php
    include 'nave.html';
    ?>
    <header>
        <div class="a2">
            <b>Transaction History</b>
        </div><center>
        <div class="container" >
            <br>
            <div class="container-fluid table-responsive-sm" >
                <table class="table-auto" id="customers">
                    <thead>
                        <tr>
                            <th class="text-center">Sr No.</th>
                            <th class="text-center">Sender</th>
                            <th class="text-center">Recipient</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Timestamp</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        include './connection2.php';

                        $sql = "SELECT * from transaction";

                        $query = mysqli_query($conn, $sql);

                        while ($rows = mysqli_fetch_assoc($query)) {
                        ?>

                            <tr>
                                <td class="center py-2"><?php echo $rows['sr_no']; ?></td>
                                <td class="center py-2"><?php echo $rows['sender']; ?></td>
                                <td class="center py-2"><?php echo $rows['receiver']; ?></td>
                                <td class="center py-2"><?php echo $rows['balance']; ?> </td>
                                <td class="center py-2"><?php echo $rows['date_time']; ?> </td>

                            <?php
                        }
                        mysqli_close($conn);
                            ?>
                    </tbody>
                </table>

            </div>
            <pre class="mt-4 text-gray-500 xl:mt-6 dark:text-gray-300">


            </pre>
        </div>
        </center>
        <?php
        include_once "footer.html"
        ?>
 </body>

</html>