<?php
namespace App\Filament\Resources\RiwayatResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Riwayat;

/**
 * @property Riwayat $resource
 */
class RiwayatTransformer extends JsonResource
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
