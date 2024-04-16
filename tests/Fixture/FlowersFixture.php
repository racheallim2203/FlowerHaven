<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FlowersFixture
 */
class FlowersFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 'f875be5c-16dd-488c-90b4-545bc320531e',
                'flower_name' => 'Lorem ipsum dolor sit amet',
                'flower_description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'flower_price' => 1.5,
                'stock_quantity' => 1,
                'category_id' => 'Lorem ip',
                'image' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
