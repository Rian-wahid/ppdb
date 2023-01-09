<?php
namespace PPDB\Entities;
class Fields{
    function __construct(){
        $this->fields=[
            [
                "name"=>"pendaftaran",
                "type"=>"string",
                "min"=>2,
                "max"=>6,
                "label"=>"Pendaftaran",
                "label_enum"=>["MA dan Pondok Pesantren","MA","MTs dan Pondok Pesantren","MTs"],
                "enum"=>["MA_PP","MA","MTs_PP","MTs"],
                "input"=>"radio",
                "description"=>""
            ],
            [
                "name"=>"nama_lengkap",
                "type"=>"string",
                "label"=>"Nama Lengkap",
                "min"=>2,
                "max"=>256,
                "input"=>"text",
                "description"=>"Nama lengkap sesuai dokumen resmi yang berlaku"
            ],
            [
                "name"=>"jenis_kelamin",
                "type"=>"string",
                "min"=>1,
                "max"=>1,
                "label"=>"Jenis Kelamin",
                "label_enum"=>["Laki-laki","Perempuan"],
                "enum"=>["L","P"],
                "input"=>"radio",
                "description"=>""
            ],
            [
                "name"=>"ttl",
                "type"=>"string",
                "label"=>"Tempat, tanggal lahir",
                "min"=>10,
                "max"=>256,
                "input"=>"text",
                "description"=>""
            ],
            [
                "name"=>"anak_ke",
                "type"=>"string",
                "label"=>"Anak ke",
                "min"=>4,
                "max"=>20,
                "input"=>"text",
                "description"=>"contoh; 9 dari 10"
            ],
            [
                "name"=>"usia",
                "type"=>"string",
                "label"=>"Usia",
                "min"=>NULL,
                "max"=>NULL,
                "input"=>"number",
                "description"=>""
            ],
            [
                "name"=>"alamat",
                "type"=>"string",
                "label"=>"Alamat",
                "min"=>2,
                "max"=>1024,
                "input"=>"textarea",
                "description"=>""
            ],
            [
                "name"=>"transportasi",
                "type"=>"string",
                "label"=>"Transportasi ke sekolah",
                "min"=>2,
                "max"=>64,
                "input"=>"text",
                "description"=>""
            ],
            [
                "name"=>"no_hp",
                "type"=>"string",
                "label"=>"No HP",
                "min"=>9,
                "max"=>15,
                "input"=>"tel",
                "description"=>"No HP yang bisa dihubungi"
            ],
            [
                "name"=>"nama_lengkap_ayah",
                "type"=>"string",
                "label"=>"Nama lengkap ayah",
                "min"=>2,
                "max"=>256,
                "input"=>"text",
                "description"=>"Nama lengkap ayah sesuai dokumen resmi yang berlaku"
            ],
            [
                "name"=>"nama_lengkap_ibu",
                "type"=>"string",
                "label"=>"Nama lengkap ibu",
                "min"=>2,
                "max"=>256,
                "input"=>"text",
                "description"=>"Nama lengkap ibu sesuai dokumen resmi yang berlaku"
            ],
            [
                "name"=>"pekejaan_ayah",
                "type"=>"string",
                "label"=>"Pekerjaan ayah",
                "min"=>2,
                "max"=>64,
                "input"=>"text",
                "description"=>""
            ],
            [
                "name"=>"pekerjaan_ibu",
                "type"=>"string",
                "label"=>"Pekerjaan ibu",
                "min"=>2,
                "max"=>64,
                "input"=>"text",
                "description"=>""
            ],
            [
                "name"=>"alamat_wali",
                "type"=>"string",
                "label"=>"Alamat wali",
                "min"=>2,
                "max"=>1024,
                "input"=>"textarea",
                "description"=>""
            ],
            [
                "name"=>"keterangan_ayah",
                "type"=>"string",
                "label"=>"Keterangan ayah",
                "min"=>2,
                "max"=>64,
                "input"=>"text",
                "description"=>"masih hidup atau meninggal pada tahun"
            ],[
                "name"=>"keterangan_ibu",
                "type"=>"string",
                "label"=>"Keterangan ibu",
                "min"=>2,
                "max"=>64,
                "input"=>"text",
                "description"=>"masih hidup atau meninggal pada tahun"
            ],
            [
                "name"=>"no_hp_wali",
                "type"=>"string",
                "label"=>"No Telp/HP wali",
                "min"=>9,
                "max"=>15,
                "input"=>"tel",
                "description"=>""
            ],
            
            [
                "name"=>"nama_sekolah_asal",
                "type"=>"string",
                "label"=>"Nama sekolah asal",
                "min"=>2,
                "max"=>256,
                "input"=>"text",
                "description"=>""
            ],
            [
                "name"=>"alamat_sekolah_asal",
                "type"=>"string",
                "label"=>"Alamat sekolah asal",
                "min"=>2,
                "max"=>1024,
                "input"=>"textarea",
                "description"=>""
            ],
            [
                "name"=>"no_telp_sekolah_asal",
                "type"=>"string",
                "label"=>"No Telp sekolah asal",
                "min"=>9,
                "max"=>15,
                "input"=>"tel",
                "description"=>""
            ],

            ];
    }
}