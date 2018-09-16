<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;

trait RESTfulTrait
{
    /**
     * @var string|\Eloquent
     */
    protected $model;

    public function __construct()
    {
        /*
         * @var \Eloquent
         */
        $this->model = new $this->model();
        $this->model = $this->model
            ->when(method_exists($this->model, 'scopeFilter'), function (Builder $q) {
                return $q->filter(request()->all());
            });

        if (method_exists($this, 'boot')) {
            $this->boot();
        }
    }

    public function index()
    {
        $models = $this->model;

        if ('xls' == request('export') && method_exists($this, 'exportXls')) {
            return $this->exportXls($models->get());
        }

        if (request('per_page') || request('page')) {
            if (request('simple_page')) {
                $models = $models
                    ->simplePaginate(request('per_page'))
                    ->appends(request()->all());
            } else {
                $models = $models
                    ->paginate(request('per_page'))
                    ->appends(request()->all());
            }
        } else {
            $take = request('take');
            $models = $models
                ->when(is_null($take), function ($q) use ($take) {
                    return $q->take(100);
                })
                ->when(!is_null($take) && is_numeric($take) && $take, function ($q) use ($take) {
                    return $q->take($take);
                })
                ->get();
        }

        return \Response::success($models);
    }

    /**
     * @param $id
     *
     * @return mixed
     *
     * @throws \Throwable
     */
    public function show($id)
    {
        $models = $models = $this->model
            ->findOrFail($id);

        return \Response::success($models);
    }

    public function destroy($id)
    {
        /**
         * @var \Illuminate\Support\Collection
         */
        $models = $models = $this->model
            ->findOrFail(explode(',', $id));

        foreach ($models as $key => $model) {
            if ('force' == request('ac')) {
                $model->forceDelete();
            } elseif (method_exists($model, 'trashed') && $model->trashed()) {
                $model->restore();
            } else {
                $model->delete();
            }
        }

        return \Response::success();
    }
}
