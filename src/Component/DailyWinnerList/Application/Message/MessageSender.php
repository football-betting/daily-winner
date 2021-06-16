<?php declare(strict_types=1);

namespace App\Component\DailyWinnerList\Application\Message;

use App\Component\DailyWinnerList\Domain\DataTransferObject\DailyWinnerListDataProvider;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;

class MessageSender implements MessageSenderInterface
{
    /**
     * @var \Symfony\Component\Messenger\MessageBusInterface
     */
    private MessageBusInterface $messageBus;

    /**
     * MessageSender constructor.
     *
     * @param \Symfony\Component\Messenger\MessageBusInterface $messageBus
     */
    public function __construct(
        MessageBusInterface $messageBus
    )
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @param \App\Component\DailyWinnerList\Domain\DataTransferObject\DailyWinnerListDataProvider $dailyWinnerListDataProvider
     *
     * @return \Symfony\Component\Messenger\Envelope
     */
    public function __invoke(DailyWinnerListDataProvider $dailyWinnerListDataProvider): Envelope
    {
        return $this->messageBus->dispatch($dailyWinnerListDataProvider);
    }
}
