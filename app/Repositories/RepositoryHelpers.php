<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/10
 * Time: 14:15
 */

namespace App\Repositories;


trait RepositoryHelpers
{

    /**
     * Get number of records
     *
     * @return array
     */
    public function getNumber()
    {
        return $this->model->count();
    }

    /**
     * Update columns in the record by id.
     *
     * @param $id
     * @param $input
     * @return App\Model|User
     */
    public function updateColumn($id, $input)
    {
        $this->model = $this->getById($id);

        foreach ($input as $key => $value) {
            $this->model->{$key} = $value;
        }

        return $this->model->save();
    }

    /**
     * Destroy a model.
     *
     * @param  $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->getById($id)->delete();
    }

    /**
     * Get model by id.
     *
     * @param $id
     * @param array|null $filter
     * @return App\Model
     */
    public function getById($id,$filter=null)
    {
        if($filter)
            $result = $this->model->select($filter)->findOrFail($id);
        else
            $result = $this->model->findOrFail($id);
        return $result;
    }

    /**
     * Get all the records
     *
     * @param array|null $filter
     * @return array User
     */
    public function all($filter=null)
    {
        if($filter)
            $result = $this->model->filter($filter)->get();
        else
            $result = $this->model->get();
        return $result;
    }

    /**
     * Get page of the records
     *
     * @param int $number
     * @param array|null $filter
     * @param string $sort
     * @param string $sortColumn
     * @return Paginate
     */
    public function page($number = 10,$filter=null, $sort = 'desc', $sortColumn = 'created_at')
    {
        if($filter)
            $result = $this->model->orderBy($sortColumn, $sort)->filter($filter)->paginate($number);
        else
            $result = $this->model->orderBy($sortColumn, $sort)->paginate($number);
        return $result;
    }

    /**
     * Store a new record.
     *
     * @param  $input
     * @return User
     */
    public function store($input)
    {
        return $this->save($this->model, $input);
    }

    /**
     * Update a record by id.
     *
     * @param  $id
     * @param  $input
     * @return User
     */
    public function update($id, $input)
    {
        $this->model = $this->getById($id);

        return $this->save($this->model, $input);
    }

    /**
     * create a record with the input's data.
     *
     * @param  $input
     * @return User
     */
    public function create($input)
    {
        return $this->model->create($input);//$this->save($this->model, $input);
    }

    /**
     * Save the input's data.
     *
     * @param  $model
     * @param  $input
     * @return User
     */
    public function save($model, $input)
    {
        $model->fill($input);

        $model->save();

        return $model;
    }
}