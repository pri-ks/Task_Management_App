<?php
function userNoOfTasks()
{
    $convar   = new connect();
    $uname = $_SESSION['login_user'];
    $curyr = date('Y');
    $taskcats=array("Email Monetization","General","Skenzo");
    
    if(isset($_GET['mt']) && !empty($_GET['mt']))
    {
     $monthval=$_GET['mt'];   
    }
    else{
     $monthval='';
    }
        
        if($monthval=='yr')
        {
            
            for($j=0;$j<count($taskcats);$j++)
            {
                //On Going Tasks of Particular User
                $mycount1  = mysqli_query($convar->conn, "SELECT COUNT(TaskID) FROM taskdetails WHERE Username='$uname' AND YEAR(TaskDate)=$curyr AND TaskCategory='$taskcats[$j]' AND Stopflag='0'");
                $mycountrow1  = mysqli_fetch_row($mycount1);
                if($mycountrow1==null)
                {
                  $mycountrow1=0;
                }
                $res[$j][] = $mycountrow1;

                  //Completed Tasks of Particular User
                $mycount2  = mysqli_query($convar->conn, "SELECT COUNT(TaskID) FROM taskdetails WHERE Username='$uname' AND YEAR(TaskDate)=$curyr AND TaskCategory='$taskcats[$j]' AND Stopflag='1'");
                $mycountrow2  = mysqli_fetch_row($mycount2);
                if($mycountrow2==null)
                {
                  $mycountrow2=0;
                }
                $res[$j+3][] = $mycountrow2;
            }

        }
        else if($monthval=='prev'){
            
             $curmonth = date('m')-1;
            for($j=0;$j<count($taskcats);$j++)
            {
                //On Going Tasks of Particular User
                $mycount1  = mysqli_query($convar->conn, "SELECT COUNT(TaskID) FROM taskdetails WHERE Username='$uname' AND MONTH(TaskDate)=$curmonth AND YEAR(TaskDate)=$curyr AND TaskCategory='$taskcats[$j]' AND Stopflag='0'");
                $mycountrow1  = mysqli_fetch_row($mycount1);
                if($mycountrow1==null)
                {
                  $mycountrow1=0;
                }
                $res[$j][] = $mycountrow1;

                  //Completed Tasks of Particular User
                $mycount2  = mysqli_query($convar->conn, "SELECT COUNT(TaskID) FROM taskdetails WHERE Username='$uname' AND MONTH(TaskDate)=$curmonth AND YEAR(TaskDate)=$curyr AND TaskCategory='$taskcats[$j]' AND Stopflag='1'");
                $mycountrow2  = mysqli_fetch_row($mycount2);
                if($mycountrow2==null)
                {
                  $mycountrow2=0;
                }
                $res[$j+3][] = $mycountrow2;
            }
        }
        else{
             $curmonth = date('m');
            for($j=0;$j<count($taskcats);$j++)
            {
                //On Going Tasks of Particular User
                $mycount1  = mysqli_query($convar->conn, "SELECT COUNT(TaskID) FROM taskdetails WHERE Username='$uname' AND MONTH(TaskDate)=$curmonth AND YEAR(TaskDate)=$curyr AND TaskCategory='$taskcats[$j]' AND Stopflag='0'");
                $mycountrow1  = mysqli_fetch_row($mycount1);
                if($mycountrow1==null)
                {
                  $mycountrow1=0;
                }
                $res[$j][] = $mycountrow1;

                  //Completed Tasks of Particular User
                $mycount2  = mysqli_query($convar->conn, "SELECT COUNT(TaskID) FROM taskdetails WHERE Username='$uname' AND MONTH(TaskDate)=$curmonth AND YEAR(TaskDate)=$curyr AND TaskCategory='$taskcats[$j]' AND Stopflag='1'");
                $mycountrow2  = mysqli_fetch_row($mycount2);
                if($mycountrow2==null)
                {
                  $mycountrow2=0;
                }
                $res[$j+3][] = $mycountrow2;
            }
        }
    echo json_encode($res);
}
?>
<script type="text/javascript">
var catcount= <?php userNoOfTasks(); ?>;
if(catcount!=0)
{
    var usract=[],usrcom=[], dataObj = [];
    for(i=0;i<3;i++)
    { 
        usract[i]=parseInt(catcount[i]);
        usrcom[i]=parseInt(catcount[i+3]);
        dataObj[i] = [usract[i],usrcom[i]];
    }
    Highcharts.chart('usercattrack', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Your Task Breakdown'
        },
        xAxis: {
            categories: ['Tasks In-Progress','Tasks Completed'],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Number'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Email Monetization',
            data: dataObj[0]

        }, {
            name: 'General',
            data: dataObj[1]

        }, {
            name: 'skenzo',
            data: dataObj[2]

        }]
    });
}
else{
    $('#usercattrack').css('display','none');
}
</script>
