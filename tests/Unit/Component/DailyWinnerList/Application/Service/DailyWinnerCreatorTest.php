<?php declare(strict_types=1);

namespace Unit\Component\DailyWinnerList\Application\Service;

use App\Component\Calculation\Domain\DataTransferObject\CalculationDataProvider;
use App\Component\CalculationList\Domain\DataTransferObject\CalculationListDataProvider;
use App\Component\DailyWinner\Domain\DataTransferObject\DailyWinnerDataProvider;
use App\Component\DailyWinnerList\Application\Message\MessageSender;
use App\Component\DailyWinnerList\Application\Service\DailyWinnerListCreator;
use App\Component\DailyWinnerList\Domain\DataTransferObject\DailyWinnerListDataProvider;
use App\DataTransferObject\UserDataProvider;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;

class DailyWinnerCreatorTest extends WebTestCase
{
    /**
     * @dataProvider provideSuccessData
     *
     * @param \App\Component\CalculationList\Domain\DataTransferObject\CalculationListDataProvider $calculationListDataProvider
     * @param \App\Component\DailyWinnerList\Domain\DataTransferObject\DailyWinnerListDataProvider $expectedDailyWinnerListDataProvider
     */
    public function testOnSuccess(
        CalculationListDataProvider $calculationListDataProvider,
        DailyWinnerListDataProvider $expectedDailyWinnerListDataProvider
    )
    {
        $messageBusStub = new class implements MessageBusInterface {

            public function dispatch($message, array $stamps = []): Envelope
            {
                return Envelope::wrap($message, $stamps);;
            }
        };

        $dailyWinnerListCreator = new DailyWinnerListCreator(new MessageSender($messageBusStub));
        $envelope = $dailyWinnerListCreator($calculationListDataProvider);
        /** @var DailyWinnerListDataProvider $createdDailyWinnerListDataProvider */
        $createdDailyWinnerListDataProvider = $envelope->getMessage();

        self::assertSame($expectedDailyWinnerListDataProvider->getEvent(), $createdDailyWinnerListDataProvider->getEvent());

        foreach ($createdDailyWinnerListDataProvider->getData() as $key => $dailyWinnerDataProvider) {
            self::assertSame($expectedDailyWinnerListDataProvider->getData()[$key]->getMatchDate(), $dailyWinnerDataProvider->getMatchDate());
            self::assertSame($expectedDailyWinnerListDataProvider->getData()[$key]->getPoints(), $dailyWinnerDataProvider->getPoints());

            foreach ($dailyWinnerDataProvider->getUsers() as $usersKey => $userDataProvider) {
                self::assertSame($expectedDailyWinnerListDataProvider->getData()[$key]->getUsers()[$usersKey]->getUsername(), $userDataProvider->getUsername());
            }
        }
    }

    /**
     * @return \App\Component\CalculationList\Domain\DataTransferObject\CalculationListDataProvider[][]
     */
    public function provideSuccessData():array
    {
        $calculationListDataProvider = new CalculationListDataProvider();
        $calculationListDataProvider
            ->setEvent('calculation')
            ->setData(
                [
                    (new CalculationDataProvider())
                        ->setMatchId('2020-06-16:2300:FR-DE')
                        ->setTipTeam1(2)
                        ->setTipTeam2(4)
                        ->setScore(3)
                        ->setUser('Jegocz'),
                    (new CalculationDataProvider())
                        ->setMatchId('2020-06-17:2100:IT-SP')
                        ->setTipTeam1(1)
                        ->setTipTeam2(1)
                        ->setScore(1)
                        ->setUser('Jegocz'),
                    (new CalculationDataProvider())
                        ->setMatchId('2020-06-16:2000:FR-DE')
                        ->setTipTeam1(2)
                        ->setTipTeam2(4)
                        ->setScore(2)
                        ->setUser('Jegocz'),
                    (new CalculationDataProvider())
                        ->setMatchId('2020-06-16:2000:FR-DE')
                        ->setTipTeam1(2)
                        ->setTipTeam2(4)
                        ->setScore(2)
                        ->setUser('FreshPrince'),
                    (new CalculationDataProvider())
                        ->setMatchId('2020-06-16:2000:FR-DE')
                        ->setTipTeam1(2)
                        ->setTipTeam2(4)
                        ->setScore(3)
                        ->setUser('Ninja'),
                    (new CalculationDataProvider())
                        ->setMatchId('2020-06-16:2000:FR-DE')
                        ->setTipTeam1(2)
                        ->setTipTeam2(4)
                        ->setScore(2)
                        ->setUser('Ninja'),
                ]
            );

        $expectedDailyWinnerListDataProvider = new DailyWinnerListDataProvider();
        $expectedDailyWinnerListDataProvider
            ->setEvent('winner.day')
            ->setData([
                (new DailyWinnerDataProvider())
                ->setMatchDate('2020-06-16')
                ->setPoints(5)
                ->setUsers([
                    (new UserDataProvider())
                        ->setUsername('Jegocz'),
                    (new UserDataProvider())
                        ->setUsername('Ninja')
                ]),
                (new DailyWinnerDataProvider())
                    ->setMatchDate('2020-06-17')
                    ->setPoints(1)
                    ->setUsers([
                        (new UserDataProvider())
                            ->setUsername('Jegocz'),
                    ]),
            ]);

        return [
            [
                'calculationListDataProvider' => $calculationListDataProvider,
                'expectedDailyWinnerListDataProvider' => $expectedDailyWinnerListDataProvider,
            ]
        ];
    }
}
