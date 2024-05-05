<?php

declare(strict_types=1);

namespace Cp\User\Setup\Patch\Data;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * Class CreateCustomAttr for Create Custom Product Attribute using Data Patch.
 */
class ProductCustomAttribute implements DataPatchInterface
{

    /**
     * ModuleDataSetupInterface
     *
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * EavSetupFactory
     *
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory          $eavSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $attributes = [
            [
                'code' => 'custom_storage',
                'label' => 'Custom Storage',
                'input' => 'select',
                'source' => 'Cp\User\Model\Config\Source\Custom',
                'type' => 'int'
                
                // Add other attribute options here
            ],
            [
                'code' => 'custom_ram',
                'label' => 'Ram',
                'input' => 'select',
                'source' => 'Cp\User\Model\Config\Source\CustomAttributeSource',
                'type' => 'int'

                // Add other attribute options here
            ],
            [
                'code' => 'custom_display',
                'label' => 'Display',
                'input' => 'select',
                'source' => 'Cp\User\Model\Config\Source\CustomDisplaySource',
                'type' => 'varchar'

                // Add other attribute options here
            ],
            [
                'code' => 'custom_battery',
                'label' => 'Battery',
                'input' => 'select',
                'source' => 'Cp\User\Model\Config\Source\CustomBatterySource',
                'type' => 'varchar'

                // Add other attribute options here
            ],
            [
                'code' => 'custom_processor',
                'label' => 'Processor',
                'input' => 'select',
                'source' => 'Cp\User\Model\Config\Source\CustomProcessorSource',
                'type' => 'varchar'

                // Add other attribute options here
            ],
            [
                'code' => 'custom_os',
                'label' => 'OS',
                'input' => 'text',
               'source' => '',
               'type' => 'text'

                // Add other attribute options here
            ],
            

            // Add more attributes as needed
        ];

        foreach ($attributes as $attribute) {
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                $attribute['code'],
                [
                    'type' => $attribute['type'],
                    'backend' => '',
                    'frontend' => '',
                    'label' => $attribute['label'],
                    'input' => $attribute['input'],
                    'class' => '',
                    'source' => $attribute['source'],
                    'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                    'visible' => true,
                    'required' => false,
                    'user_defined' => false,
                    'default' => '',
                    'searchable' => false,
                    'filterable' => false,
                    'comparable' => false,
                    'visible_on_front' => true,
                    'used_in_product_listing' => true,
                    'unique' => false,
                    'apply_to' => '',
                    'is_used_in_grid' => true,
                    'is_visible_in_grid' => true,

                ]
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
