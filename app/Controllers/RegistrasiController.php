<?php

namespace App\Controllers;

use App\Models\MRegistrasi;
use Config\Services;

class RegistrasiController extends RestfulController
{
    public function registrasi()
    {
        $request = Services::request();

        $data = [
            'nama'     => $request->getVar('nama'),
            'email'    => $request->getVar('email'),
            'password' => password_hash($request->getVar('password'), PASSWORD_DEFAULT)];

    $model = new MRegistrasi();
    $model->save($data);
    return $this->responseHasil(200, true, "Registrasi Berhasil");
    }
}