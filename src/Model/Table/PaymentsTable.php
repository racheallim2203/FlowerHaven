<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\Payment;
use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Payments Model
 *
 * @property \App\Model\Table\OrderDeliveriesTable&\Cake\ORM\Association\BelongsTo $OrderDeliveries
 * @property \App\Model\Table\PaymentStatusesTable&\Cake\ORM\Association\BelongsTo $PaymentStatuses
 * @property \App\Model\Table\PaymentMethodsTable&\Cake\ORM\Association\BelongsTo $PaymentMethods
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Payment newEmptyEntity()
 * @method \App\Model\Entity\Payment newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Payment> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Payment get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Payment findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Payment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Payment> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Payment|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Payment saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Payment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Payment>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Payment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Payment> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Payment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Payment>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Payment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Payment> deleteManyOrFail(iterable $entities, array $options = [])
 */
class PaymentsTable extends Table
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
        $this->setEntityClass(Payment::class);
        $this->setTable('payments');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');


        $this->belongsTo('OrderDeliveries', [
            'foreignKey' => 'orderdelivery_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('PaymentStatuses', [
            'foreignKey' => 'paymentstatus_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('PaymentMethods', [
            'foreignKey' => 'paymentmethod_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->scalar('orderdelivery_id')
            ->maxLength('orderdelivery_id', 10)
            ->notEmptyString('orderdelivery_id');

        $validator
            ->scalar('paymentstatus_id')
            ->maxLength('paymentstatus_id', 10)
            ->notEmptyString('paymentstatus_id');

        $validator
            ->scalar('paymentmethod_id')
            ->maxLength('paymentmethod_id', 10)
            ->notEmptyString('paymentmethod_id');

        $validator
            ->scalar('user_id')
            ->maxLength('user_id', 10)
            ->notEmptyString('user_id');

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
        $rules->add($rules->existsIn(['orderdelivery_id'], 'OrderDeliveries'), ['errorField' => 'orderdelivery_id']);
        $rules->add($rules->existsIn(['paymentstatus_id'], 'PaymentStatuses'), ['errorField' => 'paymentstatus_id']);
        $rules->add($rules->existsIn(['paymentmethod_id'], 'PaymentMethods'), ['errorField' => 'paymentmethod_id']);
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
