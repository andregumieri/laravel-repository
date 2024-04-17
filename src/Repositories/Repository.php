<?php
namespace AndreGumieri\LaravelRepository\Repositories;

use Illuminate\Container\Container as App;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class Repository implements Contracts\Repository
{
    public function __construct(private readonly App $app)
    {
    }

    public function make(): Model
    {
        return $this->app->make($this->model());
    }

    public function query(): Builder
    {
        return $this->make()->newQuery();
    }

    public function create(array $args): Model
    {
        return $this->make()->create($args);
    }

    public function delete(mixed $key): bool
    {
        return $this->make()->findOrFail($key)->delete();
    }

    public function update(mixed $key, array $params): Model
    {
        $model = $this->make()->findOrFail($key);
        $model->update($params);
        return $model->refresh();
    }

    public function find(mixed $key): Model
    {
        return $this->make()->find($key);
    }

    public function findOrFail(mixed $key): Model
    {
        return $this->make()->findOrFail($key);
    }

    public function all(): Collection
    {
        return $this->make()->all();
    }

    public function searchBuilder(array $searchParams = []): Builder
    {
        return $this->query()->where($searchParams);
    }

    public function searchPaginated(array $searchParams = [], int $perPage = null): LengthAwarePaginator
    {
        return $this->searchBuilder($searchParams)->paginate($perPage);
    }
}