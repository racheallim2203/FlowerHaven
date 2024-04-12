<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PaymentStatus Model
 *
 * @method \App\Model\Entity\PaymentStatus newEmptyEntity()
 * @method \App\Model\Entity\PaymentStatus newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\PaymentStatus> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PaymentStatus get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\PaymentStatus findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\PaymentStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\PaymentStatus> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PaymentStatus|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\PaymentStatus saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\PaymentStatus>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PaymentStatus>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PaymentStatus>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PaymentStatus> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PaymentStatus>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PaymentStatus>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PaymentStatus>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PaymentStatus> deleteManyOrFail(iterable $entities, array $options = [])
 */
class PaymentStatusTable extends Table
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

        $this->setTable('payment_status');
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
            ->scalar('status_type')
            ->maxLength('status_type', 32)
            ->requirePresence('status_type', 'create')
            ->notEmptyString('status_type');

        return $validator;
    }
}
