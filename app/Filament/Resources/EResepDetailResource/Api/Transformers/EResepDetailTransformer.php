<?php
namespace App\Filament\Resources\EResepDetailResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\EResepDetail;

/**
 * @property EResepDetail $resource
 */
class EResepDetailTransformer extends JsonResource
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
