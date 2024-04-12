<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderFlower Entity
 *
 * @property string $id
 * @property string $flower_id
 * @property string $orderdelivery_id
 * @property int $quantity
 *
 * @property \App\Model\Entity\Flower $flower
 * @property \App\Model\Entity\OrderDelivery $order_delivery
 */
class OrderFlower extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'flower_id' => true,
        'orderdelivery_id' => true,
        'quantity' => true,
        'flower' => true,
        'order_delivery' => true,
    ];
}
