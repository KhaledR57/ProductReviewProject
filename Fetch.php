<?php
if (isset($_POST["view"])) {

require_once 'DataBaseConnection.php';
if ($_POST["view"] != '') {
    $update_query = "UPDATE notification SET status=0 WHERE status=1";
    DataBaseConnection::getInstance()->getConnection()->prepare($update_query)->execute();
}
$query = "SELECT * FROM notification ORDER BY ID DESC LIMIT 5";
$results = DataBaseConnection::getInstance()->getConnection()->query($query);
$output = '';

if ($results->num_rows>0) {
foreach ($results

as $result):
$output .= '
<li style="padding: 0.5rem">
        <strong>' . $result["notification_subject"] . '</strong><br/>
        <small><em>' . $result["notification_text"] . '</em></small>
        <hr>
</li>
';

endforeach;
} else {
$output .= '
<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
}

$query_1 = "SELECT * FROM notification WHERE status=1";
$result_1 = DataBaseConnection::getInstance()->getConnection()->query($query_1);
$count = $result_1->num_rows;
$data = array(
'notification' => $output,
'unseen_notification' => $count
);
echo json_encode($data);

}
