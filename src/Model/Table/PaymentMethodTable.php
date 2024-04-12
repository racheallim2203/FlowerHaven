<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PaymentMethod Model
 *
 * @method \App\Model\Entity\PaymentMethod newEmptyEntity()
 * @method \App\Model\Entity\PaymentMethod newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\PaymentMethod> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PaymentMethod get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\PaymentMethod findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\PaymentMethod patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\PaymentMethod> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PaymentMethod|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\PaymentMethod saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\PaymentMethod>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PaymentMethod>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PaymentMethod>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PaymentMethod> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PaymentMethod>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PaymentMethod>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PaymentMethod>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PaymentMethod> deleteManyOrFail(iterable $entities, array $options = [])
 */
class PaymentMethodTable extends Table
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

        $this->setTable('payment_method');
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
            ->scalar('method_type')
            ->maxLength('method_type', 32)
            ->requirePresence('method_type', 'create')
            ->notEmptyString('method_type');

        return $validator;
    }
}
