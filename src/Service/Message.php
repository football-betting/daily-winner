<?php declare(strict_types=1);

namespace App\Service;

use App\DataTransferObject\DailyWinnerListDataProvider;
use Symfony\Component\Messenger\MessageBusInterface;

final class Message
{
    /**
     * @var \Symfony\Component\Messenger\MessageBusInterface
     */
    private MessageBusInterface $messageBus;

    /**
     * @param \Symfony\Component\Messenger\MessageBusInterface $messageBus
     */
    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @param \App\DataTransferObject\DailyWinnerListDataProvider $dailyWinnerListDataProvider
     */
    public function send(DailyWinnerListDataProvider $dailyWinnerListDataProvider): void
    {
        $this->messageBus->dispatch($dailyWinnerListDataProvider);
    }
}
