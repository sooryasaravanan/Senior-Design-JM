<?php
session_start();
?>


<!DOCTYPE html>
<html>
<head>
<script>

// Script populating the Department and Work Center dropdown menus
let dropdown_data = 
[{
    item: 'PRESS',
    subitems: ['PRESS_1', 'PRESS_2', 'PRESS_3', 'PRESS_4', 'PRESS_5', 'PRESS_6', 'PRESS_7', 'PRESS_8', 'PRESS_9', 'PRESS_10', 'PRESS_OTHER']
  },
  {
    item: '2NDOPS',
    subitems: ['2NDOPS_1', '2NDOPS_2', '2NDOPS_3', '2NDOPS_4', '2NDOPS_5', '2NDOPS_6', '2NDOPS_7', '2NDOPS_8', '2NDOPS_9', '2NDOPS_10', '2NDOPS_11', '2NDOPS_12', '2NDOPS_13', '2NDOPS_14', '2NDOPS_15', '2NDOPS_OTHER']
  },
  {
    item: 'CUSHION',
    subitems: ['CUSHION_1', 'CUSHION_2', 'CUSHION_3', 'CUSHION_4', 'CUSHION_5', 'CUSHION_6', 'CUSHION_7', 'CUSHION_8', 'CUSHION_9', 'CUSHION_10', 'CUSHION_OTHER']
  },
  {
    item: 'VULCANIZATION',
    subitems: ['VULCANIZATION_1', 'VULCANIZATION_2', 'VULCANIZATION_3', 'VULCANIZATION_4', 'VULCANIZATION_5', 'VULCANIZATION_6', 'VULCANIZATION_7', 'VULCANIZATION_8', 'VULCANIZATION_9', 'VULCANIZATION_10', 'VULCANIZATION_OTHER'],
  },
  {
    item: 'ASSEMBLY',
    subitems: ['ASSEMBLY_1', 'ASSEMBLY_2', 'ASSEMBLY_3', 'ASSEMBLY_4', 'ASSEMBLY_5', 'ASSEMBLY_6', 'ASSEMBLY_7', 'ASSEMBLY_8', 'ASSEMBLY_9', 'ASSEMBLY_10', 'ASSEMBLY_11', 'ASSEMBLY_12', 'ASSEMBLY_13', 'ASSEMBLY_14', 'ASSEMBLY_15', 'ASSEMBLY_16', 'ASSEMBLY_17', 'ASSEMBLY_18', 'ASSEMBLY_19', 'ASSEMBLY_20', 'ASSEMBLY_21', 'ASSEMBLY_22','ASSEMBLY_23', 'ASSEMBLY_24', 'ASSEMBLY_25', 'ASSEMBLY_OTHER'],
  },
];

// Only operate when the data entry window is fully loaded
window.onload = function() {
  const department_selection = document.getElementById("department");
  const workcenter_selection = document.getElementById("work_center");
  // Retrieves selected department from submitted form data (Defaults to an empty string)
  var selectedDepartment = "<?php echo isset($_POST['department']) ? $_POST['department'] : ''; ?>";
  // Retrieves selected work center from submitted form data (Defaults to an empty string)
  var selectedWorkCenter = "<?php echo isset($_POST['work_center']) ? $_POST['work_center'] : ''; ?>";

  // Populating and setting "department" dropdown menu
  for (let x in dropdown_data) {
    // department_selection.options[department_selection.options.length] = new Option(dropdown_data[x].item, x);
    var option = document.createElement("option");
    option.value = x;
    option.text = dropdown_data[x].item;
    department_selection.add(option);
  }

  // Populating appropriate "work center" dropdown menu based on "department" dropdown menu
  if (selectedDepartment) {
    department_selection.value = selectedDepartment;
    for (let y of dropdown_data[selectedDepartment].subitems) {
      var option = new Option(y, y);
      workcenter_selection.options[workcenter_selection.options.length] = option;
    }
  }

  // Setting "work center" dropdown menu
  if (selectedWorkCenter) {
    workcenter_selection.value = selectedWorkCenter; // Set the selected work_center option based on the selected value
  }

  // Handles changes to the "department" dropdown menu
  // If a new department is selected, the "work center" dropdown menu repopulates
  department_selection.onchange = function() {
    // Empty 
    workcenter_selection.length = 1;
    // Display correct values
    for (let y of dropdown_data[this.value].subitems) {
      workcenter_selection.options[workcenter_selection.options.length] = new Option(y, y);
    }
  }
}

