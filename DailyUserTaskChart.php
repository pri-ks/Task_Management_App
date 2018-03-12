<?php
function dailyTaskUser()
{
    $curmonth = date('m');
    $curyr = date('Y');
    $convar   = new connect();
    $res=[];
    $mycount  = mysqli_query($convar->conn, "SELECT dmuser.Username, COUNT(taskdetails.Username) FROM dmuser LEFT JOIN taskdetails ON dmuser.Username = taskdetails.Username WHERE UserRole!='superadmin' AND Activateflag!='0' AND MONTH(TaskDate)=$curmonth AND YEAR(TaskDate)=$curyr GROUP BY dmuser.Username;");
    if($mycount!=null)
    {
      while ($mycountrow = mysqli_fetch_row($mycount))
      {
        $res[] = $mycountrow;
      }
    }
    else{
      $res=0;
    }  
    echo json_encode($res);
}
?>
<script type="text/javascript">
        var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    	var piecount= <?php dailyTaskUser(); ?>;
        if(piecount !=0)
        {
             var pieusr=[],pienum=[], dataObj = [];
             for(i=0;i<piecount.length;i++)
             { 
               pieusr[i]=piecount[i][0];
               pienum[i]=parseInt(piecount[i][1]);
               dataObj[i] = [pieusr[i], pienum[i],'IndividualUserTask.php?user='+pieusr[i]+''];
             }
             Highcharts.chart('pietrack', {
       
             title: {
                 text: 'Individual Task Breakdown : ' + monthNames[new Date().getMonth()] + '-' + new Date().getFullYear() + ''
             },
             xAxis: {
                 categories: pieusr
             },
             plotOptions: {
                series: {
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function() {
                                location.href = this.options.url;
                            }
                        }
                    }
                }
            },
             series: [{
                 type: 'pie',
                 name: 'No of Tasks',
                 allowPointSelect: true,
                 keys: ['name', 'y','url', 'selected', 'sliced'],
                 data: 
                      dataObj,
                 showInLegend: true
               }]
             });
         }
         else{
            $('#pietrack').css('display','none');
         }    
</script>