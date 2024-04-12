<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrderStatus Model
 *
 * @method \App\Model\Entity\OrderStatus newEmptyEntity()
 * @method \App\Model\Entity\OrderStatus newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\OrderStatus> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrderStatus get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\OrderStatus findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\OrderStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\OrderStatus> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrderStatus|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\OrderStatus saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\OrderStatus>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrderStatus>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\OrderStatus>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrderStatus> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\OrderStatus>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrderStatus>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\OrderStatus>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrderStatus> deleteManyOrFail(iterable $entities, array $options = [])
 */
class OrderStatusTable extends Table
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

        $this->setTable('order_status');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->scalar('order_type')
            ->maxLength('order_type', 32)
            ->requirePresence('order_type', 'create')
            ->notEmptyString('order_type');

        return $validator;
    }
}
