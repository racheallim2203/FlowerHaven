<?php
declare(strict_types=1);

namespace App\Model\Table\OldTables;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrderFlower Model
 *
 * @property \App\Model\Table\OldTables\FlowerTable&\Cake\ORM\Association\BelongsTo $Flowers
 * @property \App\Model\Table\OldTables\OrderDeliveryTable&\Cake\ORM\Association\BelongsTo $OrderDelivery
 *
 * @method \App\Model\Entity\OrderFlower newEmptyEntity()
 * @method \App\Model\Entity\OrderFlower newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\OrderFlower> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrderFlower get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\OrderFlower findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\OrderFlower patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\OrderFlower> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrderFlower|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\OrderFlower saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\OrderFlower>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrderFlower>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\OrderFlower>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrderFlower> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\OrderFlower>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrderFlower>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\OrderFlower>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrderFlower> deleteManyOrFail(iterable $entities, array $options = [])
 */
class OrderFlowerTable extends Table
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

        $this->setTable('order_flower');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Flowers', [
            'foreignKey' => 'flower_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('OrderDelivery', [
            'foreignKey' => 'orderdelivery_id',
            'joinType' => 'INNER',
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
            ->scalar('flower_id')
            ->maxLength('flower_id', 10)
            ->notEmptyString('flower_id');

        $validator
            ->scalar('orderdelivery_id')
            ->maxLength('orderdelivery_id', 10)
            ->notEmptyString('orderdelivery_id');

        $validator
            ->integer('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmptyString('quantity');

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
        $rules->add($rules->existsIn(['flower_id'], 'Flowers'), ['errorField' => 'flower_id']);
        $rules->add($rules->existsIn(['orderdelivery_id'], 'OrderDelivery'), ['errorField' => 'orderdelivery_id']);

        return $rules;
    }
}
