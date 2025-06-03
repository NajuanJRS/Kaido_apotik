<?php
namespace App\Filament\Resources\EResepResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\EResep;

/**
 * @property EResep $resource
 */
class EResepTransformer extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->resource->toArray();
    }
}
