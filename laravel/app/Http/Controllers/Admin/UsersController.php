<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\RESTfulTrait;
use App\Models\User;

class UsersController extends Controller
{
    use RESTfulTrait {
        RESTfulTrait::__construct as private __rtConstruct;
    }

    public function __construct()
    {
        $this->model = User::class;
        parent::__construct();
        $this->__rtConstruct();
    }

    /**
     * @param \Illuminate\Support\Collection $models
     *
     * @return \App\Exports\BaseExport
     */
    public function exportXls(\Illuminate\Support\Collection $models)
    {
        return new \App\Exports\BaseExport($models, 'users.xls', [
            'id',
            '头像',
            '昵称',
            '手机号',
            '创建时间',
            '修改时间',
            '冻结时间',
        ]);
    }
}
