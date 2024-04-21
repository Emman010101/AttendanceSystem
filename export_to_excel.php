<?php
    include "dbconnect.php";
    include "session.php";
    $output = "";

    if(isset($_GET['export'])){
        $sql = $_SESSION['sql'];
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $output .= '
                       <table class="table" bordered="1">
                        <TR>
                            <TH>LRN</TH>
                            <TH>Name</TH>
                            <TH>Time-in</TH>
                            <TH>Time-out</TH>
                            <TH>Date</TH>
                        </TR>';
            while($row = mysqli_fetch_assoc($result)) {
                $output .= '
                            <TR>
                                <TD> '.strval($row['student_lrn']).'</TD>
                                <TD> '.$row['student_fname']." ".$row['student_mname']." ".$row['student_lname'].'</TD>
                                <TD> '.$row['time_in'].'</TD>
                                <TD> '.$row['time_out'].'</TD>
                                <TD> '.$row['date'].'</TD>
                            </TR>';
            }
            $output .= '</table>';
            header('Content-Type: application/xls');
            header('Content-Disposition: attachment; filename=Reports.xls');
            echo $output;
            exit();
        }
    }
?>