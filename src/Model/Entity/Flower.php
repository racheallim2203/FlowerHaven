<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Flowers Entity
 *
 * @property string $id
 * @property string $flower_name
 * @property string $flower_description
 * @property string $flower_price
 * @property int $stock_quantity
 * @property string $category_id
 * @property string|null $image
 *
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\OrderFlower[] $order_flowers
 */
class Flower extends Entity
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
        'flower_name' => true,
        'flower_description' => true,
        'flower_price' => true,
        'stock_quantity' => true,
        'category_id' => true,
        'image' => true,
        'category' => true,
        'order_flowers' => true,
    ];
}
