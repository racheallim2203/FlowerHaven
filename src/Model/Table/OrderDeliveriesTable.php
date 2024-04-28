<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrderDeliveries Model
 *
 * @property \App\Model\Table\OrderStatusesTable&\Cake\ORM\Association\BelongsTo $OrderStatuses
 * @property \App\Model\Table\DeliveryStatusesTable&\Cake\ORM\Association\BelongsTo $DeliveryStatuses
 */
class OrderDeliveriesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('order_deliveries');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('OrderFlowers', [
            'foreignKey' => 'order_delivery_id',
        ]);

        $this->hasMany('Flowers', [
            'foreignKey' => 'id',
            'through' => 'OrderFlowers',
        ]);


        // Define associations
        $this->belongsTo('OrderStatuses', [
            'foreignKey' => 'orderstatus_id',
            'joinType' => 'INNER'
        ]);


        $this->belongsTo('DeliveryStatuses', [
            'foreignKey' => 'deliverystatus_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('orderstatus_id')
            ->maxLength('orderstatus_id', 10)
            ->notEmptyString('orderstatus_id');

        $validator
            ->scalar('deliverystatus_id')
            ->maxLength('deliverystatus_id', 10)
            ->notEmptyString('deliverystatus_id');

        $validator
            ->date('order_date')
            ->requirePresence('order_date', 'create')
            ->notEmptyDate('order_date');

        $validator
            ->decimal('total_amount')
            ->requirePresence('total_amount', 'create')
            ->notEmptyString('total_amount');

        $validator
            ->date('delivery_date')
            ->requirePresence('delivery_date', 'create')
            ->notEmptyDate('delivery_date');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['orderstatus_id'], 'OrderStatuses'), ['errorField' => 'orderstatus_id']);
        $rules->add($rules->existsIn(['deliverystatus_id'], 'DeliveryStatuses'), ['errorField' => 'deliverystatus_id']);

        return $rules;
    }
}
