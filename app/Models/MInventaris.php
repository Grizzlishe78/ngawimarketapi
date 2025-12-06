<?php
namespace App\Models;
use CodeIgniter\Model;

class MInventaris extends Model
{
    protected $table = 'inventaris';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'harga', 'jumlah', 'tanggal_masuk', 'tanggal_kedaluwarsa'];
}