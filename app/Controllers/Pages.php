<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home | Web Programming UPN'
        ];
        return view('pages/home', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About'
        ];
        return view('pages/about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact Us',
            'alamat' => [
                [
                    'tipe' => '- Rumah :',
                    'alamat' => 'Jl. Medokan Asri Utara V/12',
                    'kota' => 'Surabaya, Jawa Timur'
                ],
                [
                    'tipe' => '- Kantor :',
                    'alamat' => 'Ruko Rungkut Makmur C – 30, Jl. Raya Kali Rungkut 27',
                    'kota' => 'Surabaya, Jawa Timur'
                ],
                [
                    'tipe' => '- Universitas :',
                    'alamat' => 'Universitas Pembangunan Nasional "Veteran" Jawa Timur, Jl. Rungkut Madya No.1',
                    'kota' => 'Surabaya, Jawa Timur'
                ]
            ]
        ];
        return view('pages/contact', $data);
    }

    //--------------------------------------------------------------------

}
