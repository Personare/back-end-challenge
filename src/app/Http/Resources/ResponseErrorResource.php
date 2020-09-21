<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ResponseErrorResource extends JsonResource
{
    public $additional = [ 'success' => false ];

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) : array
    {
        parent::wrap('errors');

        return [
            'message' => $this->getMessage(), 
            'code' => $this->getCode(),
            'trace' => Str::limit($this->getTraceAsString(), 250)
        ];
    }

    /**
     * Customize the outgoing response for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Response  $response
     * @return void
     */
    public function withResponse($request, $response)
    {
        $response->header('Content-Type', 'application/json')
            ->setStatusCode('403');
    }
}
