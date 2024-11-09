<?php

namespace app\infotech\basis;

use app\infotech\basis\exceptions\ActiveRecordDeleteFailedException;
use app\infotech\basis\exceptions\ActiveRecordNotFoundException;
use app\infotech\basis\exceptions\ActiveRecordSaveFailedException;
use yii\db\ActiveRecord;

abstract class BaseRepository
{
    protected string $modelClass;

    public function __construct(string $modelClass)
    {
        $this->modelClass = $modelClass;
    }

    /**
     * @param string $id
     * @return \yii\db\ActiveRecord
     */
    public function get(string $id): ActiveRecord
    {
        $model = $this->find($id);
        if ($model) {
            return $model;
        }

        throw new ActiveRecordNotFoundException($this->modelClass);
    }

    /**
     * @param string $id
     * @return \yii\db\ActiveRecord|null
     */
    public function find(string $id): ?ActiveRecord
    {
        $findFunction = [$this->modelClass, 'findOne'];
        return $findFunction($id);
    }

    /**
     * @param \yii\db\ActiveRecord $model
     * @return \yii\db\ActiveRecord
     * @throws \yii\db\Exception
     */
    public function save(ActiveRecord $model): ActiveRecord
    {
        if ($model->validate() && $model->save()) {
            return $model;
        }

        throw new ActiveRecordSaveFailedException($model);
    }

    /**
     * @param \yii\db\ActiveRecord $model
     * @return void
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function delete(ActiveRecord $model): void
    {
        if ($model->delete()) {
            return;
        }

        throw new ActiveRecordDeleteFailedException($model);
    }
}