<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

   /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Greenery",
     *      description="Greenery",
     *      @OA\Contact(
     *          email="natghi2010@gmail.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description=""
     * )

     *
     * @OA\Tag(
     *     name="Greenery",
     *     description="API Endpoints of Greenery App"
     * )
     */

class Controller extends BaseController
{


    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
