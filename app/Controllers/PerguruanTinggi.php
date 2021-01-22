<?php

namespace App\Controllers;

use App\Models\PretugasModel;

class PerguruanTinggi extends BaseController
{
    protected $perguruantinggiModel;
    public function __construct()
    {
        $this->perguruantinggiModel = new PretugasModel();
    }
    public function index()
    {
        //$perguruantinggi = $this->perguruantinggiModel->findAll();

        $data = [
            'title' => 'Daftar Perguruan Tinggi di Surabaya',
            'perguruantinggi' => $this->perguruantinggiModel->getPerguruanTinggi()
        ];
        return view('PerguruanTinggi/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Perguruan Tinggi',
            'perguruantinggi' => $this->perguruantinggiModel->getPerguruanTinggi($slug)
        ];

        //jika perguruan tinggi tidak ada di tabel

        if (empty($data['perguruantinggi'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Nama perguruan tinggi ' . $slug . ' tidak ditemukan');
        }

        return view('perguruantinggi/detail', $data);
    }

    public function create()
    {
        //session();
        $data = [
            'title' => 'Form Tambah Data Perguruan Tinggi',
            'validation' => \Config\Services::validation()
        ];
        return view('perguruantinggi/create', $data);
    }

    public function save()
    {
        //validasi input
        if (!$this->validate([
            'nama' => [
                'label'  => 'nama',
                'rules'  => 'required|is_unique[perguruantinggi.nama]',
                'errors' => [
                    'required' => '{field} perguruan tinggi harus diisi',
                    'is_unique' => '{field} perguruan tinggi sudah terdaftar'
                ]
            ],
            'alamat' => [
                'label'  => 'alamat',
                'rules'  => 'required|is_unique[perguruantinggi.alamat]',
                'errors' => [
                    'required' => '{field} perguruan tinggi harus diisi',
                    'is_unique' => '{field} perguruan tinggi sudah terdaftar'
                ]
            ],
            'rektor' => [
                'label'  => 'rektor',
                'rules'  => 'required|is_unique[perguruantinggi.rektor]',
                'errors' => [
                    'required' => '{field} perguruan tinggi harus diisi',
                    'is_unique' => '{field} perguruan tinggi sudah terdaftar'
                ]
            ],
            'gambar' => [
                'label'  => 'gambar',
                'rules'  => 'uploaded[gambar]|max_size[gambar,1024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'pilih gambar perguruan tinggi terlebih dahulu',
                    'max_size' => 'ukuran gambar terlalu besar',
                    'is_image' => 'file yang anda pilih bukan gambar',
                    'mime_in' => 'file yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/perguruantinggi/create')->withInput()->with('validation', $validation);
            return redirect()->to('/perguruantinggi/create')->withInput();
        }
        //ambil gambar
        $fileGambar = $this->request->getFile('gambar');

        //generate nama gambar random
        $namaGambar = $fileGambar->getRandomName();

        //pindahkan gambar ke folder img
        $fileGambar->move('img', $namaGambar);

        $slug = url_title($this->request->getVar('nama'), '-', true);
        $this->perguruantinggiModel->save([
            'nama' => $this->request->getVar('nama'),
            'slug' => $slug,
            'alamat' => $this->request->getVar('alamat'),
            'rektor' => $this->request->getVar('rektor'),
            'gambar' => $namaGambar
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('/perguruantinggi');
    }

    public function delete($id)
    {
        //cari gambar berdasarkan id
        $perguruantinggi = $this->perguruantinggiModel->find($id);

        //cek jika file gambarnya default.jpg
        if ($perguruantinggi['gambar'] != 'default.jpg') {
            //hapus gambar
            unlink('img/' . $perguruantinggi['gambar']);
        }

        $this->perguruantinggiModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/perguruantinggi');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Form Ubah Data Perguruan Tinggi',
            'validation' => \Config\Services::validation(),
            'perguruantinggi' => $this->perguruantinggiModel->getPerguruanTinggi($slug)
        ];
        return view('perguruantinggi/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'nama' => [
                'label'  => 'nama',
                'rules'  => 'required|is_unique[perguruantinggi.nama,id,' . $id . ']',
                'errors' => [
                    'required' => '{field} perguruan tinggi harus diisi',
                    'is_unique' => '{field} perguruan tinggi sudah terdaftar'
                ]
            ],
            'alamat' => [
                'label'  => 'alamat',
                'rules'  => 'required|is_unique[perguruantinggi.alamat,id,' . $id . ']',
                'errors' => [
                    'required' => '{field} perguruan tinggi harus diisi',
                    'is_unique' => '{field} perguruan tinggi sudah terdaftar'
                ]
            ],
            'rektor' => [
                'label'  => 'rektor',
                'rules'  => 'required|is_unique[perguruantinggi.rektor,id,' . $id . ']',
                'errors' => [
                    'required' => '{field} perguruan tinggi harus diisi',
                    'is_unique' => '{field} perguruan tinggi sudah terdaftar'
                ]
            ],
            'gambar' => [
                'label'  => 'gambar',
                'rules'  => 'max_size[gambar,1024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran gambar terlalu besar',
                    'is_image' => 'file yang anda pilih bukan gambar',
                    'mime_in' => 'file yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/perguruantinggi/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $fileGambar = $this->request->getFile('gambar');

        //cek gambar, apakah tetap gambar lama
        if ($fileGambar->getError() == 4) {
            $namaGambar = $this->request->getVar('gambarLama');
        } else {
            //generate nama file random
            $namaGambar = $fileGambar->getRandomName();

            //upload gambar
            $fileGambar->move('img', $namaGambar);

            //hapus file lama
            unlink('img/' . $this->request->getVar('gambarLama'));
        }

        $slug = url_title($this->request->getVar('nama'), '-', true);
        $this->perguruantinggiModel->save([
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'slug' => $slug,
            'alamat' => $this->request->getVar('alamat'),
            'rektor' => $this->request->getVar('rektor'),
            'gambar' => $namaGambar
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->to('/perguruantinggi');
    }
}
