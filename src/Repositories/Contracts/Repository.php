<?php

namespace AndreGumieri\LaravelRepository\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface Repository
{
    /**
     * Returns an instance of the Model class.
     *
     * @return string The model class
     */
    public function model(): string;

    /**
     * Returns an instance of the Model class.
     *
     * @return Model An instance of the Model class.
     */
    public function make(): Model;

    /**
     * Returns an Eloquent Builder object
     *
     * @return Builder
     */
    public function query(): Builder;


    /**
     * Adds to the database
     *
     * @param array $args The data to be used for creating the model
     * @return Model The newly created model instance
     */
    public function create(array $args): Model;


    /**
     * Deletes a record from the database based on the given key.
     *
     * @param mixed $key The key or identifier of the record to be deleted.
     * @return bool Returns true if the record is successfully deleted, false otherwise.
     */
    public function delete(mixed $key): bool;


    /**
     * Updates a record in the database based on the given key and params
     *
     * @param mixed $key The key used to find the record to be updated
     * @param array $params The array of parameters with the new values to update the record
     * @return Model The updated Model object
     */
    public function update(mixed $key, array $params): Model;

    /**
     * Find a model by its primary key.
     *
     * @param mixed $key The primary key value to search for.
     *
     * @return Model The found model, or null if no model is found.
     */
    public function find(mixed $key): Model;

    /**
     * Find a record by its primary key or throw an exception.
     *
     * @param mixed $key The primary key value
     *
     * @return Model The model instance
     * @throws ModelNotFoundException If no record is found with the given primary key
     */
    public function findOrFail(mixed $key): Model;

    /**
     * Returns all the elements in the database
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Returns an Eloquent Builder object based on the given search parameters
     *
     * @param array $searchParams An array of search parameters
     * @return Builder An instance of the Eloquent Builder class
     */
    public function searchBuilder(array $searchParams = []): Builder;

    /**
     * Performs a search operation and returns the paginated results.
     *
     * @param array $searchParams An array of search parameters (optional).
     * @param int|null $perPage The number of items to be shown per page (optional).
     *
     * @return LengthAwarePaginator
     */
    public function searchPaginated(array $searchParams = [], int $perPage = null): LengthAwarePaginator;
}