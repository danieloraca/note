<?php
declare(strict_types=1);

namespace Gant\Bundle\CbrBundle\Console;

use Phoenix\Bundle\Courier\CourierBundle\Entity\Repository\ShippingOptionRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ShowShippingOptionsCommand extends Command
{
    protected static $defaultName = 'gib:show_shipping_options';

    /** @var ShippingOptionRepository */
    private $shippingOptionRepository;

    public function __construct(ShippingOptionRepository $shippingOptionRepository)
    {
        parent::__construct();
        $this->shippingOptionRepository = $shippingOptionRepository;
    }

    protected function configure()
    {
        $this
            ->setName('gib:show_shipping_options')
            ->setDescription('shit');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $shippingOptions = $this->shippingOptionRepository->getEnabledManageableShippingOptions();

        $x = array_map(function ($shippingOption) {
            $serializedOption = [
                //"id" => $shippingOption->getId(),
                "name" => $shippingOption->getName(),
                "helpText" => $shippingOption->getHelpText(),
                //"reference" => $shippingOption->getReference(),
            ];

            if (method_exists($shippingOption, 'getServiceCode')) {
                $serializedOption['serviceCode'] = $shippingOption->getServiceCode();
            }

            return $serializedOption;
        }, $shippingOptions);

        var_dump(($x));
    }
}
