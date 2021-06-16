<?php
declare(strict_types=1);
namespace App\Component\DailyWinnerList\Domain\DataTransferObject;

/**
 * Auto generated data provider
 */
final class DailyWinnerListDataProvider extends \Xervice\DataProvider\Business\Model\DataProvider\AbstractDataProvider implements \Xervice\DataProvider\Business\Model\DataProvider\DataProviderInterface
{
    /** @var string */
    protected $event;

    /** @var \App\Component\DailyWinner\Domain\DataTransferObject\DailyWinnerDataProvider[] */
    protected $data = [];


    /**
     * @return string
     */
    public function getEvent(): string
    {
        return $this->event;
    }


    /**
     * @param string $event
     * @return DailyWinnerListDataProvider
     */
    public function setEvent(string $event)
    {
        $this->event = $event;

        return $this;
    }


    /**
     * @return DailyWinnerListDataProvider
     */
    public function unsetEvent()
    {
        $this->event = null;

        return $this;
    }


    /**
     * @return bool
     */
    public function hasEvent()
    {
        return ($this->event !== null && $this->event !== []);
    }


    /**
     * @return \App\Component\DailyWinner\Domain\DataTransferObject\DailyWinnerDataProvider[]
     */
    public function getData(): array
    {
        return $this->data;
    }


    /**
     * @param \App\Component\DailyWinner\Domain\DataTransferObject\DailyWinnerDataProvider[] $data
     * @return DailyWinnerListDataProvider
     */
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }


    /**
     * @return DailyWinnerListDataProvider
     */
    public function unsetData()
    {
        $this->data = null;

        return $this;
    }


    /**
     * @return bool
     */
    public function hasData()
    {
        return ($this->data !== null && $this->data !== []);
    }


    /**
     * @param \App\Component\DailyWinner\Domain\DataTransferObject\DailyWinnerDataProvider $DailyWinner
     * @return DailyWinnerListDataProvider
     */
    public function addDailyWinner(\App\Component\DailyWinner\Domain\DataTransferObject\DailyWinnerDataProvider $DailyWinner)
    {
        $this->data[] = $DailyWinner; return $this;
    }


    /**
     * @return array
     */
    protected function getElements(): array
    {
        return array (
          'event' =>
          array (
            'name' => 'event',
            'allownull' => false,
            'default' => '',
            'type' => 'string',
            'is_collection' => false,
            'is_dataprovider' => false,
            'isCamelCase' => false,
          ),
          'data' =>
          array (
            'name' => 'data',
            'allownull' => false,
            'default' => '',
            'type' => '\\App\\Component\\DailyWinner\\Domain\\DataTransferObject\\DailyWinnerDataProvider[]',
            'is_collection' => true,
            'is_dataprovider' => false,
            'isCamelCase' => false,
            'singleton' => 'DailyWinner',
            'singleton_type' => '\\App\\Component\\DailyWinner\\Domain\\DataTransferObject\\DailyWinnerDataProvider',
          ),
        );
    }
}
