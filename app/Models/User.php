<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    protected $table = 'uzytkownicy';          // Ustawienie nazwy tabeli na 'uzytkownicy'
   

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the password for the user.
     * Laravel expects a `password` column by default, so we override this.
     */
    public function getAuthPassword()
    {
        return $this->password;
    }
    public function ranking()
    {
        return $this->hasMany(Ranking::class, 'IdUzytkownik');
    }

    public function zgloszeniaPytan()
    {
        return $this->hasMany(ZgloszeniePytania::class, 'IdUzytkownik');
    }
}

