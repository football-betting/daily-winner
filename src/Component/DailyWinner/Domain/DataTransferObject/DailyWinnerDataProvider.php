<?php
declare(strict_types=1);
namespace App\Component\DailyWinner\Domain\DataTransferObject;

use App\DataTransferObject\UserDataProvider;


/**
 * Auto generated data provider
 */
final class DailyWinnerDataProvider extends \Xervice\DataProvider\Business\Model\DataProvider\AbstractDataProvider implements \Xervice\DataProvider\Business\Model\DataProvider\DataProviderInterface
{
    /** @var \App\DataTransferObject\UserDataProvider[] */
    protected $users = [];

    /** @var int */
    protected $points;

    /** @var string */
    protected $matchDate;


    /**
     * @return \App\DataTransferObject\UserDataProvider[]
     */
    public function getUsers(): array
    {
        return $this->users;
    }


    /**
     * @param \App\DataTransferObject\UserDataProvider[] $users
     * @return DailyWinnerDataProvider
     */
    public function setUsers(array $users)
    {
        $this->users = $users;

        return $this;
    }


    /**
     * @return DailyWinnerDataProvider
     */
    public function unsetUsers()
    {
        $this->users = null;

        return $this;
    }


    /**
     * @return bool
     */
    public function hasUsers()
    {
        return ($this->users !== null && $this->users !== []);
    }


    /**
     * @param \App\DataTransferObject\UserDataProvider $User
     * @return DailyWinnerDataProvider
     */
    public function addUser(UserDataProvider $User)
    {
        $this->users[] = $User; return $this;
    }


    /**
     * @return int
     */
    public function getPoints(): int
    {
        return $this->points;
    }


    /**
     * @param int $points
     * @return DailyWinnerDataProvider
     */
    public function setPoints(int $points)
    {
        $this->points = $points;

        return $this;
    }


    /**
     * @return DailyWinnerDataProvider
     */
    public function unsetPoints()
    {
        $this->points = null;

        return $this;
    }


    /**
     * @return bool
     */
    public function hasPoints()
    {
        return ($this->points !== null && $this->points !== []);
    }


    /**
     * @return string
     */
    public function getMatchDate(): string
    {
        return $this->matchDate;
    }


    /**
     * @param string $matchDate
     * @return DailyWinnerDataProvider
     */
    public function setMatchDate(string $matchDate)
    {
        $this->matchDate = $matchDate;

        return $this;
    }


    /**
     * @return DailyWinnerDataProvider
     */
    public function unsetMatchDate()
    {
        $this->matchDate = null;

        return $this;
    }


    /**
     * @return bool
     */
    public function hasMatchDate()
    {
        return ($this->matchDate !== null && $this->matchDate !== []);
    }


    /**
     * @return array
     */
    protected function getElements(): array
    {
        return array (
          'users' =>
          array (
            'name' => 'users',
            'allownull' => false,
            'default' => '',
            'type' => '\\App\\DataTransferObject\\UserDataProvider[]',
            'is_collection' => true,
            'is_dataprovider' => false,
            'isCamelCase' => false,
            'singleton' => 'User',
            'singleton_type' => '\\App\\DataTransferObject\\UserDataProvider',
          ),
          'points' =>
          array (
            'name' => 'points',
            'allownull' => false,
            'default' => '',
            'type' => 'int',
            'is_collection' => false,
            'is_dataprovider' => false,
            'isCamelCase' => false,
          ),
          'matchDate' =>
          array (
            'name' => 'matchDate',
            'allownull' => false,
            'default' => '',
            'type' => 'string',
            'is_collection' => false,
            'is_dataprovider' => false,
            'isCamelCase' => false,
          ),
        );
    }
}
