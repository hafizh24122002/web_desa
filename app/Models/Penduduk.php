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

    // /**
    //  * Define an inverse one-to-one or many relationship.
    //  *
    //  * @return BelongsTo
    //  */
    // public function Wilayah()
    // {
    //     return $this->belongsTo(Wilayah::class, 'id_cluster');
    // }

    /**
     * Getter wajib ktp attribute.
     *
     * @return string
     */
    public function getWajibKTPAttribute()
    {
        return (($this->tanggallahir->age > 16) || (! empty($this->status_kawin) && $this->status_kawin != 1))
            ? 'WAJIB KTP'
            : 'BELUM';
    }

    /**
     * Getter tempat dilahirkan attribute.
     *
     * @return string
     */
    public function getDiLahirkanAttribute()
    {
        return static::TEMPAT_LAHIR[$this->tempat_dilahirkan]
            ?? '';
    }

    /**
     * Getter jenis lahir attribute.
     *
     * @return string
     */
    public function getJenisLahirAttribute()
    {
        return static::JENIS_KELAHIRAN[$this->jenis_kelahiran]
            ?? '';
    }

    /**
     * Getter jenis lahir attribute.
     *
     * @return string
     */
    public function getPenolongLahirAttribute()
    {
        return static::PENOLONG_KELAHIRAN[$this->penolong_kelahiran]
            ?? '';
    }

    /**
     * Getter status perkawinan attribute.
     *
     * @return string
     */
    public function getStatusPerkawinanAttribute()
    {
        return ! empty($this->status_kawin) && $this->status_kawin != 2
            ? $this->statusKawin->nama
            : (
                empty($this->akta_perkawinan)
                    ? 'KAWIN BELUM TERCATAT'
                    : 'KAWIN TERCATAT'
            );
    }

    /**
     * Getter status hamil attribute.
     *
     * @return string
     */
    public function getStatusHamilAttribute()
    {
        return empty($this->hamil) ? 'TIDAK HAMIL' : 'HAMIL';
    }

    /**
     * Getter nama asuransi attribute.
     *
     * @return string
     */
    public function getNamaAsuransiAttribute()
    {
        return ! empty($this->id_asuransi) && $this->id_asuransi != 1
            ? (($this->id_asuransi == 99)
                ? "Nama/No Asuransi : {$this->no_asuransi}"
                : "No Asuransi : {$this->no_asuransi}")
            : '';
    }

    /**
     * Getter url foto attribute.
     *
     * @return string
     */
    public function getUrlFotoAttribute()
    {
        // try {
        //     return Storage::disk('ftp')->exists("desa/upload/user_pict/{$this->foto}")
        //         ? Storage::disk('ftp')->url("desa/upload/user_pict/{$this->foto}")
        //         : null;
        // } catch (Exception $e) {
        //     Log::error($e);
        // }
    }

    // /**
    //  * Scope query untuk status penduduk
    //  *
    //  * @param Builder $query
    //  * @param mixed   $value
    //  *
    //  * @return Builder
    //  */
    // public function scopeStatus($query, $value = 1)
    // {
    //     return $query->where('status_dasar', $value);
    // }

    public function scopeHubungWarga($query)
    {
        return $query->select(['id', 'nama', 'telepon', 'email', 'telegram', 'hubung_warga'])
            ->whereNotNull('telepon')
            ->orWhereNotNull('email')
            ->orWhereNotNull('telegram')
            ->status();
    }

    // /**
    //  * Scope query untuk menyaring data penduduk berdasarkan parameter yang ditentukan
    //  *
    //  * @param Builder $query
    //  * @param mixed   $value
    //  *
    //  * @return Builder
    //  */
    // public function scopefilters($query, array $filters = [])
    // {
    //     foreach ($filters as $key => $value) {
    //         $query->when($value ?? false, static function ($query) use ($value, $key) {
    //             $query->where($key, $value);
    //         });
    //     }

    //     return $query;
    // }

    public function getUsiaAttribute()
    {
        $tglSekarang = Carbon::now();
        $tglLahir    = Carbon::parse($this->tanggallahir);

        return $tglLahir->diffInYears($tglSekarang) . ' Tahun';
    }

    public function getUmurAttribute()
    {
        $tglSekarang = Carbon::now();
        $tglLahir    = Carbon::parse($this->tanggallahir);

        return $tglLahir->diffInYears($tglSekarang);
    }

    public function getAlamatWilayahAttribute()
    {
        if (! in_array($this->id_kk, [0, null])) {
            return $this->keluarga->alamat . ' RT ' . $this->keluarga->wilayah->rt . ' / RW ' . $this->keluarga->wilayah->rw . ' ' . 'dusun' . ' ' . $this->keluarga->wilayah->dusun;
        }

        return $this->alamat_sekarang . ' RT ' . $this->wilayah->rt . ' / RW ' . $this->wilayah->rw . ' ' . 'dusun' . ' ' . $this->wilayah->dusun;
    }
}
