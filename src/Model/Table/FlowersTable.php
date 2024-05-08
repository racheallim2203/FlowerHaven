<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Flowers Model
 *
 * @property \App\Model\Table\CategoriesTable&\Cake\ORM\Association\BelongsTo $Categories
 * @property \App\Model\Table\OrderFlowersTable&\Cake\ORM\Association\HasMany $OrderFlowers
 *
 * @method \App\Model\Entity\Flower newEmptyEntity()
 * @method \App\Model\Entity\Flower newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Flower> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Flower get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Flower findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Flower patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Flower> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Flower|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Flower saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Flower>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Flower>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Flower>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Flower> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Flower>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Flower>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Flower>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Flower> deleteManyOrFail(iterable $entities, array $options = [])
 */
class FlowersTable extends Table
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

        $this->setTable('flowers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('OrderFlowers', [
            'foreignKey' => 'flower_id',
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
            ->scalar('flower_name')
            ->maxLength('flower_name', 32, 'The flower name cannot exceed 32 characters.')
            ->requirePresence('flower_name', 'create')
            ->notEmptyString('flower_name', 'Please enter a flower name.');
    
        $validator
            ->scalar('flower_description')
            ->maxLength('flower_description', 255, 'The flower description cannot exceed 255 characters.')
            ->requirePresence('flower_description', 'create')
            ->notEmptyString('flower_description', 'Please provide a description of the flower.');

        $validator
            ->decimal('flower_price')
            ->requirePresence('flower_price', 'create')
            ->maxLength('flower_price', 4, 'The flower price cannot exceed 4 digits.')
            ->notEmptyString('flower_price', 'Please enter the price of the flower.')
            ->greaterThan('flower_price', 0, 'The flower price must be greater than zero.');

        $validator
            ->integer('stock_quantity')
            ->requirePresence('stock_quantity', 'create')
            ->maxLength('stock_quantity', 4, 'The stock quantity cannot exceed 4 digits.')
            ->notEmptyString('stock_quantity', 'Please enter the stock quantity.')
            ->greaterThanOrEqual('stock_quantity', 0, 'The stock quantity cannot be negative.');

        $validator
            ->scalar('category_id')
            ->maxLength('category_id', 10, 'The category ID cannot exceed 10 characters.')
            ->notEmptyString('category_id', 'Please select a category.');

        $validator
            ->add('image_file', [
                'mimeType' => [
                    'rule' => ['mimeType', ['image/jpg', 'image/png', 'image/jpeg']],
                    'message' => 'Please only upload jpg and png',
                ],
                'fileSize' => [
                    'rule' => ['fileSize', '<=', '1MB'],
                    'message' => 'File should be less than 1MB.',
                ],
            ])
            ->allowEmptyFile('change_image')
            ->add('change_image', [
                'mimeType' => [
                    'rule' => ['mimeType', ['image/jpg', 'image/png', 'image/jpeg']],
                    'message' => 'Please only upload jpg and png',
                ],
                'fileSize' => [
                    'rule' => ['fileSize', '<=', '1MB'],
                    'message' => 'File should be less than 1MB.',
                ],
            ]);

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
        $rules->add($rules->existsIn(['category_id'], 'Categories'), ['errorField' => 'category_id']);

        return $rules;
    }
}
