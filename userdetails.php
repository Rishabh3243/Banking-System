<!DOCTYPE html>
<html lang="en">

<head>
    <title>Transfer money</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="logo.png" type="image/png">


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
    <div class="a2">
            <b>Transfer Money</b>
    </div><center>
    <div class="bg-yellow-100 container-fluid">

        <?php
        include 'connection2.php';
        if (isset($_REQUEST['c_id'])) {
            $sid = $_GET['c_id'];
            $sql = "SELECT * FROM  clients where c_id=$sid";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                echo "Error : " . $sql . "<br>" . mysqli_error($conn);
            }
            $rows = mysqli_fetch_assoc($result);
        }
        ?>
        <form method="post" name="tcredit" class="tabletext"><br>

            <div class="container-fluid">
                <table id="customers">
                    <tr>
                        <th class="text-center">Client Id</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">E-mail</th>
                        <th class="text-center">Bank Balance</th>
                    </tr>
                    <tr>
                        <td class="center py-2"><?php echo (isset($rows['c_id']) ? $rows['c_id'] : ''); ?></td>
                        <td class="center py-2"><?php echo (isset($rows['c_name']) ? $rows['c_name'] : ''); ?></td>
                        <td class="center py-2"><?php echo (isset($rows['c_mail']) ? $rows['c_mail'] : ''); ?></td>
                        <td class="center py-2"><?php echo (isset($rows['c_balance']) ? $rows['c_balance'] : ''); ?></td>
                    </tr>
                </table>
            </div>
            <br><br><br>

                    <div class="flex justify-center">
                    <div class="bg-yellow-300 block max-w-sm rounded-lg bg-white p-6 shadow-lg dark:bg-neutral-700">
                        <div class="container">
                            <br><br>
                            <label for="to">Transfer To:</label>
                            <select id="to" name="to" class="form-control" required>
                                <option value="" disabled selected>Choose</option>
                                <?php
                                include 'config.php';
                                $sid = $_REQUEST['c_id'];
                                $sql = "SELECT * FROM clients where c_id!=$sid";
                                $result = mysqli_query($conn, $sql);
                                if (!$result) {
                                    echo "Error " . $sql . "<br>" . mysqli_error($conn);
                                }
                                while ($rows = mysqli_fetch_assoc($result)) {
                                ?>
                                    <option class="table" value="<?php echo $rows['c_id']; ?>">

                                        <?php echo $rows['c_name']; ?> (Balance:
                                        <?php echo $rows['c_balance']; ?> )

                                    </option>
                                <?php
                                }
                                ?>
                        </div>
                        </select>
                        <br><br>
                        <label for="amount">Amount:</label>
                        <input type="number" class="form-control" name="amount" id="amount" required>
                        <br><br>
                        <div class="text-center">
                            <button type="button" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900" name="submit" type="submit" id="myBtn">
                                Transfer Money
                            </button>
                        </div>
                        <br>
                    </div>
                    </div>


        </form>
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
    
<?php
include 'connection2.php';

if (isset($_POST['submit'])) {

    $from = $_GET['c_id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from clients where c_id=$from";
    $query = mysqli_query($conn, $sql);
    $sql1 = mysqli_fetch_array($query); // returns array from which the amount is to be transferred.

    // check input of negative value by user
    if (($amount) < 0) {
        echo '<script>';
        echo ' alert("Please enter correct amount.")';  // showing an alert box.
        echo '</script>';
    }

    // check insufficient balance.
    else if ($amount > $sql1['c_balance']) {
        echo '<script>';
        echo ' alert("Bad Luck! Insufficient Balance")';  // showing an alert box.
        echo '</script>';
    }

    // constraint to check zero values
    else if ($amount == 0) {

        echo "<script>";
        echo "alert('Oops! Zero value cannot be transferred')";
        echo "</script>";
    } else {
        $sql = "SELECT * from clients where c_id=$to";
        $query = mysqli_query($conn, $sql);
        $sql2 = mysqli_fetch_array($query);

        $sender = $sql1['c_name'];
        $receiver = $sql2['c_name'];

        // deducting amount from sender's account
        $newbalance = $sql1['c_balance'] - $amount;
        $sql = "UPDATE clients set c_balance=$newbalance where c_id=$from";
        mysqli_query($conn, $sql);

        // adding amount to reciever's account
        $newbalance = $sql2['c_balance'] + $amount;
        $sql = "UPDATE clients set c_balance=$newbalance where c_id=$to";
        mysqli_query($conn, $sql);


        $sql = "INSERT INTO transaction(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo "<script> alert('Transaction Successful !!');
                                     window.location='transactionhistory.php';
                           </script>";
        }

        $newbalance = 0;
        $amount = 0;
    }
}
?>
