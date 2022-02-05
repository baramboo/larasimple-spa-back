<?php

namespace App\Core\Controllers;

use App\Core\Repositories\BaseRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class BaseHttpController
 * @package App\Http\Controllers
 *
 * @property BaseRepository $repository
 */
class BaseHttpController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $repository = null;
    protected $formatter;

    public function __construct()
    {

    }

}
