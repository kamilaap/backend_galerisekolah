<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Agenda;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\AgendaResource;
use Illuminate\Support\Facades\Validator;


class AgendaController extends BaseController
{
    /**
     * Display a listing of the resource (menampilkan semua agenda).
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $agendas = Agenda::with(['kategori', 'user'])->get();
        return $this->sendResponse(AgendaResource::collection($agendas), 'Agendas retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage (menambahkan agenda baru).
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'tanggal_post_agenda' => 'required|date',
            'status' => 'required|in:aktif,nonaktif',
            'kategori_id' => 'required|exists:kategori,id',
            'users_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $agenda = Agenda::create($input);
        return $this->sendResponse($agenda, 'Agenda created successfully.');
    }

    /**
     * Display the specified resource (menampilkan agenda berdasarkan ID).
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $agenda = Agenda::with(['kategori', 'user'])->find($id);

        if (is_null($agenda)) {
            return $this->sendError('Agenda not found.');
        }

        return $this->sendResponse(new AgendaResource($agenda), 'Agenda retrieved successfully.');
    }

    /**
     * Update the specified resource in storage (memperbarui agenda).
     *
     * @param  Request  $request
     * @param  Agenda  $agenda
     * @return JsonResponse
     */
    public function update(Request $request, Agenda $agenda): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'tanggal_post_agenda' => 'required|date',
            'status' => 'required|in:aktif,nonaktif',
            'kategori_id' => 'required|exists:kategori,id',
            'users_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $agenda->update($input);
        return $this->sendResponse($agenda, 'Agenda updated successfully.');
    }

    /**
     * Remove the specified resource from storage (menghapus agenda).
     *
     * @param  Agenda  $agenda
     * @return JsonResponse
     */
    public function destroy(Agenda $agenda): JsonResponse
    {
        $agenda->delete();
        return $this->sendResponse([], 'Agenda deleted successfully.');
    }
}
