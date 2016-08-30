<?php /*
$working_path = "C:\xampp\htdocs\messaging_system";
$result = array();
exec("git status;", $result);
print_r($result);
*/
$commit_msg = $_GET['msg'];

echo exec('git add --all');
echo exec('git commit -m '.$commit_msg);
echo exec('git pull origin1 master');

/*fdfdhlklklklklkl*/

?>