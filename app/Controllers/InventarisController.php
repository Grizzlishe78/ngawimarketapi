<?php

namespace App\Controllers;

use App\Models\MInventaris;
use Config\Services;

class InventarisController extends RestfulController
{
    
    public function create()
    {
        $request = Services::request();
        $data = [
            'nama'                  => $request->getVar('nama'),
            'harga'                 => $request->getVar('harga'),
            'jumlah'                => $request->getVar('jumlah'),
            'tanggal_masuk'         => $request->getVar('tanggal_masuk'),
            'tanggal_kedaluwarsa'   => $request->getVar('tanggal_kedaluwarsa')
        ];

        $model = new MInventaris();
        $model->insert($data);
        $inventaris = $model->find($model->getInsertID());
        return $this->responseHasil(200, true, $inventaris);
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
        return $this->responseHasil(200, true, $inventaris);
    }

    public function ubah($id)
    {
        $request = Services::request();
        $data = [
            'nama'                  => $request->getVar('nama'),
            'harga'                 => $request->getVar('harga'),
            'jumlah'                => $request->getVar('jumlah'),
            'tanggal_masuk'         => $request->getVar('tanggal_masuk'),
            'tanggal_kedaluwarsa'   => $request->getVar('tanggal_kedaluwarsa')
        ];

        $model = new MInventaris();
        $model->update($id, $data);
        $inventaris = $model->find($id);
        return $this->responseHasil(200, true, $inventaris);
    }

    public function hapus($id)
    {
        $model = new MInventaris();
        $inventaris = $model->delete($id);
        return $this->responseHasil(200, true, $inventaris);
    }
}