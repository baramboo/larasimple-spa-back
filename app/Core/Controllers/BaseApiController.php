<?php

namespace App\Core\Controllers;

use App\Core\Repositories\BaseRepository;
use App\Core\Traits\ApiResponder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class BaseApiController
 * @package App\Http\Controllers
 *
 * @property BaseRepository $repository
 */
class BaseApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ApiResponder;

    protected $repository = null;
    protected $formatter;

    public function __construct()
    {

    }

}
