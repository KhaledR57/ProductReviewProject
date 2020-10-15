<?php

require_once 'Model/Review.php';

class ReviewView extends Review
{
    public function __construct()
    {
    }

    public function showReview($id)
    {
        $reviews = $this->getUsersReview($id);


        foreach ($reviews as $review):?>

            <tr>
                <td><?= "@" . $review['user_name'] ?></td>
                <td><?= $review['review'] ?></td>
                <td><a href="Delete.php?reviewID=<?= $review['ID'] ?>" class="btn btn-danger col-12"
                       style="margin-top: 5%">Delete</a></td>
            </tr>

        <?php

        endforeach;
    }
    public function showReviewToUser($id)
    {
        $reviews = $this->getUsersReview($id);


        foreach ($reviews as $review):?>

            <tr style="text-align: center">
                <td><?= "@" . $review['user_name'] ?></td>
                <td class="text-center"><?= $review['review'] ?></td>

            </tr>

        <?php

        endforeach;
    }


}