// Toggles visibile and invisible states of the form elements
function toggleField(hideObj,showObj){
 hideObj.disabled=true;   
 hideObj.style.display='none';
 showObj.disabled=false;  
 showObj.style.display='inline';
 showObj.focus();
}

</script>
<!-- Sets "error" text to red -->
<style>
.error {color: #FF0000;}
</style>
</head>
</html>

<?php
// Database definitions
$employee_nameErr = $employee_idErr = $work_orderErr = $work_centerErr = $part_numberErr = $quantityErr = $start_timeErr = $end_timeErr = $sequence_numErr = $progressErr = $setup_timeErr = $die_setErr = $material_lotErr = $status_codeErr = $reporting_node = '';
$employee_id = $work_order = $work_center = $part_number = $quantity = $start_time = $end_time = $sequence_num = $progress = $setup_time = $die_set = $material_lot = $status_code = $comments = $department = '';

// Detects errors and prevents SQL queries from running
$correct = True;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Employee Name
  if (empty($_POST["employee_name"])) {
    $employee_nameErr = "Employee name is required";
    $correct = False;
  } 
  else {
    $employee_name = test_input($_POST["employee_name"]);
    // Check if employee name contains only letters
    if (!ctype_alpha($employee_name)) {
      $employee_nameErr = "Only letters allowed";
      $correct = False;
    }
  } 
  //Employee ID
  if (empty($_POST["employee_id"])) {
    $employee_idErr = "Employee ID is required";
    $correct = False;
  } 
  else {
    $employee_id = test_input($_POST["employee_id"]);
    // Check if employee ID contains only numbers
    if (!is_numeric($employee_id)) {
      $employee_idErr = "Only numbers allowed";
      $correct = False;
    }
  }   
  //Work Order Number
  if (empty($_POST["work_order"])) {
      $work_orderErr = "Work Order Number is required";
      $correct = False;
    } 
  else {
      $work_order = test_input($_POST["work_order"]);
      // Check if work order contains only letters and numbers
      if (!preg_match("/^[a-zA-Z0-9' ]*$/",$work_order)) {
        $work_orderErr = "Only letters and numbers allowed";
        $correct = False;
      }
    }
  //Department
  $department = test_input($_POST["department"]);
  if ($department == '0') {
    $department = 'PRESS';
  }
  if ($department == '1') {
    $department = '2NDOPS';
  }
  if ($department == '2') {
    $department = 'CUSH';
  }
  if ($department == '3') {
    $department = 'VULC';
  }
  if ($department == '4') {
    $department = 'ASSEMBLY';
  }
    //Work Center
  if (!isset($_POST["work_center"])||$_POST["work_center"]=='') {
      $work_centerErr = "Select a work center";
      $correct = False;
  }
  else {
      $work_center = test_input($_POST["work_center"]);
  } 
  //Part Number
  if (empty($_POST["part_number"])) {
      $part_numberErr = "Part Number is required";
      $correct = False;
  }
  else {
    $part_number = test_input($_POST["part_number"]);
    // Check if part number only contains letters, numbers, dashes, and slashes
    if (!preg_match("/^[a-zA-Z0-9\/\- ]*$/",$part_number)) {
      $part_numberErr = "Only letters, numbers, '/', and '-' allowed";
      $correct = False;
    }
  }
  //Quantity
  if (empty($_POST["quantity"])) {
      $quantityErr = "Quantity is required";
      $correct = False;
    }
    else {
      $quantity = test_input($_POST["quantity"]);
      // Check if quantity only contains letters and whitespace
      if (!is_numeric($quantity)) {
        $quantityErr = "Only numbers allowed";
        $correct = False;
      }
    }
  //Start Time
  if (empty($_POST["start_time"])) {
      $start_timeErr = "Start time is required";
      $correct = False;
    } 
    else {
      $start_time = test_input($_POST["start_time"]);
      }
  //End Time
  if (empty($_POST["end_time"])) {
      $end_timeErr = "End time is required";
      $correct = False;

    } 
    else {
      $end_time = test_input($_POST["end_time"]);
      if ($start_time > $end_time) {
          $end_timeErr = "End time must occur after start time";
          $correct = False;
        }
      }
  //Sequence
  if (empty($_POST["sequence_num"])) {
      $sequence_numErr = "Sequence is required";
      $correct = False;
    }
  else {
    $sequence_num = test_input($_POST["sequence_num"]);
    // check if sequence is a number
    if (!is_numeric($sequence_num)) {
      $sequence_numErr = "Only numbers allowed";
      $correct = False;
    }
  }
  //Progress
  if (empty($_POST["progress"])) {
      $progressErr = "Progress is required";
      $correct = False;
  } else {
      $progress = test_input($_POST["progress"]);
  }
  //Setup Time
  if ($_POST['setup_time'] != 0 && empty($_POST["setup_time"])) {
    $setup_timeErr = "Setup Time is required";
    $correct = False;
  } 
  else {
    $setup_time= test_input($_POST['setup_time']);
    if (!preg_match("#^[0-9]+$#",$setup_time)){
        $setup_timeErr = "Integer required";
        $correct = False;
    }
  }

  // Nonrequired fields
  $die_set = test_input($_POST["die_set"]);
  $material_lot = test_input($_POST["material_lot"]);

  // Status Code
  if ($_POST["status_code"] == '') {
      $status_codeErr = "Select a status code";
      $correct = False;
  }
  else {
      $status_code = test_input($_POST["status_code"]);
  }    
  // Comments
  if (empty($_POST["comments"])) {
      $comments = '';
  } else {
    $comments = test_input($_POST["comments"]);
  }
  // Retrieve the IP address of the sending machine and assign to variable
  $reporting_node = $_SERVER['REMOTE_ADDR'];
}   

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = str_replace("'","",$data);
  return $data;
}
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Entry Form</title>
  <style>
    body {
      text-align: center;
      border: 2px solid black; /* Add a border to the body */
      width: 95%; /* Set a specific width for the body */
      margin: 0 auto; /* Center the body horizontally */
      padding: 10px; /* Add padding to create space between content and border */
    }

    p.warning {
      color: red; /* Set the text color to red */
    }
  </style>
