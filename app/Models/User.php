<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Organization;

class User extends Authenticatable
{

    // Tokenの作成
    use HasApiTokens, HasFactory, Notifiable;
    use \Awobaz\Compoships\Compoships;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mode_admin',
        'domain_organization'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function organization(){

        try{
            return $this->belongsTo(Organization::class,['domain_organization','mode_reserve'],['domain_organization','mode_reserve']);
        }catch(\Exception $e){
            // return $e->getMessage();
            $this->name_organization='わからん';
            dd($e);
        }
        // return $this->belongsTo(Organization::class,['domain_organization','mode_reserve'],['domain_organization','mode_reserve']);
        // return $this->belongsTo(Organization::class,'mode_reserve','mode_reserve');

        }

        public function csvHeader(): array
        {
            return [
                'email',
                'domain_organization',
                'mode_reserve',
                'name',
                'password',
                'mode_admin',
                'flag_delete',
                'email_verified_at',
            ];
        }
    
        // public function getCsvData(): \Illuminate\Support\Collection
        // {
        //     $data = DB::table('items')->get();
        //     return $data;
        // }
        // public function insertRow($row): array
        // {
        //     return [
        //         $row->id,
        //         $row->name,
        //         $row->category_id,
        //         $row->description,
        //     ];
        // }

}
