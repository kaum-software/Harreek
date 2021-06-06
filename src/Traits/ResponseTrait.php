<?php
namespace Kaum\Harreek\Traits;

use Illuminate\Http\JsonResponse;
use Request;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use Spatie\Fractal\Fractal;

trait ResponseTrait
{
    protected array $metaData = [];

    /**
     * Transform the data to a standardized format
     *
     * @param $data
     * @param null $transformerInstance
     * @param array $includes
     * @param array $meta
     * @param null $resourceKey
     * @return array
     */
    public function transform($data, $transformerInstance = null, $includes = [], $meta = [], $resourceKey = null): array {
        if ($transformerInstance instanceof \BaseTransformer) {
            $transformer =  $transformerInstance;
        } else {
            $transformer = new \BaseTransformer();
        }

        $this->metaData = [
            'include' => $transformer->getAvailableIncludes(),
            'custom'=> $meta,
        ];

        if (!$resourceKey) {
            $model = null;
            if ($data instanceof AbstractPaginator) {
                $model = $data->getCollection()->first();
            } else if ($data instanceof Collection) {
                $model = $data->first();
            } else {
                $model = $data;
            }

            if (!is_null($model)) {
                $resourceKey = $model->getResourceKey();
            }
        }

        $fractal = Fractal::create($data, $transformer)->withResourceName($resourceKey)->addMeta($this->metaData);

        // Parse the includes from the query params.
        $parsedRequestIncludes = $this->parseIncludes();

        // Merge the parsed includes given in the function params and query params.
        $parsedRequestIncludes = array_unique(array_merge($includes, $parsedRequestIncludes));

        // Add the parsed includes to fractal
        $fractal->parseIncludes($parsedRequestIncludes);

        if ($requestFilters = Request::query(config('config.requests.filter_name', 'filter'))) {
            $result = $this->filterResponse($fractal->toArray(), $this->parseFilters($requestFilters));
        } else {
            $result = $fractal->toArray();
        }

        return $result;
    }

    /**
     * Populate metaData variable to pass long meta data to the response
     *
     * @param $data
     * @return $this
     */
    public function withMeta($data): self {
        $this->metaData = $data;

        return $this;
    }

    /**
     * Return a formatted json response
     *
     * @param $message
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return JsonResponse
     */
    public function json($message, $status = 200, $headers = [], $options = 0): JsonResponse {
        return new JsonResponse($message, $status, $headers, $options);
    }

    /**
     * Return a formatted json response with created status
     *
     * @param null $message
     * @param array $headers
     * @param int $options
     * @return JsonResponse
     */
    public function created($message = null, $headers = [], $options = 0): JsonResponse {
        return $this->json($message, 201, $headers, $options);
    }

    /**
     * Return a formatted json response with accepted status
     *
     * @param null $message
     * @param array $headers
     * @param int $options
     * @return JsonResponse
     */
    public function accepted($message = null, $headers = [], $options = 0): JsonResponse {
        return $this->json($message, 202, $headers, $options);
    }

    /**
     * Return a formatted json response with Not Found status
     *
     * @param null $message
     * @param array $headers
     * @param int $options
     * @return JsonResponse
     */
    public function notFound($message = null, $headers = [], $options = 0): JsonResponse {
        return $this->json($message, 404, $headers, $options);
    }

    /**
     * Return a formatted json response with No Content status
     *
     * @return JsonResponse
     */
    public function noContent() {
        return new JsonResponse(null, 204);
    }

    /**
     * Parse the filters from the query params
     *
     * @param $filters
     * @return array
     */
    protected function parseFilters($filters): array {
        return  explode(config('config.requests.filter_separator', ';'), $filters);
    }

    /**
     * Parse the includes from the query params
     *
     * @return array
     */
    protected function parseIncludes(): array {
        return explode(config('config.requests.include_separator', ','), Request::query(config('config.requests.include_name', 'include')));
    }

    /**
     * Filters the response
     *
     * @param array $array
     * @param array $filters
     * @return array
     */
    private function filterResponse(array $array, array $filters): array {
        foreach ($array as $key => $value) {
            if (in_array($key, $filters, true)) {
                continue;
            }

            if (is_array($value)) {
                $value = $this->filterResponse($value, $filters);

                if (empty($value)) {
                    unset($array[$key]);
                } else {
                    $array[$key] = $value;
                }

                continue;
            } else {
                if (!in_array($key, $filters)) {
                    unset($array[$key]);
                    continue;
                }
            }
        }

        return $array;
    }
}