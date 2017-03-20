<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/10
 * Time: 3:51
 */

namespace App\Zwforum\Traits;

use Illuminate\Contracts\Pagination\Paginator;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Illuminate\Http\Response;
use League\Fractal\Resource\Item;

trait ApiHelpers
{
    /**
     * @var Manager $fractal
     */
    protected $fractal;
    /**
     * @var int $statusCode
     */
    protected $statusCode = 200;

//    const CODE_WRONG_ARGS = 'GEN-FUBARGS';
//    const CODE_NOT_FOUND = 'GEN-LIKETHEWIND';
//    const CODE_INTERNAL_ERROR = 'GEN-AAAGGH';
//    const CODE_UNAUTHORIZED = 'GEN-MAYBGTFO';
//    const CODE_FORBIDDEN = 'GEN-GTFO';
//    const CODE_INVALID_MIME_TYPE = 'GEN-UMWUT';

    /**
     * Get the status code.
     *
     * @return int $statusCode
     */
    protected function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Set the status code.
     *
     * @param $statusCode
     * @return $this
     */
    protected function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Respond with a created response and associate a location if provided.
     *
     * @param null|string $location
     * @param null $content
     * @return Response
     */
    protected function created($location = null, $content = null)
    {
        $response = new Response($content);
        $response->setStatusCode(201);
        if (! is_null($location)) {
            $response->header('Location', $location);
        }
        return $response;
    }

    /**
     * Repond a no content response.
     *
     * @return response
     */
    protected function noContent()
    {
        return response()->json(null, 204);
    }


    /**
     * Respond with an accepted response and associate a location and/or content if provided.
     *
     * @param null|string $location
     * @param null $content
     * @return Response
     */
    protected function accepted($location = null, $content = null)
    {
        $response = new Response($content);
        $response->setStatusCode(202);
        if (! is_null($location)) {
            $response->header('Location', $location);
        }
        return $response;
    }

    /**
     * Respond the collection data.
     *
     * @param $collection
     * @param $callback
     * @return mixed
     */
    protected function respondWithCollection($collection, $callback)
    {
        $resource = new Collection($collection, $callback);
        $rootScope = $this->fractal->createData($resource);

        return $this->respondWithArray($rootScope->toArray());
    }

    /**
     * Respond the item data.
     *
     * @param $item
     * @param $callback
     * @return mixed
     */
    protected function respondWithItem($item, $callback)
    {
        $resource = new Item($item, $callback);

        $rootScope = $this->fractal->createData($resource);

        return $this->respondWithArray($rootScope->toArray());
    }

    /**
     * Bind a paginator to a transformer and start building a response.
     *
     * @param \Illuminate\Contracts\Pagination\Paginator $paginator
     * @param object                                     $transformer
     *
     * @return Response
     */
    protected function respondWithPaginator(Paginator $paginator, $transformer)
    {
        $resource = new Collection($paginator->getCollection(), $transformer);
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));
        $rootScope = $this->fractal->createData($resource);

        return $this->respondWithArray($rootScope->toArray());
    }

    /**
     * Respond the data.
     *
     * @param array $array
     * @param array $headers
     * @return mixed
     */
    protected function respondWithArray(array $array, array $headers = [])
    {
        return response()->json($array, $this->statusCode, $headers);
    }

    /**
     * Respond the error message.
     *
     * @param  string $message
     * @param  string $errorCode
     * @return json
     */
    protected function respondWithError($message, $errorCode)
    {
        if ($this->statusCode === 200) {
            trigger_error(
                "You better have a really good reason for erroring on a 200...",
                E_USER_WARNING
            );
        }
        return $this->respondWithArray([
            'error' => [
                'code' => $errorCode,
                'http_code' => $this->statusCode,
                'message' => $message,
            ]
        ]);
    }

    /**
     * Respond the error of 'Wrong Arguments'.
     *
     * @param  string $message
     * @return json
     */
    protected function errorWrongArgs($message = 'Wrong Arguments')
    {
        return $this->setStatusCode(400)
            ->respondWithError($message, 'GEN-FUBARGS');
    }

    /**
     * Respond the error of 'Not Found'.
     *
     * @param  string $message
     * @return json
     */
    protected function errorNotFound($message = 'Not Found')
    {
        return $this->setStatusCode(404)
            ->respondWithError($message, 'GEN-LIKETHEWIND');
    }

    /**
     * Respond the error of 'Forbidden'
     *
     * @param  string $message
     * @return json
     */
    protected function errorForbidden($message = 'Forbidden')
    {
        return $this->setStatusCode(500)
                ->respondWithError($message, 'GEN-GTFO');
    }
}