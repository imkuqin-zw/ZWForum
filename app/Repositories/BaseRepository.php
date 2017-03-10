<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/10
 * Time: 14:33
 */

namespace App\Repositories;


abstract class BaseRepository
{
    use RepositoryHelpers;

    /**
     * @var model
     */
    protected $model;

}