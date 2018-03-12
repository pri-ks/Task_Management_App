<?php
function dailyTaskCatwise()
{
  $convar   = new connect();
  $curmonth = date('m');
  $curyr = date('Y');
  $user=$_SESSION['login_user'];
  $taskcats=array("Email Monetization","General","Skenzo");
  if(isset($_GET['mt']) && !empty($_GET['mt']))
  {
    $monthval=$_GET['mt'];
    if($monthval=='yr')
    {
       for($j=0;$j<count($taskcats);$j++){
         for ($i = 1; $i <= 12; $i++)
         {
            $mycount  = mysqli_query($convar->conn, "SELECT COUNT(TaskID) FROM taskdetails WHERE Username='$user' AND MONTH(TaskDate)=$i AND YEAR(TaskDate)=$curyr AND TaskCategory='$taskcats[$j]'");
            $mycountrow  = mysqli_fetch_row($mycount);
            if($mycountrow==null)
            {
              $mycountrow=0;
            }
            $res[$j][] = $mycountrow;
         }
        }  
      echo json_encode($res);
      return;
    }
    else if($monthval=='prev')
    {
      $curmonth = date('m')-1;
      if($curmonth==0){
        $curmonth=12;
        $curyr = date('Y')-1;
      }
      $curyr = date('Y');
    }
    else
    {
      $curmonth = date('m');
      $curyr = date('Y');
    }
  }   
    $numdays = cal_days_in_month(CAL_GREGORIAN,$curmonth,$curyr);
    for($j=0;$j<count($taskcats);$j++){
      for ($i = 1; $i <= $numdays; $i++)
      {
        $mycount  = mysqli_query($convar->conn, "SELECT COUNT(TaskID) FROM taskdetails WHERE Username='$user' AND DAY(TaskDate)=$i AND MONTH(TaskDate)=$curmonth AND YEAR(TaskDate)=$curyr AND TaskCategory='$taskcats[$j]'");
        $mycountrow  = mysqli_fetch_row($mycount);
        if($mycountrow==null)
        {
            $mycountrow=0;
        }
         $res[$j][] = $mycountrow;
      }
    }
  echo json_encode($res);
}
?>
<script type="text/javascript">
var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var mdates=[];
var n=0,monthnm=0,year=0,xval;
var d=new Date();
var chartcount= <?php dailyTaskCatwise(); ?>;
var monthval= "<?php if(isset($_GET['mt']) && !empty($_GET['mt'])){echo $_GET['mt'];} else{echo '0';} ?>";
if(monthval=='yr')
{
  mdates=["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
  monthnm='Your Task Chart for the Year : ' +d.getFullYear()+'';
  xval='Months';
}
else
{
  if(monthval=='prev')
  {
    n=d.getMonth()-1;
    if(n<0)
    {
      n=12;
      year=d.getFullYear()-1;
    }
    year=d.getFullYear();
  }
  else
  {
    n=d.getMonth();
    year=d.getFullYear();
  }
  if(n==0 ||n==2 ||n==4 ||n==6 ||n==7 ||n==9 ||n==11)
  {
    for(i=0;i<31;i++)
    mdates[i]=i+1;
  }
  else if(n==1)
  {
    if( (year % 4 == 0) && (year % 100 != 0) || (year % 400 == 0) )
    {
      for(i=0;i<29;i++)
      mdates[i]=i+1;
    }
    else
    {
      for(i=0;i<28;i++)
      {
        mdates[i]=i+1;
      }  
    }
  }
  else
  {
    for(i=0;i<30;i++)
    mdates[i]=i+1;
  }
  monthnm=monthNames[n];
  monthnm='Your Task Chart : '+monthnm+' '+year+'';
  xval='Dates';
}
for(j=0;j<chartcount.length;j++)
{
  for(i=0;i<chartcount[0].length;i++)
  {
    if(chartcount[j][i]==0){
      chartcount[j][i]=null;
      }
      else{
      chartcount[j][i]=parseInt(chartcount[j][i]);
      }
  }
}
      
// High Charts
Highcharts.chart('usermonthlytrack', {
        chart: {
            type: 'column'
        },
        title: {
            text: monthnm
        },
        xAxis: {
            categories:mdates,
            title: {
                text: 'Date'
            }
        },
        yAxis: {
            min: 0,
            allowDecimals: false,
            title: {
                text: 'Month-wise Task Breakdown'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            align: 'right',
            x: -30,
            verticalAlign: 'top',
            y: 25,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },
        series: [{
            name: 'Email Monetization',
            data: chartcount[0]
        },{
            name: 'General',
            data: chartcount[1]
        },{
            name: 'Skenzo',
            data: chartcount[2]
        }]
       });
       // Radialize the colors
       Highcharts.setOptions({
        colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
            return {
                radialGradient: {
                    cx: 0.5,
                    cy: 0.3,
                    r: 0.7
                },
                stops: [
                    [0, color],
                    [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
                ]
            };
        })
});
</script>