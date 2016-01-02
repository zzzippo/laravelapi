<?php

namespace App\Repositories;

trait BaseRepository
{

    /**
     * Destroy a model.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->getById($id)->delete();
    }

    /**
     * Get Model by id.
     *
     * @param int $id
     *
     * @return App\Models\Model
     */
    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function getAll()
    {
        return $this->model->all();
    }
}
