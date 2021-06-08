<?php

namespace App\Http\Controllers\Base;


class BaseController extends Controller
{
    protected $module;

    public function __construct()
    {
        if ($this->module) {
            $this->middleware("scope:$this->module.read_able")->only(['index', 'show']);
            $this->middleware("scope:$this->module.write_able")->only(['store']);
            $this->middleware("scope:$this->module.adjust_able")->only(['update']);
            $this->middleware("scope:$this->module.remove_able")->only(['destroy']);
            $this->middleware("scope:$this->module.approve_able")->only(['approve']);
            $this->middleware("scope:$this->module.cancel_able")->only(['cancel']);
            $this->middleware("scope:$this->module.export_able")->only(['export', 'import']);
        }
    }
}
