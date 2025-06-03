<?php
namespace App\Filament\Resources\KategoriObatResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\KategoriObatResource;
use App\Filament\Resources\KategoriObatResource\Api\Requests\UpdateKategoriObatRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = KategoriObatResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update KategoriObat
     *
     * @param UpdateKategoriObatRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdateKategoriObatRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}