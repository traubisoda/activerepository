<?php

namespace Tests\Unit;

use App\Repository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Query\Builder as QueryBuilder;
use DB;

class RepositoryTest extends TestCase
{

    public function testConstruct() {
        $modelMock = \Mockery::mock(Model::class);
        $builderMock = \Mockery::mock(Builder::class);
        $modelMock->shouldReceive('newQuery')->once()->andReturn($builderMock);
        $stub = $this->getMockForAbstractClass(Repository::class, [$modelMock]);
    }

    public function testGet() {
        $modelMock = \Mockery::mock(Model::class);
        $builderMock = \Mockery::mock(Builder::class);
        $modelMock->shouldReceive('newQuery')->once()->andReturn($builderMock);
        $builderMock->shouldReceive('get')->once()->andReturn(new Collection());
        $stub = $this->getMockForAbstractClass(Repository::class, [$modelMock]);

        $stub->get();
    }

    public function testWith() {
        $modelMock = \Mockery::mock(Model::class);
        $builderMock = \Mockery::mock(QueryBuilder::class);
        $relations = ['rel1', 'rel2', 'rel3', 'rel4'];
        $modelMock->shouldReceive('newQuery')->once()->andReturn($builderMock);
        $builderMock->shouldReceive('newQuery')->once()->andReturnSelf();
        $builderMock->shouldReceive('with')->times(sizeof($relations))->andReturnSelf();
        $stub = $this->getMockForAbstractClass(Repository::class, [$modelMock]);

        $stub->with($relations);
    }

    public function testSelect() {
        $modelMock = \Mockery::mock(Model::class);
        $builderMock = \Mockery::mock(QueryBuilder::class);
        $modelMock->shouldReceive('newQuery')->once()->andReturn($builderMock);
        $builderMock->shouldReceive('newQuery')->once()->andReturnSelf();
        $builderMock->shouldReceive('select')->once();
        $stub = $this->getMockForAbstractClass(Repository::class, [$modelMock]);

        $stub->select([]);
    }

    public function testWhere() {
        $modelMock = \Mockery::mock(Model::class);
        $builderMock = \Mockery::mock(QueryBuilder::class);
        $modelMock->shouldReceive('newQuery')->once()->andReturn($builderMock);
        $builderMock->shouldReceive('newQuery')->once()->andReturnSelf();
        $builderMock->shouldReceive('where')->once();
        $stub = $this->getMockForAbstractClass(Repository::class, [$modelMock]);

        $stub->where([]);
    }

    public function testOrderBy() {
        $modelMock = \Mockery::mock(Model::class);
        $builderMock = \Mockery::mock(QueryBuilder::class);
        $modelMock->shouldReceive('newQuery')->once()->andReturn($builderMock);
        $builderMock->shouldReceive('newQuery')->once()->andReturnSelf();
        $builderMock->shouldReceive('orderBy')->once();
        $stub = $this->getMockForAbstractClass(Repository::class, [$modelMock]);

        $stub->orderBy([]);
    }

    public function testLimit() {
        $modelMock = \Mockery::mock(Model::class);
        $builderMock = \Mockery::mock(QueryBuilder::class);
        $modelMock->shouldReceive('newQuery')->once()->andReturn($builderMock);
        $builderMock->shouldReceive('newQuery')->once()->andReturnSelf();
        $builderMock->shouldReceive('limit')->once();
        $stub = $this->getMockForAbstractClass(Repository::class, [$modelMock]);

        $stub->limit(rand(1,10));
    }

    public function testOffset() {
        $modelMock = \Mockery::mock(Model::class);
        $builderMock = \Mockery::mock(QueryBuilder::class);
        $modelMock->shouldReceive('newQuery')->once()->andReturn($builderMock);
        $builderMock->shouldReceive('newQuery')->once()->andReturnSelf();
        $builderMock->shouldReceive('offset')->once();
        $stub = $this->getMockForAbstractClass(Repository::class, [$modelMock]);

        $stub->offset(rand(1,10));
    }

    public function testAll() {
        $modelMock = \Mockery::mock(Model::class);
        $builderMock = \Mockery::mock(Builder::class);
        $modelMock->shouldReceive('newQuery')->once()->andReturn($builderMock);
        $builderMock->shouldReceive('get')->once()->andReturn(new Collection());
        $stub = $this->getMockForAbstractClass(Repository::class, [$modelMock]);

        $this->assertTrue(is_array($stub->all()));
    }

