<?php
namespace App\Filament\Resources\EResepResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\EResepResource;
use App\Filament\Resources\EResepResource\Api\Requests\CreateEResepRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = EResepResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create EResep
     *
     * @param CreateEResepRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateEResepRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}