<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DeliveryStatus Model
 *
 * @method \App\Model\Entity\DeliveryStatus newEmptyEntity()
 * @method \App\Model\Entity\DeliveryStatus newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\DeliveryStatus> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DeliveryStatus get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\DeliveryStatus findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\DeliveryStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\DeliveryStatus> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\DeliveryStatus|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\DeliveryStatus saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\DeliveryStatus>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\DeliveryStatus>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\DeliveryStatus>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\DeliveryStatus> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\DeliveryStatus>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\DeliveryStatus>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\DeliveryStatus>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\DeliveryStatus> deleteManyOrFail(iterable $entities, array $options = [])
 */
class DeliveryStatusTable extends Table
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

        $this->setTable('delivery_status');
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
            ->scalar('delivery_status')
            ->maxLength('delivery_status', 32)
            ->requirePresence('delivery_status', 'create')
            ->notEmptyString('delivery_status');

        return $validator;
    }
}
