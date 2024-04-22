<?php
    include 'dbconnect.php';
    include 'session.php';
    $extension = "";
    $search_name = "";

    if(isset($_GET['search'])){
        $search_name = $_GET['search'];
        $extension = " AND student_fname LIKE '%".$_GET['search']."%'";
    }

    $sql = "SELECT * FROM studenttbl WHERE del_fingerid=0".$extension." ORDER BY student_lname";
    $result = mysqli_query($conn, $sql);
    
    $data_arr = array();
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($data_arr, $row);
        }
        //print_r($data_arr);
        
    } else {
        echo "0 results";
    }

    foreach($data_arr as $value){
        echo "<tr ondblclick='rowClicked(".$value['id'].")' onclick='plsDoubleClick()'><td>";
        if($value['fingerprint_select'] == 1){
            echo "<img src='assets/img/ok_check.png' title='The selected UID' height='40px' width='40px'></td>";
        }
        echo '<td>'.$value["student_lrn"].'</td>';
        echo '<td>'.$value["student_fname"].'</td>';
        echo '<td>'.$value["student_mname"].'</td>';
        echo '<td>'.$value["student_lname"].'</td>';
        echo '<td>'.$value["student_birthdate"].'</td>';
        echo '<td>'.$value["student_gender"].'</td>
        <td><span class="custom-badge ';
        if($value['registered'] == 1){
            echo 'status-green">Registered';
        }else{
            echo 'status-red">Not Registered';
        }
        echo '</span></td></tr>';
    }
?>
<script>
        var delete_id = "";
        var fingerprint_id = ""
        var search_name = "<?php echo $search_name?>";

        function fillSearchField(){ 
            document.getElementById("student_name").value = "<?php echo $search_name?>";
        }
        function setId(id, operation, fpid){
            console.log(operation.id);
            operation = operation.id;
            if(operation == "edit_button"){
                window.location.href = "edit_student_page.php?id=" + id;
            }else{
                delete_id = id;
                fingerprint_id = fpid;
                console.log(fpid);
            }
        }

        function deleteStudent(){
            window.location.href = "delete_student.php?id=" + delete_id + "&fpid=" + fingerprint_id;
        }

        function searchName(){
            var search_name = document.getElementById("student_name").value;

            window.location.href = "register_biometric_page.php?search=" + search_name;
        }

        function rowClicked(id){
            console.log("row "+id+" is clicked");
            window.location.href = "select_row.php?id=" + id + "&search="+ search_name;
        }

        function plsDoubleClick(){
            toastr.warning("Double click to a row to start the fingerprint registration");
        }
    </script>