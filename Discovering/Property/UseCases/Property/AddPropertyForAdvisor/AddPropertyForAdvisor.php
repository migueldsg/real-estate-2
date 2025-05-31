<?php

declare(strict_types=1);

namespace App\RealEstate\Discovering\Property\UseCases\Property\AddPropertyForAdvisor;

use App\RealEstate\Discovering\Property\Entities\Property\AdvisorId;
use App\RealEstate\Discovering\Property\Entities\Property\Country;
use App\RealEstate\Discovering\Property\Entities\Property\Exception\BusinessRulesViolationException;
use App\RealEstate\Discovering\Property\Entities\Property\Property;
use App\RealEstate\Discovering\Property\Entities\Property\PropertyId;
use App\RealEstate\Discovering\Property\Entities\Property\PropertyRepository;
use App\RealEstate\Discovering\Property\UseCases\Gateway\Property\NewPropertyNotifer;

class AddPropertyForAdvisor
{
    /**
     * @var PropertyRepository
     */
    private $propertyRepository;

    /**
     * @var NewPropertyNotifer
     */
    private $newPropertyNotifer;

    public function __construct(PropertyRepository $propertyRepository, NewPropertyNotifer $newPropertyNotifer)
    {
        $this->propertyRepository = $propertyRepository;
        $this->newPropertyNotifer = $newPropertyNotifer;
    }

    public function execute(AddPropertyForAdvisorRequest $request, AddPropertyForAdvisorPresenter $presenter): void
    {
        try {
            $country = Country::fromString('france');
            $propertyId = PropertyId::fromString($request->getUid());
            $advisorId = AdvisorId::fromInt($request->getAdvisorId());

            $object = Property::new(
                $country,
                $propertyId,
                $advisorId,
                $request->getUrl(),
                $request->getPrice(),
                new \DateTime()
            );

            $this->propertyRepository->add($object);

            $this->newPropertyNotifer->synchronize(
                $propertyId,
                $advisorId,
                $country
            );

            $presenter->show(
                $propertyId,
                $advisorId,
                $country,
                (int) ($object->getPrice() * 100)
            );
        } catch (BusinessRulesViolationException $exception) {
            $presenter->showBusinessRulesViolations($exception);
        }
    }
}
