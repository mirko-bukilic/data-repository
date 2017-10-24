<?php

use G4\DataRepository\DataRepository;

class DataRepositoryTest extends \PHPUnit_Framework_TestCase
{
    const TABLE_NAME = '__TABLE_NAME__';

    private $storageContainerMock;

    public function setUp()
    {
        $this->storageContainerMock = $this->getMockBuilder(\G4\DataRepository\StorageContainer::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testInstance()
    {
        $repository = new DataRepository($this->storageContainerMock);
        $this->assertInstanceOf(DataRepository::class, $repository);
    }

    public function testSetIdentity()
    {
        $identity = $this->getMockBuilder(\G4\DataMapper\Common\IdentityInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $repository = new DataRepository($this->storageContainerMock);
        $this->assertInstanceOf(DataRepository::class, $repository->setIdentity($identity));
    }

    public function testSetRussianDollKey()
    {
        $key = $this->getMockBuilder(\G4\RussianDoll\Key::class)
            ->disableOriginalConstructor()
            ->getMock();

        $repository = new DataRepository($this->storageContainerMock);
        $this->assertInstanceOf(DataRepository::class, $repository->setRussianDollKey($key));
    }

    public function testSetIdentityMapKey()
    {
        $repository = new DataRepository($this->storageContainerMock);
        $this->assertInstanceOf(DataRepository::class, $repository->setIdentityMapKey(self::TABLE_NAME));
    }

    public function testSetDatasetName()
    {
        $repository = new DataRepository($this->storageContainerMock);
        $this->assertInstanceOf(DataRepository::class, $repository->setDatasetName(self::TABLE_NAME));
    }

    public function testSetMapping()
    {
        $repository = new DataRepository($this->storageContainerMock);
        $this->assertInstanceOf(DataRepository::class, $repository->setMapping($this->getMappingMock()));
    }

    public function testQuerry()
    {
        $repository = new DataRepository($this->storageContainerMock);
        $this->setExpectedException('\Exception', 'Not found', 404);
        $repository->query("select * from  " . self::TABLE_NAME);
    }

    public function testCommand()
    {
        $repository = new DataRepository($this->storageContainerMock);
        $this->assertEquals(null, $repository->command("DELETE from  " . self::TABLE_NAME . " WHERE id = 1"));
    }

    public function testInsert()
    {
        $repository = new DataRepository($this->storageContainerMock);
        $repository->setMapping($this->getMappingMock());
        $this->assertEquals(null, $repository->insert());
    }

    public function testUpsert()
    {
        $repository = new DataRepository($this->storageContainerMock);
        $repository->setMapping($this->getMappingMock());
        $this->assertEquals(null, $repository->upsert());
    }

    public function testDelete()
    {
        $repository = new DataRepository($this->storageContainerMock);
        $repository->setIdentity($this->getIdentity());
        $this->assertEquals(null, $repository->delete());
    }

    private function getMappingMock()
    {
        return  $this->getMockBuilder(\G4\DataMapper\Common\MappingInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    private function getIdentity()
    {
        return  $this->getMockBuilder(\G4\DataMapper\Common\IdentityInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
}