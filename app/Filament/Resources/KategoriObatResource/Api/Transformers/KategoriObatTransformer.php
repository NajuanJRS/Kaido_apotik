<?php
namespace App\Filament\Resources\KategoriObatResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\KategoriObat;

/**
 * @property KategoriObat $resource
 */
class KategoriObatTransformer extends JsonResource
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
