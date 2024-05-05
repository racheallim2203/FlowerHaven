<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderFlower Entity
 * * @property string $orderdelivery_id
 * @property string $id
 * @property string $flower_id
 * @property int $quantity
 * @property float|null $total_price
 * @property \App\Model\Entity\Flower $flower
 *  * @property \App\Model\Entity\OrderDelivery $order_delivery
 */

class OrderFlower extends Entity
{
    protected array $_accessible = [
        'flower_id' => true,
        'quantity' => true,
        'flower' => true,
        'orderdelivery_id' => true,
        'order_delivery' => true,
    ];


    protected array $_virtual = ['total_price']; // Add this line if you want to use it as a virtual field

    // Virtual field to compute total price
    protected function _getTotalPrice()
    {
        if (isset($this->flower) && isset($this->flower->flower_price)) {
            return $this->quantity * $this->flower->flower_price;
        }
        return 0.0;
    }
}
