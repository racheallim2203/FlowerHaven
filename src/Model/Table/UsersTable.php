<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\PaymentsTable&\Cake\ORM\Association\HasMany $Payments
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\User> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\User> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User> deleteManyOrFail(iterable $entities, array $options = [])
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Payments', [
            'foreignKey' => 'user_id',
        ]);
    }

    /**
     * Default validation rules.
     * With updated validation rules too.
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('username')
            ->minLength('username', 3, 'Username must be at least 3 characters long.')
            ->maxLength('username', 32, 'Username must not exceed 32 characters.')
            ->requirePresence('username', 'create')
            ->notEmptyString('username', 'Username is required.');

        $validator
            ->email('email')
            ->maxLength('email', 255, 'Email must not exceed 255 characters.')
            ->requirePresence('email', 'create')
            ->notEmptyString('email', 'Email is required.')
            ->add('email', 'validFormat', [
                'rule' => 'email',
                'message' => 'Email must be valid.'
            ]);

        $validator
            ->scalar('password')
            ->lengthBetween('password', [8, 50], 'Password must be between 8 and 50 characters long.')
            ->maxLength('password', 255, 'Password must not exceed 255 characters.')
            ->requirePresence('password', 'create')
            ->notEmptyString('password', 'Password is required.')
            ->add('password', 'complexity', [
                'rule' => ['custom', '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/'],
                'message' => 'Password must include at least one uppercase, one lowercase, and one number.'
            ]);

        $validator
            ->scalar('address')
            ->maxLength('address', 255, 'Address must not exceed 255 characters.')
            ->requirePresence('address', 'create')
            ->notEmptyString('address', 'Address is required.');

        $validator
            ->scalar('phone_no')
            ->maxLength('phone_no', 20, 'Phone number must not exceed 20 characters.')
            ->requirePresence('phone_no', 'create')
            ->notEmptyString('phone_no', 'Phone number is required.')
            ->add('phone_no', 'validFormat', [
                'rule' => ['custom', '/^\+?(\d.*){3,}$/'],
                'message' => 'Phone number must be valid.'
            ]);
        
        // Validation rule for password confirmation
        $validator
            ->add('password_confirm', 'custom', [
                'rule' => function ($value, $context) {
                    if (isset($context['data']['password']) && $value !== $context['data']['password']) {
                        return false;
                    }
                    return true;
                },
                'message' => 'The passwords do not match.',
            ]);

        $validator
            ->boolean('isAdmin')
            ->requirePresence('isAdmin', 'create')
            ->notEmptyString('isAdmin');

        $validator
            ->scalar('nonce')
            ->maxLength('nonce', 256)
            ->requirePresence('nonce', 'create')
            ->notEmptyString('nonce');

        $validator
            ->date('nonce_expiry')
            ->requirePresence('nonce_expiry', 'create')
            ->notEmptyDate('nonce_expiry');
        
        $validator
            ->boolean('isArchived')
            ->requirePresence('isArchived', 'create')
            ->notEmptyString('isArchived');
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
        $rules->add($rules->isUnique(['username'], 'This username is already in use.'));
        $rules->add($rules->isUnique(['email'], 'This email is already in use.'));

        return $rules;
    }
}
