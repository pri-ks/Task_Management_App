<script type="text/javascript">
function deltask(val)
{
  if (confirm("Do you want to delete this task?"))
  {
    window.location='DeleteTask.php?d='+val+'';
  }
}
function endtask()
{
  if (confirm("Do you want to End this task?"))
  {
    return true;
  }
  return false;
}
</script>