<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderDelivery Entity
 *
 * @property string $id
 * @property string $orderstatus_id
 * @property string $deliverystatus_id
 * @property \Cake\I18n\Date $order_date
 * @property string $total_amount
 * @property \Cake\I18n\Date $delivery_date
 *
 * @property \App\Model\Entity\OrderStatus $orderstatus
 * @property \App\Model\Entity\DeliveryStatus $delivery_status
 */
class OrderDelivery extends Entity
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
        'orderstatus_id' => true,
        'deliverystatus_id' => true,
        'order_date' => true,
        'total_amount' => true,
        'delivery_date' => true,
        'orderstatus' => true,
        'delivery_status' => true,
    ];
}
