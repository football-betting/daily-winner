<?php declare(strict_types=1);

namespace App\Component\DailyWinnerList\Application\Service;

use App\Component\CalculationList\Domain\DataTransferObject\CalculationListDataProvider;
use App\Component\DailyWinner\Domain\DataTransferObject\DailyWinnerDataProvider;
use App\Component\DailyWinnerList\Application\Message\MessageSenderInterface;
use App\Component\DailyWinnerList\Domain\DataTransferObject\DailyWinnerListDataProvider;
use App\DataTransferObject\UserDataProvider;
use Symfony\Component\Messenger\Envelope;

class DailyWinnerListCreator implements DailyWinnerListCreatorInterface
{
    private const EVENT_NAME = 'winner.day';
    /**
     * @var \App\Component\DailyWinnerList\Application\Message\MessageSenderInterface
     */
    private MessageSenderInterface $messageSender;

    /**
     * DailyWinnerListCreator constructor.
     *
     * @param \App\Component\DailyWinnerList\Application\Message\MessageSenderInterface $messageSender
     */
    public function __construct(
        MessageSenderInterface $messageSender
    )
    {
        $this->messageSender = $messageSender;
    }

    /**
     * @param \App\Component\CalculationList\Domain\DataTransferObject\CalculationListDataProvider $calculationListDataProvider
     *
     * @return \Symfony\Component\Messenger\Envelope
     */
    public function __invoke(CalculationListDataProvider $calculationListDataProvider): Envelope
    {
        $dailyWinnerListDataProvider = new DailyWinnerListDataProvider();
        $dailyWinnerListDataProvider->setEvent(self::EVENT_NAME);

        $data = [];
        foreach ($calculationListDataProvider->getData() as $calculationDataProvider) {
            $date = substr(
                $calculationDataProvider->getMatchId(),
                0,
                strpos($calculationDataProvider->getMatchId(),':')
            );

            $data[$date][$calculationDataProvider->getUser()] =
                isset($data[$date][$calculationDataProvider->getUser()])
                ? $data[$date][$calculationDataProvider->getUser()] + $calculationDataProvider->getScore()
                : $calculationDataProvider->getScore();
        }

        foreach ($data as $date => $dateData) {
            $maxScore = max($dateData);

            $dailyWinnerDataProvider = new DailyWinnerDataProvider();
            $dailyWinnerDataProvider->setPoints($maxScore);
            $dailyWinnerDataProvider->setMatchDate($date);

            foreach ($dateData as $user => $points) {
                if ($points === $maxScore) {
                    $dailyWinnerDataProvider->addUser(
                        (new UserDataProvider())->setUsername($user)
                    );
                }
            }

            $dailyWinnerListDataProvider->addDailyWinner($dailyWinnerDataProvider);
        }

        return ($this->messageSender)($dailyWinnerListDataProvider);
    }
}
