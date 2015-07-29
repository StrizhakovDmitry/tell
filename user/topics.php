<?
require_once 'check.php';
require_once '../SQL_Connect.php';
function showTopics ($sql,$project_id)
	{
	if($result=$sql->query('SELECT id,name FROM topics WHERE `deleted` is NULL AND project_id ='.$project_id))
		{
		while ($row = $result->fetch_assoc())
			{
			$arr[0][] = $row['name'];
			$arr[1][] = $row['id'];
			};
		return $arr;
		}
	else
		{
		return $sql->error;
		}
	}
$project_id = trim(strip_tags($_GET['project_id']));
$topics = showTopics ($sql,$project_id);
echo json_encode($topics);
?>