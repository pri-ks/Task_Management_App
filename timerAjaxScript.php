<script type="text/javascript">
     var pause_flag=[],stop_flag=[],h1=[],m1=[],s1=[],yr=[],mt=[],dt=[],exttime=[];
     var demo=[];
     function DetailExtract(num)
     {
         var result;
           $.ajax({
               async:false,
               type: "post",
               url: "TaskInfo.php",
               data: {
                   num:num
               },
               success: function (data){
                result= data;
               },
               error: function (xhr, ajaxOptions, thrownError){
               }
           });
           return result;
     }
     // function pauseTimeExtract(num)
     // {
     //     var result;
     //       $.ajax({
     //           async:false,
     //           type: "post",
     //           url: "PauseTimeDetail.php",
     //           data: {
     //               num:num
     //           },
     //           success: function (data){
     //            result= data;
     //           },
     //           error: function (xhr, ajaxOptions, thrownError){
     //           }
     //       });
     //       return result;
     // } 
     function getdate(h,m,s,yr,mt,dt,count,cuttime)
     {
             var msecPerMinute = 1000 * 60; 
             var msecPerHour = msecPerMinute * 60;  
             var msecPerDay = msecPerHour * 24;
             mt=mt-1; 
             var startday=new Date(yr,mt,dt,h,m,s,0);
             var today = new Date();
             var interval = today.getTime()- startday.getTime()-cuttime;
             var days = Math.floor(interval / msecPerDay );
             interval = interval - (days * msecPerDay );    
             var hours = Math.floor(interval / msecPerHour );
             interval = interval - (hours * msecPerHour );  
             var minutes = Math.floor(interval / msecPerMinute );  
             interval = interval - (minutes * msecPerMinute );  
             var seconds = Math.floor(interval / 1000 ); 
             days=Math.abs(days);
             if(hours<10)
             {
               hours="0"+hours;
             }
             if(minutes<10)
             {
               minutes="0"+minutes;
             }
             if(seconds<10)
             {
               seconds="0"+seconds;
             }
             $('.Timer'+count).html(days+ ":" +hours+":"+minutes+ ":" +seconds);
     }
     function countdown(h2,m2,s2,yr2,mt2,dt2,num,cuttime)
     {
           if(pause_flag[num-1]==0 && stop_flag[num-1]==0)
           {
             getdate(h2,m2,s2,yr2,mt2,dt2,num,cuttime);
             demo[num-1][0]=setTimeout(function(){countdown(h2,m2,s2,yr2,mt2,dt2,num,cuttime)}, 1000);
           }
     }
     var tasknum=[];
     var inx=0;
     $('[data-task-num]').each(function(){
        tasknum[inx]=$(this).data('task-num');
        inx++;
    });
     var ind=0;
     for(ind=0;ind<tasknum.length;ind++)
     {
        num=tasknum[ind];
        var task_info = JSON.parse(DetailExtract(num));
        timecounter=task_info[0];
        timecounter=timecounter.split(':',3);
        var daycounter = task_info[1];
        daycounter=daycounter.split('-',3);
        pause_flag[num-1]=task_info[2];
        stop_flag[num-1]=task_info[3];
        demo[num-1] = [];                     
        h1[num-1]=parseFloat(timecounter[0]);
        m1[num-1]=parseFloat(timecounter[1]);
        s1[num-1]=parseFloat(timecounter[2]);
        yr[num-1]=parseFloat(daycounter[0]);
        mt[num-1]=parseFloat(daycounter[1]);
        dt[num-1]=parseFloat(daycounter[2]);
        var pausetime=task_info[4];
        exttime[num-1]=parseInt(pausetime)*1000;
        countdown(h1[num-1],m1[num-1],s1[num-1],yr[num-1],mt[num-1],dt[num-1],num,exttime[num-1]);
      }
     function halttask(tID)
     {
         if (confirm("Do you want to Pause/Resume this task?"))
        {
         var ptime=document.querySelector('.Timer' + tID).innerHTML;
         if(pause_flag[tID-1]==0)
         {
            $(".pausefield"+ tID).html("Resume");
            $(".statusfield"+ tID).html("Halted");
            var cnt= $(".pcount"+ tID).html();
            cnt++;
            $(".pcount"+ tID).html(cnt);
            pause_flag[tID-1]=1;
            clearTimeout(demo[tID-1][0]);
            $.ajax({
                     async:false,
                     type: "post",
                     url: "PauseTask.php",
                     data: {
                         tID:tID,
                         ptime:ptime
                     },
                     success: function (data){
                     },
                     error: function (xhr, ajaxOptions, thrownError){
                     }
                  });
          }
          else
          {
            $.ajax({
                     async:false,
                     type: "post",
                     url: "ResumeTask.php",
                     data: {
                         tID:tID
                     },
                     success: function (data){
                      var res=data;
                      exttime[tID-1]=res.slice(1, -1);
                     },
                     error: function (xhr, ajaxOptions, thrownError){
                     }
                  });
            pause_flag[tID-1]=0;
            exttime[tID-1]=parseInt(exttime[tID-1])*1000;
            countdown(h1[tID-1],m1[tID-1],s1[tID-1],yr[tID-1],mt[tID-1],dt[tID-1],tID,exttime[tID-1]);
            $(".pausefield"+ tID).html("Pause");
            $(".statusfield"+ tID).html("In Progress");
          }
        }
          return false;
     }
     function stoptask(tID)
     {
          if(endtask()==true)
          {
            clearTimeout(demo[tID-1][0]);
            var stime=document.querySelector('.Timer' + tID).innerHTML;
            var stopf;
            $.ajax({
                    async:false,
                    type: "post",
                    url: "StopTask.php",
                    data:{
                           tID:tID,
                           stime:stime
                          },
                    success: function (data){
                        stopf=JSON.parse(data);
                    },
                    error: function (xhr, ajaxOptions, thrownError){}
                  });
            $(".pausefield" + tID).attr("href", "#");
            $(".stopfield" + tID).attr("href", "#");
            $(".delfield" + tID).attr("href", "#");
            $(".pausefield"+ tID).html("---");
            $(".stopfield"+ tID).html("---");
            $(".delfield"+ tID).html("---");
            $(".stoptime"+ tID).html(stopf);
            $(".statusfield"+ tID).html("Completed");
          }  
     }
</script>