    public function testCollect() {
        $modelMock = \Mockery::mock(Model::class);
        $builderMock = \Mockery::mock(Builder::class);
        $modelMock->shouldReceive('newQuery')->once()->andReturn($builderMock);
        $builderMock->shouldReceive('get')->once()->andReturn(new Collection());
        $stub = $this->getMockForAbstractClass(Repository::class, [$modelMock]);

        $this->assertInstanceOf(Collection::class, $stub->collect());
    }

    public function testFindBy() {
        $modelMock = \Mockery::mock(Model::class);
        $builderMock = \Mockery::mock(QueryBuilder::class);
        $key = str_random(6);
        $val = rand(1,10);
        $modelMock->shouldReceive('newQuery')->once()->andReturn($builderMock);
        $builderMock->shouldReceive('get')->once()->andReturnSelf();
        $builderMock->shouldReceive('toArray')->once()->andReturn([]);
        $builderMock->shouldReceive('where')->once()->with($key, $val)->andReturnSelf();
        $stub = $this->getMockForAbstractClass(Repository::class, [$modelMock]);

        $stub->findBy($key, $val);
    }

    public function testFind() {
        $modelMock = \Mockery::mock(Model::class);
        $builderMock = \Mockery::mock(QueryBuilder::class);
        $id = rand(1,10);
        $modelMock->shouldReceive('newQuery')->once()->andReturn($builderMock);
        $builderMock->shouldReceive('findOrFail')->once()->with($id)->andReturn(new Collection());
        $stub = $this->getMockForAbstractClass(Repository::class, [$modelMock]);

        $stub->find($id);
    }

    public function testRestore() {
        $modelMock = \Mockery::mock(Model::class);
        $builderMock = \Mockery::mock(QueryBuilder::class);
        $id = rand(1,10);
        $modelMock->shouldReceive('newQuery')->once()->andReturn($builderMock);
        $builderMock->shouldReceive('restore')->once()->with($id);
        $stub = $this->getMockForAbstractClass(Repository::class, [$modelMock]);

        $stub->restore($id);
    }

    public function testUpdate() {
        $modelMock = \Mockery::mock(Model::class);
        $builderMock = \Mockery::mock(QueryBuilder::class);
        $id = rand(1,10);
        $data = ['col' => 'val'];
        $modelMock->shouldReceive('newQuery')->once()->andReturn($builderMock);
        $builderMock->shouldReceive('where')->once()->with('id', $id)->andReturnSelf();
        $builderMock->shouldReceive('update')->once()->with($data)->andReturn(true);
        $stub = $this->getMockForAbstractClass(Repository::class, [$modelMock]);

        $stub->update($id, $data);
    }

    public function testCreate() {
        $modelMock = \Mockery::mock(Model::class);
        $builderMock = \Mockery::mock(Builder::class);
        $data = ['key' => 'value'];
        $modelMock->shouldReceive('newQuery')->once()->andReturn($builderMock);
        $builderMock->shouldReceive('create')->once()->with($data)->andReturn(new Collection());
        $stub = $this->getMockForAbstractClass(Repository::class, [$modelMock]);

        $this->assertTrue(is_array($stub->create($data)));
    }

    public function testDelete() {
        $modelMock = \Mockery::mock(Model::class);
        $builderMock = \Mockery::mock(QueryBuilder::class);
        $id = rand(1,10);
        $modelMock->shouldReceive('newQuery')->once()->andReturn($builderMock);
        $builderMock->shouldReceive('where')->once()->with('id', $id)->andReturnSelf();
        $builderMock->shouldReceive('delete')->once()->andReturn(true);
        $stub = $this->getMockForAbstractClass(Repository::class, [$modelMock]);

        $stub->delete($id);
    }

    public function testWithTrashed() {
        $modelMock = \Mockery::mock(Model::class);
        $builderMock = \Mockery::mock(QueryBuilder::class);
        $modelMock->shouldReceive('newQuery')->once()->andReturn($builderMock);
        $builderMock->shouldReceive('withTrashed')->once();
        $stub = $this->getMockForAbstractClass(Repository::class, [$modelMock]);

        $stub->withTrashed();
    }
}
