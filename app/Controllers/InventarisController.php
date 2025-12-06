<?php

namespace App\Controllers;

use App\Models\MInventaris;
use Config\Services;

class InventarisController extends RestfulController
{
    public function create()
    {
        $request = Services::request();

        $data = $request->getJson(true);

        if (empty($data)) {
            return $this->responseHasil(400, false, 'Data body kosong atau tidak valid.');
        }

        $model = new MInventaris();
        $model->insert($data);
        $inventaris = $model->find($model->getInsertID());

        if (!$inventaris) {
            return $this->responseHasil(500, false, 'Gagal menyimpan data inventaris.');
        }

        return $this->responseHasil(201, true, $inventaris);
    }

    public function list()
    {
        $model = new MInventaris();
        $inventaris = $model->findAll();
        return $this->responseHasil(200, true, $inventaris);
    }

    public function detail($id)
    {
        $model = new MInventaris();
        $inventaris = $model->find($id);

        if (!$inventaris) {
            return $this->responseHasil(404, false, 'Data inventaris tidak ditemukan.');
        }

        return $this->responseHasil(200, true, $inventaris);
    }

    public function ubah($id = null)
    {
        if ($id == null) {
            return $this->responseHasil(400, false, 'ID Barang tidak ditemukan di URL.');
        }

        $model = new MInventaris();

        $cekBarang = $model->find($id);
        if (!$cekBarang) {
            return $this->responseHasil(404, false, 'Data dengan ID ' . $id . ' tidak ditemukan.');
        }

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (!$data) {
            $data = \Config\Services::request()->getJson(true);

            if (!$data) {
                return $this->responseHasil(400, false, 'Gagal membaca data JSON dari body request.');
            }
        }

        unset($data['id']);

        try {
            $model->update($id, $data);

            $finalData = $model->find($id);
            return $this->responseHasil(200, true, $finalData);

        } catch (\Exception $e) {
            return $this->responseHasil(500, false, 'Database Error: ' . $e->getMessage());
        }
    }

    public function hapus($id)
    {
        $model = new MInventaris();

        if (!$model->find($id)) {
            return $this->responseHasil(404, false, 'Data inventaris tidak ditemukan.');
        }

        $model->delete($id);
        return $this->responseHasil(200, true, 'Data berhasil dihapus');
    }
}