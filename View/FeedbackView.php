<?php
require_once 'Model/Feedback.php';

class FeedbackView extends Feedback
{
    public function __construct()
    {
    }

    public function showFeedback()
    {
        $feedback = $this->getAllUsersFeedback();

        foreach ($feedback as $feed):?>
            <tr>
                <td><?= "@" . $feed['user_name'] ?></td>
                <td><?= $feed['feedback'] ?></td>
                <td><a href="Delete.php?feedbackID=<?= $feed['ID'] ?>" class="btn btn-danger col-12" style="margin-top: 5%">Delete</a>
                </td>
            </tr>
        <?php
        endforeach;
    }


}