<?php
require_once 'Model/Rating.php';

class RateView extends Rating
{
    public function __construct()
    {
    }

    public function showAVG($id)
    {
        $this->getProductAvgReview($id);
    }

    public function showRate($id)
    {
        $rates = $this->getUsersRate($id);


        foreach ($rates as $rate):?>

            <tr>
                <td><?= $rate['first_name'] . " " . $rate['last_name'] ?></td>
                <td><?= "@" . $rate['user_name'] ?></td>
                <td><?= $rate['product_name'] ?></td>
                <td><?= $rate['rate'] . " from 5 "; ?></td>
                <td>
                    <progress id="myProgress" value="<?= $rate['rate'] ?>" max="5"></progress>
                </td>


            </tr>

        <?php

        endforeach;
    }

}