<?php
    function getGraph($days = 10, $mysqli)
    {
        //create array
        $data = array();
        //get data from database
        $sql = "select DATE(`CreatedAt`) FROM cases where `CreatedAt` > now() - INTERVAL $days day ORDER BY CreatedAt ASC";
        //request from database
        $result = $mysqli->query($sql);
        mysqli_close($mysqli);
        while($row = mysqli_fetch_array($result))
        {
            $data[] = $row['DATE(`CreatedAt`)'];
        }
        

        $datesNum = array();
        $finalValues = array();
        //add to datesNum array the last 10 days from today
        for($i = 0; $i < $days; $i++)
        {
            $datesNum[] = date('Y-m-d', strtotime('-'.$i.' days'));
            $finalValues[$i] = 0;
        }
        
        for ($i=0; $i < count($data); $i++) { 
            for ($x=0; $x < count($datesNum); $x++) { 
                if($data[$i] == $datesNum[$x])
                {
                    $finalValues[$x]++;
                }
            }
        }
        return json_encode($finalValues);
    }
?>