</head>
<body>
  <h1>Data Entry Form</h1>
  <p>Please enter appropriate information into all the required fields.</p>
  <p class="warning">* Indicates a required field</p>
</body>
</html> 

<style>
  form {
    border: 2px solid black;
    padding: 20px;
    border-radius: 10px;
    text-align: left; /* Align form content to the left */
  }

  div {
    margin-bottom: 10px;
  }
  label {
    display: inline-block;
    width: 150px;
    margin-bottom: 10px;
  }
  input {
    width:200px;
    padding: 5px 10px;
  }
  .error {
      color: red;
  }
</style>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

  <label for="employee_name">Employee Name:</label>
  <input type="text" id="employee_name" name="employee_name" value="<?php echo isset($_SESSION['employeeName']) ? htmlspecialchars($_SESSION['employeeName']) : ''; ?>">
  <span class="error">* <?php echo $employee_nameErr;?></span><br>

  <label for="employee_id">Employee Id:</label>
  <input type="text" id="employee_id" name="employee_id" value="<?php echo isset($_SESSION['employeeId']) ? htmlspecialchars($_SESSION['employeeId']) : ''; ?>">
  <span class="error">* <?php echo $employee_idErr;?></span><br>

  <label for="work_order">Work Order:</label>
  <input type="text" id="work_order" name="work_order" value ="<?php echo $work_order;?>">
  <span class="error">* <?php echo $work_orderErr;?></span><br>

  <label for="department">Department: </label>
  <select id="department" name="department">
  <option value="" selected="selected">Select department</option>
  </select>
  <span class="error">* <?php echo $departmentErr;?></span><br><br>

  <label for="work_center">Work Center: </label>
  <select id="work_center" name="work_center">
  <option value="" selected="selected">Please select department first</option>
  </select>
  <span class="error">* <?php echo $work_centerErr;?></span><br><br>

  <label for="part_number">Part Number:</label>
  <input type="text" id="part_number" name="part_number" value ="<?php echo $part_number;?>">
  <span class="error">* <?php echo $part_numberErr;?></span><br>

  <label for="quantity">Quantity:</label>
  <input type="text" id="quantity" name="quantity" size=5 value ="<?php echo $quantity;?>">
  <span class="error">* <?php echo $quantityErr;?></span><br><br>

  <label for="start_time">Start Time:</label>
  <input type="time" id="start_time" name="start_time" value ="<?php echo $start_time;?>">
  <span class="error">* <?php echo $start_timeErr;?></span><br>

  <label for="end_time">End Time:</label>
  <input type="time" id="end_time" name="end_time" value ="<?php echo $end_time;?>">
  <span class="error">* <?php echo $end_timeErr;?></span><br><br>

  <label for="sequence_num">Sequence:</label>
  <input type="text" id="sequence_num" name="sequence_num" value ="<?php echo $sequence_num;?>">
  <span class="error">* <?php echo $sequence_numErr;?></span><br><br>

  <div>
  <label for="progress">Progress:</label>
  <span class="error">* <?php echo $progressErr;?></span><br>
  <input type="radio" id="complete" name="progress" value="COMPLETE" <?php if(isset($_POST['progress']) && $_POST['progress'] == 'COMPLETE') echo 'checked'; ?>/>
  <label for="complete">Complete</label>
  <input type="radio" id="partial" name="progress" value="PARTIAL" <?php if(isset($_POST['progress']) && $_POST['progress'] == 'PARTIAL') echo 'checked'; ?>/>
  <label for="partial">Partial</label>
  </div>

  <label for="setup_time">Setup Time (Minutes):</label>
  <input type="text" id="setup_time" name="setup_time" size=5 value ="<?php echo $setup_time;?>">
  <span class="error">* <?php echo $setup_timeErr;?></span><br>

  Die Set Number: <select name="die_set" onchange="if(this.options[this.selectedIndex].value=='customOption'){toggleField(this,this.nextSibling); this.selectedIndex='0';}">
  <option></option>
  <?php 
    $die_set_options = array('A-D', 'AN735', 'ARVIN', 'E-1-3', 'E-1-AD', 'E-1-F', 'E-1-G', 'J-R', 'J-R1', 'J-R2', 'J-R4', 'J-RA', 'J-RB', 'K077-223', 'S-Z');
    $match_die_set = FALSE;
    foreach ($die_set_options as $value) {
          if ($die_set === $value) {
              echo "<option value='customOption'>[Type a die name]</option>";
              $match_die_set = TRUE;
          } 
      }
      if($match_die_set == FALSE){
          if($die_set == ''){
              echo "<option value='customOption'>[Type a die name]</option>";
          }
          else{
              echo "<option value='customOption' selected>$die_set</option>";
          } 
      }
  ?>
  </option>
  <option <?php if($_POST['die_set'] == 'A-D'){echo ' selected';} ?>>A-D</option>
  <option <?php if($_POST['die_set'] == 'AN735'){echo ' selected';} ?>>AN735</option>
  <option <?php if($_POST['die_set'] == 'ARVIN'){echo ' selected';} ?>>ARVIN</option>
  <option <?php if($_POST['die_set'] == 'E-1-3'){echo ' selected';} ?>>E-1-3</option>
  <option <?php if($_POST['die_set'] == 'E-1-AD'){echo ' selected';} ?>>E-1-AD</option>
  <option <?php if($_POST['die_set'] == 'E-1-F'){echo ' selected';} ?>>E-1-F</option>
  <option <?php if($_POST['die_set'] == 'E-1-G'){echo ' selected';} ?>>E-1-G</option>
  <option <?php if($_POST['die_set'] == 'J-R'){echo ' selected';} ?>>J-R</option>
  <option <?php if($_POST['die_set'] == 'J-R1'){echo ' selected';} ?>>J-R1</option>
  <option <?php if($_POST['die_set'] == 'J-R2'){echo ' selected';} ?>>J-R2</option>
  <option <?php if($_POST['die_set'] == 'J-R4'){echo ' selected';} ?>>J-R4</option>
  <option <?php if($_POST['die_set'] == 'J-RA'){echo ' selected';} ?>>J-RA</option>
  <option <?php if($_POST['die_set'] == 'J-RB'){echo ' selected';} ?>>J-RB</option>
  <option <?php if($_POST['die_set'] == 'K077-223'){echo ' selected';} ?>>K077-223</option>
  <option <?php if($_POST['die_set'] == 'S-Z'){echo ' selected';} ?>>S-Z</option>
  </select><input name="die_set" style="display:none;" disabled="disabled" onblur="if(this.value==''){toggleField(this,this.previousSibling);}" value ="<?php echo $die_set;?>">
  <br>

  <label for="material_lot">Material Lot #:</label>
  <input type="text" id="material_lot" name="material_lot" value ="<?php echo $material_lot;?>"><br>

  <label for="status_code">Status Code:</label>
  <select name="status_code" id="status_code"> 
  <option value=""<?php if($_POST['status_code'] == ''){echo ' selected';} ?>>Select...</option>
  <option value=1<?php if($_POST['status_code'] == 1){echo ' selected';} ?>>Normal Operation</option>
  <option value=2<?php if($_POST['status_code'] == 2){echo ' selected';} ?>>Maintenance</option>
  <option value=3<?php if($_POST['status_code'] == 3){echo ' selected';} ?>>Misalignment</option>
  <option value=4<?php if($_POST['status_code'] == 4){echo ' selected';} ?>>Burrs</option>
  <option value=5<?php if($_POST['status_code'] == 5){echo ' selected';} ?>>Raw Material Bad</option>
  <option value=6<?php if($_POST['status_code'] == 6){echo ' selected';} ?>>Raw Material Not Available</option>
  <option value="7"<?php if($_POST['status_code'] == 7){echo ' selected';} ?>>Tooling Not Available</option>
  <option value="8"<?php if($_POST['status_code'] == 8){echo ' selected';} ?>>Scrap</option>
  </select>
  <span class="error">* <?php echo $status_codeErr;?></span>

  <div style="display: flex; flex-direction: column;">
  <label for="comments">Additional Comments:</label>
  <textarea id="comments" name="comments" rows="8" cols="40" value ="<?php echo $comments;?>"></textarea>
  </div>
  <br>

  <button type = “submit” name = "submit" value = "submit" style="
  background-color: #4CAF50; "
  >Submit</button>

