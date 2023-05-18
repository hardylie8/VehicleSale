<?php

namespace App\Repositories;

abstract class BaseRepository
{

    /**
     * The Query Builder instance for the current resource list generator.
     *
     * @var Model
     */
    protected $model;

    /**
     * Get all models.
     *
     * @return Model $model
     */
    public function getAll()
    {
        return $this->model->get()->toQuery();
    }

    /**
     * Get model by id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        $relationship = [];
        if (method_exists($this->model, 'getRelationship')) {
            $relationship = $this->model->getRelationship();
        }

        return $this->model->with($relationship)->findOrFail($id);
    }

    /**
     * Save Model
     *
     * @param $data
     * @return Model
     */
    public function save($data)
    {
        $model = $this->model;
        $model->fill($data->only($model->offsetGet('fillable')))
            ->save();
        return $model->fresh();
    }

    /**
     * Update Model
     *
     * @param $data
     * @return Model
     */
    public function update($data, $id)
    {
        $model = $this->getById($id);
        $model->fill($data->only($model->offsetGet('fillable')));
        if ($model->isDirty()) {
            $model->save();
        }
        return $model;
    }

    /**
     * Update Model
     *
     * @param $data
     * @return Model
     */
    public function delete($id)
    {
        $model = $this->getById($id);
        $model->delete();
    }
}
