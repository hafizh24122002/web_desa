<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Agama;
use App\Models\pendidikanTerakhir;
use App\Models\Pekerjaan;
use App\Models\JenisKelamin;

class Penduduk extends Model
{
    use HasFactory;

    /**
     * Static data tempat lahir.
     *
     * @var array
     */
    public const TEMPAT_LAHIR = [
        1 => 'RS/RB',
        2 => 'Puskesmas',
        3 => 'Polindes',
        4 => 'Rumah',
        5 => 'Lainnya',
    ];

    /**
     * Static data jenis kelahiran.
     *
     * @var array
     */
    public const JENIS_KELAHIRAN = [
        1 => 'Tunggal',
        2 => 'Kembar 2',
        3 => 'Kembar 3',
        4 => 'Kembar 4',
    ];

    /**
     * Static data penolong kelahiran.
     *
     * @var array
     */
    public const PENOLONG_KELAHIRAN = [
        1 => 'Dokter',
        2 => 'Bidan Perawat',
        3 => 'Dukun',
        4 => 'Lainnya',
    ];

    /**
     * {@inheritDoc}
     */
    protected $table = 'penduduk';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [

    ];

    /**
     * {@inheritDoc}
     */
    protected $appends = [
        'usia',
        'alamat_wilayah',
    ];

    /**
     * {@inheritDoc}
     */
    protected $with = [
        'jenisKelamin',
        'agama',
        'pendidikanSaatIni',
        'pendidikanTerakhir',
        'pekerjaan',
        'kewarganegaraan',
        'golonganDarah',
        'cacat',
        'statusPerkawinan',
        'pendudukStatus',
        // 'wilayah',
    ];

    /**
     * {@inheritDoc}
     */
    protected $casts = [
        'tanggal_lahir' => 'datetime',
    ];

    /**
     * The guarded with the model.
     *
     * @var array
     */
    protected $guarded = [];

    // /**
    //  * Define a one-to-one relationship.
    //  *
    //  * @return HasOne
    //  */
    // public function mandiri()
    // {
    //     return $this->hasOne(PendudukMandiri::class, 'id_pend');
    // }

    // /**
    //  * Define a one-to-one relationship.
    //  *
    //  * @return HasOne
    //  */
    // public function kia_ibu()
    // {
    //     return $this->hasOne(KIA::class, 'ibu_id');
    // }

    // /**
    //  * Define a one-to-one relationship.
    //  *
    //  * @return HasOne
    //  */
    // public function kia_anak()
    // {
    //     return $this->hasOne(KIA::class, 'anak_id');
    // }

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @return BelongsTo
     */
    public function jenisKelamin()
    {
        return $this->belongsTo(JenisKelamin::class, 'id_jenis_kelamin')->withDefault();
    }

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @return BelongsTo
     */
    public function agama()
    {
        return $this->belongsTo(Agama::class, 'id_agama')->withDefault();
    }

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @return BelongsTo
     */
    public function pendidikanSaatIni()
    {
        return $this->belongsTo(PendidikanSaatIni::class, 'id_pendidikan_saat_ini')->withDefault();
    }

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @return BelongsTo
     */
    public function pendidikanTerakhir()
    {
        return $this->belongsTo(pendidikanTerakhir::class, 'id_pendidikan_terakhir')->withDefault();
    }

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @return BelongsTo
     */
    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class, 'id_pekerjaan')->withDefault();
    }

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @return BelongsTo
     */
    public function kewarganegaraan()
    {
        return $this->belongsTo(Kewarganegaraan::class, 'id_kewarganegaraan')->withDefault();
    }

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @return BelongsTo
     */
    public function golonganDarah()
    {
        return $this->belongsTo(GolonganDarah::class, 'id_golongan_darah')->withDefault();
    }

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @return BelongsTo
     */
    public function cacat()
    {
        return $this->belongsTo(Cacat::class, 'id_cacat')->withDefault();
    }

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @return BelongsTo
     */
    public function sakitMenahun()
    {
        return $this->belongsTo(SakitMenahun::class, 'id_sakit_menahun')->withDefault();
    }

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @return BelongsTo
     */
    public function kb()
    {
        return $this->belongsTo(KB::class, 'id_cara_kb')->withDefault();
    }

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @return BelongsTo
     */
    public function statusPerkawinan()
    {
        return $this->belongsTo(StatusPerkawinan::class, 'status_kawin')->withDefault();
    }

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @return BelongsTo
     */
    public function hubunganKK()
    {
        return $this->belongsTo(HubunganKK::class, 'id_hubungan_kk')->withDefault();
    }

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @return BelongsTo
     */
    public function pendudukStatus()
    {
        return $this->belongsTo(PendudukStatus::class, 'id_penduduk_status')->withDefault();
    }

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @return BelongsTo
     */
    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class, 'id_kk')->withDefault();
    }

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @return BelongsTo
     */
    public function rtm()
    {
        return $this->belongsTo(Rtm::class, 'id_rtm', 'no_kk')->withDefault();
    }

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @return BelongsTo
     */
    public function Wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'id_cluster');
    }
}