</form>

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<h2>Your Input:</h2>";
    echo "<body>Employee ID: $employee_id</body><br>";
    echo "<body>Work Order: $work_order</body><br>";
    echo "<body>Department: $department</body><br>";
    echo "<body>Work Center: $work_center</body><br>";
    echo "<body>Part Number: $part_number</body><br>";
    echo "<body>Quantity: $quantity</body><br>";
    echo "<body>Start Time: $start_time</body><br>";
    echo "<body>End Time: $end_time</body><br>";
    echo "<body>Sequence: $sequence_num</body><br>";
    echo "<body>Progress: $progress</body><br>";
    echo "<body>Setup Time: $setup_time</body><br>";
    echo "<body>Die Set Number: $die_set</body><br>";
    echo "<body>Material Lot #: $material_lot</body><br>";
    echo "<body>Status Code: $status_code</body><br>";
    echo "<body>Additional Info: $comments</body><br>";

}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" and ($correct == False)) {
    echo "<script>alert('ERROR: Please fill out all required fields and resubmit');</script>"; // Alert box for when form not properly submitted
}

if ($_SERVER["REQUEST_METHOD"] == "POST" and $correct) {

    // The following line is for connecting to the Database
    $mysqli = new mysqli("ucr.proj.jmpdc23.com", "pdc1647_Test1114", "ucrpwdZG23", "pdc1647_Test1114");

      if ($mysqli->connect_error) {
       die("Connection failed: " . $mysqli->connect_error);
     }
          else {
              echo "Connection secured <br>";
      }
    
    $sql="INSERT INTO pdc1647_Test1114.record (employee_name, employee_id, work_order, reporting_node, work_center, part_number, quantity, start_time, end_time, sequence_num, progress, setup_time, die_set, material_lot, status_code, comments, department)
    VALUES ('$employee_name','$employee_id','$work_order','$reporting_node','$work_center','$part_number','$quantity','$start_time','$end_time','$sequence_num','$progress','$setup_time','$die_set','$material_lot','$status_code','$comments','$department')";

    if (mysqli_query($mysqli, $sql)) {
      echo "New record created successfully";
      // After successful entry record, unset variables to clear form
      unset($employee_name);
      unset($employee_id);
      unset($work_order);
      unset($part_number);
      unset($work_center);
      unset($department);
      unset($quantity);
      unset($start_time);
      unset($end_time);
      unset($sequence_num);
      unset($progress);
      unset($setup_time);
      unset($die_set);
      unset($material_lot);
      unset($status_code);
      unset($comments);
      echo "<script>";
      echo "document.getElementById('employee_name').value = '';";
      echo "document.getElementById('employee_id').value = '';";
      echo "document.getElementById('work_order').value = '';";
      echo "document.getElementById('part_number').value = '';";
      echo "document.getElementById('quantity').value = '';";
      echo "document.getElementById('start_time').value = '';";
      echo "document.getElementById('end_time').value = '';";
      echo "document.getElementById('sequence_num').value = '';";
      echo "document.getElementById('material_lot').value = '';";
      echo "document.getElementById('setup_time').value = '';";
      echo "document.getElementById('status_code').value = '';";
        
      echo "</script>";

        } else {
            echo "Error: " . $sql . "<br>" . 
            mysqli_error($mysqli);
        }

      mysqli_close($mysqli);
    }

?>
