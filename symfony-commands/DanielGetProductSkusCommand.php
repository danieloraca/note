<?php
declare(strict_types=1);

namespace Gant\Bundle\CbrBundle\Console;

use Gant\Bundle\FrontendApiBundle\Service\ProductQueryService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DanielGetProductSkusCommand extends Command
{
    protected static $defaultName = 'dan:get_product_skus';

    /** @var ProductQueryService */
    private $productQueryService;

    public function __construct(ProductQueryService $productQueryService)
    {
        parent::__construct();
        $this->productQueryService = $productQueryService;
    }

    protected function configure()
    {
        $this
            ->setDescription('get product skus from product reference')
            ->addArgument('reference', InputArgument::REQUIRED, 'Product reference.')
            ->addArgument('locale', InputArgument::REQUIRED, 'Product locale.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $reference = $input->getArgument('reference');
        $locale = $input->getArgument('locale');

        if (!$reference || !$locale || !is_string($reference) || !is_string($locale)) {
            $output->writeln('Missing parameters!');
            return null;
        }
        $output->writeln(sprintf('SKUs for product reference %s and locale %s', $reference, $locale));

        $product = $this->productQueryService->findArticleByReference($reference, $locale);
        if ($product) {
            foreach ($product->getSkus() as $sku) {
                $output->writeln($sku->getEan13());
            }
        }

        $output->writeln('<info>Done!</info>');
    }
}
