<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Micro Iot</title>

      <style>
        body {
            background-color: #1a1a1a;
            color: #fff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-top: 40px;
        }

        table,
        th,
        td {
            border: 1px solid #444;
        }

        th,
        td {
            padding: 14px;
            text-align: center;
        }

        th {
            background-color: #333;
            margin: 15px; /* Added margin */
        }

        td {
            background-color: #555;
        }

        tr:nth-child(even) td {
            background-color: #666;
        }

        tr:hover td {
            background-color: #777;
        }

        h1 {
            text-align: center;
            margin-top: 10px;
            font-size: 36px;
        }

        .container {
            max-width: 800px;
            margin:0 auto;
            padding: 20px;
        }

        table {
            margin-top: 40px;
        }

        th,
        td {
            border-radius: 5px;
            box-shadow: 0 0 10px #ff6f00;
        }

        th {
            background-color: #ff6f00;
            color: #fff;
            padding: 20px; /* Increased padding for the header */
        }

        td {
            background-color: #ffa726;
            color: #333;
        }

        tr:nth-child(even) td {
            background-color: #ffb74d;
        }

        tr:hover td {
            background-color: #ff9800;
        }
        .button {
            border: none;
            color: white;
            padding: 15px 40px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
            overflow: hidden;
            position: relative;
            transition: all 0.3s ease;
        }

        .button::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300%;
            height: 300%;
            background-color: rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
            border-radius: 50%;
            z-index: 0;
            transform: translate(-50%, -50%);
        }

        .button:hover::before {
            width: 0;
            height: 0;
        }

        .button span {
            position: relative;
            z-index: 1;
        }

        /* Green button */
        .button.open {
            background-color: #4CAF50; /* Green */
        }

        /* Red button */
        .button.close {
            background-color: #FF5733; /* Red */
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Road Management</h1>

        <form method="post">
    <button class="button" id="toggleButton" type="submit" name="update_button">Toggle Boolean Value</button>
</form>
        <?php


        $servername = "localhost";
        $dbname = "roadiot";
        $username = "root";
        $password = "";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT `id`, `speed`, `overspeed`, `time` FROM `overspeed` ORDER BY id DESC";

        echo '<table cellspacing="5" cellpadding="5">
      <tr> 
        <th>ID</th> 
        <th>Speed</th> 
        <th>OverSpeed</th>  
        <th>Time</th> 
      </tr>';

        if ($result = $conn->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                $row_id = $row["id"];
                $row_speed = $row["speed"];
                $row_overspeed = $row["overspeed"];
                $row_time = $row["time"];

                echo '<tr> 
                <td>' . $row_id . '</td> 
                <td>' . $row_speed . '</td> 
                <td>' . $row_overspeed . '</td> 
                <td>' . $row_time . '</td> 
              </tr>';
            }
            $result->free();
        }

        if(isset($_POST['update_button'])) {
            // Assuming your boolean field name is 'value' in 'servo'
            // Toggle the boolean value
            $sql2 = "UPDATE servo SET value = NOT value WHERE id = 1"; // Change 'id' to your actual primary key
        
            if ($conn->query($sql2) === TRUE) {
                // Retrieve the current value after toggling
                $sql3 = "SELECT value FROM servo WHERE id = 1"; // Change 'id' to your actual primary key
                $result3 = $conn->query($sql3);
                if ($result3->num_rows > 0) {
                    $row3 = $result3->fetch_assoc();
                    $value = $row3["value"];
                    echo "Boolean value updated successfully. It is now " . ($value ? "open" : "close");
                } else {
                    echo "Error retrieving updated value.";
                }
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
        

        $conn->close();
        ?>
    </div>

    <script>
     var button = document.getElementById("toggleButton");
     button.addEventListener("click", function () {
          var buttonText = this.querySelector("span");
          if (buttonText.innerHTML === "Open") {
               buttonText.innerHTML = "Close";
               this.classList.remove("open");
               this.classList.add("close");
          } else {
               buttonText.innerHTML = "Open";
               this.classList.remove("close");
               this.classList.add("open");
          }
     });
    </script>
</body>

</html>
