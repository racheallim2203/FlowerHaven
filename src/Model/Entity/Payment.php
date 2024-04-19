<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Validation\Validator;

/**
 * Payment Entity
 *
 * @property string $id
 * @property string $orderdelivery_id
 * @property string $paymentstatus_id
 * @property string $paymentmethod_id
 * @property string $user_id
 *
 * @property \App\Model\Entity\OrderDelivery $order_delivery
 * @property \App\Model\Entity\PaymentStatus $payment_status
 * @property \App\Model\Entity\PaymentMethod $payment_method
 * @property \App\Model\Entity\User $user
 */
class Payment extends Entity
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
        'orderdelivery_id' => true,
        'paymentstatus_id' => true,
        'paymentmethod_id' => true,
        'user_id' => true,
        'order_delivery' => true,
        'payment_status' => true,
        'payment_method' => true,
        'user' => true,
    ];

}
