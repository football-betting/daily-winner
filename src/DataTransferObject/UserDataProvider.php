<?php
declare(strict_types=1);
namespace App\DataTransferObject;

/**
 * Auto generated data provider
 */
final class UserDataProvider extends \Xervice\DataProvider\Business\Model\DataProvider\AbstractDataProvider implements \Xervice\DataProvider\Business\Model\DataProvider\DataProviderInterface
{
    /** @var string */
    protected $username;


    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }


    /**
     * @param string $username
     * @return UserDataProvider
     */
    public function setUsername(string $username)
    {
        $this->username = $username;

        return $this;
    }


    /**
     * @return UserDataProvider
     */
    public function unsetUsername()
    {
        $this->username = null;

        return $this;
    }


    /**
     * @return bool
     */
    public function hasUsername()
    {
        return ($this->username !== null && $this->username !== []);
    }


    /**
     * @return array
     */
    protected function getElements(): array
    {
        return array (
          'username' =>
          array (
            'name' => 'username',
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
