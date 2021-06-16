<?php declare(strict_types=1);

namespace App\Component\CalculationList\Application\Message;

use App\Component\CalculationList\Domain\DataTransferObject\CalculationListDataProvider;
use App\Component\DailyWinnerList\Application\Service\DailyWinnerListCreatorInterface;

class CalculationListMessageHandler
{
    /**
     * @var \App\Component\DailyWinnerList\Application\Service\DailyWinnerListCreatorInterface
     */
    private DailyWinnerListCreatorInterface $dailyWinnerListCreator;

    /**
     * CalculationListMessageHandler constructor.
     *
     * @param \App\Component\DailyWinnerList\Application\Service\DailyWinnerListCreatorInterface $dailyWinnerListCreator
     */
    public function __construct(
        DailyWinnerListCreatorInterface $dailyWinnerListCreator
    )
    {
        $this->dailyWinnerListCreator = $dailyWinnerListCreator;
    }

    /**
     * @param \App\Component\CalculationList\Domain\DataTransferObject\CalculationListDataProvider $calculationListDataProvider
     */
    public function __invoke(CalculationListDataProvider $calculationListDataProvider)
    {
        ($this->dailyWinnerListCreator)($calculationListDataProvider);
    }
}
