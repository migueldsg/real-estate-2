<?php
declare(strict_types=1);

namespace App\RealEstate\Discovering\Property\Adapters\Controller\Symfony\Command;

use App\RealEstate\Discovering\Property\Entities\Property\PropertyRepository;
use App\RealEstate\Discovering\Property\UseCases\Property\AddPropertyForAdvisor\AddPropertyForAdvisor;
use App\RealEstate\Discovering\Property\UseCases\Property\AddPropertyForAdvisor\AddPropertyForAdvisorRequest;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class RealEstateAddPropertyCommand extends Command
{
    protected static $defaultName = 'real-estate:add-property';

    /**
     * @var AddPropertyForAdvisor
     */
    private $useCase;

    /**
     * @var PropertyRepository
     */
    private $propertyRepository;

    public function __construct(
        AddPropertyForAdvisor $useCase,
        PropertyRepository $propertyRepository
    ) {
        parent::__construct();
        $this->useCase = $useCase;
        $this->propertyRepository = $propertyRepository;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $deskill = $this->propertyRepository->get(
            (string)$input->getArgument('property-id'),
            (int)$input->getArgument('advisor-id')
        );

        $presenter = new CommandAddPropertyForAdvisorPresenter($output);
        $this->useCase->execute(
            new AddPropertyForAdvisorRequest(
                $deskill->getUid()->toString(),
                (int)$input->getArgument('advisor-id')
            ),
            $presenter
        );

        return Command::SUCCESS;
    }
}
