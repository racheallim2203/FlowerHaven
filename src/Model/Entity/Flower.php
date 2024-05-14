<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Validation\Validator;

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
        'isArchived' => true,
    ];

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('flower_name')
            ->maxLength('flower_name', 255)
            ->requirePresence('flower_name', 'create')
            ->notEmptyString('flower_name', 'A flower name is required');

        $validator
            ->scalar('flower_description')
            ->requirePresence('flower_description', 'create')
            ->notEmptyString('flower_description', 'A description is required');

        $validator
            ->decimal('flower_price')
            ->requirePresence('flower_price', 'create')
            ->notEmptyString('flower_price', 'A price is required')
            ->greaterThanOrEqual('flower_price', 0, 'The price must be a non-negative number.');

        $validator
            ->integer('stock_quantity')
            ->requirePresence('stock_quantity', 'create')
            ->notEmptyString('stock_quantity', 'Stock quantity is required')
            ->greaterThanOrEqual('stock_quantity', 0, 'The stock quantity must be a non-negative number.');

        // Add validation for the image file if necessary
        $validator
            ->add('image_file', 'file', [
                'rule' => ['mimeType', ['image/jpeg', 'image/png', 'image/gif']],
                'message' => 'Please upload valid image files (jpeg, png, gif).',
                'on' => function ($context) {
                    return !empty($context['data']['image_file']);
                }
            ]);

        return $validator;
    }

}
