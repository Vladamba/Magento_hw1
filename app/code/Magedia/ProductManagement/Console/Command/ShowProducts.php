<?php

declare(strict_types=1);

namespace Magedia\ProductManagement\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Catalog\Model\ResourceModel\Product\Collection as ProductCollection;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class ShowProducts extends Command
{
    /**
     * @var CollectionFactory
     */
    private CollectionFactory $productCollectionFactory;
    private const INPUT_KEY_NUMBER = 'number';

    /**
     * @param string|null $name
     */
    public function __construct(
        CollectionFactory $productCollectionFactory,
        string            $name = null)
    {
        $this->productCollectionFactory = $productCollectionFactory;
        parent::__construct($name);
    }

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName("magedia:show-products");
        $this->setDescription("Command for showing all products");
        $this->addArgument(self::INPUT_KEY_NUMBER);
        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        /**
         * @var ProductCollection $productCollection
         */
        $productCollection = $this->productCollectionFactory->create();
        $productCollection->setStore(0)
            ->addAttributeToSelect("name")
            ->addAttributeToSelect("price")
            ->setPageSize($input->getArgument(self::INPUT_KEY_NUMBER));

        foreach ($productCollection as $product) {
            $output->writeln("Name: " . $product->getName());
            $output->writeln("Price: " . $product->getPrice());
            $output->writeln("_____");
        }
        //parent::execute($input, $output);
        return 0;
    }
}
