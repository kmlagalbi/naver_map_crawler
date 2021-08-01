<?php

    require("navc.php");

    function startCrawl($guName) {  
        $conn = mysqli_connect("your ip address", "id", "password", "places");
       
        /* 강동구
        $sql = "select * from codeStore where cggName = '강동구'";
        $bound = 977;    
        */

        //종로구
        //$sql = "select * from codeStore where cggName = '종로구'";
        //$bound = 1559;


        $boundQ = "select max(id)-min(id)+1 as c from codestore where cggName = \"".$guName."\"";
        $boundQR = mysqli_query($conn, $boundQ);
        $bound = mysqli_fetch_array($boundQR)["c"];

        echo $guName."의 ".$bound."개 (중복 포함된 개수) 도로명주소에 대해서 크롤링 진행<br><br>";

        $sql = "select * from codestore where cggName = \"".$guName."\"";
        $result = mysqli_query($conn, $sql);

        $i = 0;
        $tempRoad = "";
        $cntR = 0;

        //https://www.juso.go.kr/info/RoadNameDataList.do?currentPage=3916&countPerPage=10&&city1=&county1=&town1=&keyword=&roadCd=&searchType=0&extend=true

        while ($i < $bound && $now = mysqli_fetch_array($result)["dName"]) {
            if($now == $tempRoad) {
                continue;
            }
            else {
                $cntR++;
                echo $now."<br>";
                AutoC($now);
                $tempRoad = $now;
            }
            $i++;
        }

        echo $cntR."개 도로명주소에 대해서 크롤링 수행 완료";
        
    }

    //crawler
    startCrawl("강남구");


?>
