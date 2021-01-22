<?php

namespace App\Models;

use CodeIgniter\Model;

class PretugasModel extends Model
{
    protected $table = 'perguruantinggi';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'slug', 'alamat', 'rektor', 'gambar'];

    public function getPerguruanTinggi($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
}
