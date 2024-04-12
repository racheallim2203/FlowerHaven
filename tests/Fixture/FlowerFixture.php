<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FlowerFixture
 */
class FlowerFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'flower';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => '388388cc-58ae-48bf-a01b-8764cc421e3a',
                'flower_name' => 'Lorem ipsum dolor sit amet',
                'flower_description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'flower_price' => 1.5,
                'stock_quantity' => 1,
                'category_id' => 'Lorem ip',
            ],
        ];
        parent::init();
    }
}
