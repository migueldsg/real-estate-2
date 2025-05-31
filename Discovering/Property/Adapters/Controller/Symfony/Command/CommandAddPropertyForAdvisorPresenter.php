<?php
declare(strict_types=1);

namespace App\RealEstate\Discovering\Property\Adapters\Controller\Symfony\Command;

use App\RealEstate\Discovering\Property\Entities\Property\Exception\BusinessRulesViolationException;
use App\RealEstate\Discovering\Property\UseCases\Property\AddPropertyForAdvisor\AddPropertyForAdvisorPresenter;
use Symfony\Component\Console\Output\OutputInterface;

final class CommandAddPropertyForAdvisorPresenter implements AddPropertyForAdvisorPresenter
{
    /**
     * @var OutputInterface
     */
    private $output;

    public function __construct(
        OutputInterface $output
    ) {
        $this->output = $output;
    }

    public function showBusinessRulesViolations(BusinessRulesViolationException $exception): void
    {
        $this->output->writeln(
            \sprintf(
                'Error : (%s, %s): %s',
                $exception->getPropertyPath(),
                $exception->getBusinessCode(),
                $exception->getTranslateMessage()
            )
        );
    }
}
