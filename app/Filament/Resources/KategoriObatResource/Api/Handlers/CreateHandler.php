<?php
namespace App\Filament\Resources\KategoriObatResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\KategoriObatResource;
use App\Filament\Resources\KategoriObatResource\Api\Requests\CreateKategoriObatRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = KategoriObatResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create KategoriObat
     *
     * @param CreateKategoriObatRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateKategoriObatRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}