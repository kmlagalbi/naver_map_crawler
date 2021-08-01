<?php
    $conn = mysqli_connect("your ip address", "id", "password", "places");

    $dataAdd = "LOAD DATA LOCAL INFILE 'd.txt' ";
    $p1 = "INTO TABLE codeStore CHARACTER SET utf8 FIELDS TERMINATED BY '|' ";
    $p2 = "LINES TERMINATED BY '\n'";
    $p3 = "(@dCode,
            @dName,
            @dRome,
            @uNumber,
            @cdName,
            @cdRome,
            @cggName,
            @cggRome,
            @uName,
            @uRome,
            @uDist,
            @uCode,
            @isUsed,
            @hist,
            @stD,
            @trD
            )
            
            SET
            dCode = @dCode,
            dName = @dName,
            dRome = @dRome,
            uNumber = @uNumber,
            cdName = @cdName,
            cdRome = @cdRome,
            cggName = @cggName,
            cggRome = @cggRome,
            uName = @uName,
            uRome = @uRome,
            uDist = @uDist,
            uCode = @uCode,
            isUsed = @isUsed,
            hist = @hist,
            stD = @stD,
            trD = @trD
            ";

    $sql = $dataAdd.$p1.$p2.$p3;

    $result = mysqli_query($conn, $sql);
    if($result === false){
        echo mysqli_error($conn);
    }
    
?>
