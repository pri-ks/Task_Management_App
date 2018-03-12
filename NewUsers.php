<?php 
include 'style.php';
include 'connect.php';
echo "<body class='dashpg'>
          <form id='newuserform' name='newuserform' method='post' action='' class='clearfix'>";
$glb=new global_function();
$query= $glb -> select("dmuser","UserID,Username,Email","Activateflag='0'");
if($query !=null)
{
  echo "<div class='container'>
            <div class='table-responsive col-md-12 taskcontainer'>
            <table class='table table-bordered'>
            <thead>
            <tr>
            <th>User ID</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Assign User Role</th>
            <th colspan='2'>Operations</th>
            </tr>
            </thead>
            <tbody>";
        foreach($query as $res)
        {
          echo "<tr>
          <td>$res[0]</td>
          <td>$res[1]</td>
          <td>$res[2]</td>
          <td>
            <select name='urole' class='selectpicker$res[0] form-control dashform-control'>
              <option value='Developer'>Developer</option>
              <option value='Admin'>Admin</option>
            </select>
          </td>            
          <td><a href='javascript:approveUser(\"$res[0]\",\"add\")'>Authorize</a></td>
          <td><a href='javascript:approveUser(\"$res[0]\",\"del\")'>Delete</a></td>
          </tr>";
        }
}
else{
  echo "<div class='nodatafoundwrap'><img src='images/notdatafound.png'></div>";
}
echo "</tbody>
      </table>
      </div>
       <div class='dashbtnwrap'><input type='submit' class='dashbtn' name='backbtn' value='BACK'/></div>
      </form>
      </body>";
if (isset($_POST['backbtn']))
    {
      echo "<script language='javascript' type='text/javascript'> location.href='admindashboard.php' </script>";
    }
?>
<script type="text/javascript">
  function approveUser(usrid,oper)
  {
   var usrrole= $('.selectpicker'+ usrid).val();
   $.ajax({
           async:false,
           type: "post",
           url: "ActivateUser.php",
           data: {
                  oper:oper,
                  usrid:usrid,
                  usrrole:usrrole
                  },
          success: function (data){
            window.location='NewUsers.php';
          },
          error: function (xhr, ajaxOptions, thrownError){
          }
  });
  } 
</script>