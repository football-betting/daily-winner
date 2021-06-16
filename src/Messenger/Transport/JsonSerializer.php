<?php declare(strict_types=1);

namespace App\Messenger\Transport;

use App\Component\CalculationList\Domain\DataTransferObject\CalculationListDataProvider;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Stamp\SentStamp;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;
use Xervice\DataProvider\Business\Model\DataProvider\DataProviderInterface;

class JsonSerializer implements SerializerInterface
{
    public function decode(array $encodedEnvelope): Envelope
    {
        if (!isset($encodedEnvelope['body'])) {
            throw new \LogicException('incorrect message');
        }

        $data = json_decode($encodedEnvelope['body'], true);

        if (!isset($data['event'])) {
            throw new \LogicException('incorrect message: event');
        }

        if ($data['event'] === "calculation.to.win.day") {
            // schema validation
            $calculationListDataProvider = new CalculationListDataProvider();
            $calculationListDataProvider->fromArray($data);

            return new Envelope($calculationListDataProvider);
        }

        throw new \RuntimeException('Incorrect event: ' . $data['event']);
    }

    public function encode(Envelope $envelope): array
    {
        /** @var DataProviderInterface $message */
        $message = $envelope->getMessage();
        if (!$message instanceof DataProviderInterface) {
            throw new \RuntimeException('Message should be DataProviderInterface');
        }

        if (method_exists($message, 'getData')) {
            $eventMessage = [
                'data' => $message->toArray()['data'],
            ];
        } else {
            $eventMessage = [
                'data' => $message->toArray(),
            ];
        }

        $stamps = $envelope->all();
        foreach ($stamps as $stampList) {
            foreach ($stampList as $stamp) {
                if ($stamp instanceof SentStamp) {
                    $alias = $stamp->getSenderAlias();
                    if ($alias !== null) {
                        $eventMessage['event'] = $alias;
                    }
                }
            }
        }

        return [
            'body' => json_encode($eventMessage),
        ];
    }

}

