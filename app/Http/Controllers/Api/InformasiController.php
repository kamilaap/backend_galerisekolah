<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Informasi;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\InformasiResource;
use Illuminate\Support\Facades\Validator;

class InformasiController extends BaseController
{
    /**
     * Display a listing of the resource (menampilkan semua informasi).
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $informasis = Informasi::with(['kategori', 'user'])->get();
        return $this->sendResponse(InformasiResource::collection($informasis), 'Informasi retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage (menambahkan informasi baru).
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
            'kategori_id' => 'required|exists:kategori,id',
            'status' => 'required|in:aktif,nonaktif',
            'users_id' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        // Store image if provided
        if ($request->hasFile('image')) {
            $input['image'] = $request->file('image')->store('informasi', 'public');
        }

        $informasi = Informasi::create($input);
        return $this->sendResponse(new InformasiResource($informasi), 'Informasi created successfully.');
    }

    /**
     * Display the specified resource (menampilkan informasi berdasarkan ID).
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $informasi = Informasi::with(['kategori', 'user'])->find($id);

        if (is_null($informasi)) {
            return $this->sendError('Informasi not found.');
        }

        return $this->sendResponse(new InformasiResource($informasi), 'Informasi retrieved successfully.');
    }

    /**
     * Update the specified resource in storage (memperbarui informasi).
     *
     * @param  Request  $request
     * @param  Informasi  $informasi
     * @return JsonResponse
     */
    public function update(Request $request, Informasi $informasi): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'kategori_id' => 'required|exists:kategori,id',
            'status' => 'required|in:aktif,nonaktif',
            'users_id' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        // Update image if a new one is provided
        if ($request->hasFile('image')) {
            $input['image'] = $request->file('image')->store('images', 'public');
        }

        $informasi->update($input);
        return $this->sendResponse(new InformasiResource($informasi), 'Informasi updated successfully.');
    }

    /**
     * Remove the specified resource from storage (menghapus informasi).
     *
     * @param  Informasi  $informasi
     * @return JsonResponse
     */
    public function destroy(Informasi $informasi): JsonResponse
    {
        $informasi->delete();
        return $this->sendResponse([], 'Informasi deleted successfully.');
    }
}
