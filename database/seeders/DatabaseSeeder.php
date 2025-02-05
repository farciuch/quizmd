<?php

namespace Database\Seeders;

use App\Models\PoziomTrudnosci;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use App\Models\Pytanie;
use App\Models\Odpowiedz;
use App\Models\ZgloszeniePytania;
use App\Models\ZgloszenieOdpowiedzi;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'fart12pl@gmail.com',
            'password' => Hash::make('@W!!ABDG343DD22'),
            'role' => 'admin',
        ]);
       
        
        $latwy = PoziomTrudnosci::create(['Trudnosc' => 'Łatwy']);
        $trudny = PoziomTrudnosci::create(['Trudnosc' => 'Trudny']);

        // Tworzenie 10 pytań
        for ($i = 1; $i <= 10; $i++) {
            $poziom = $i % 2 == 0 ? $latwy : $trudny; // Naprzemienne przypisanie poziomu trudności

            $pytanie = Pytanie::create([
                'Pytanie' => "Przykładowe pytanie numer $i",
                'IdPoziom' => $poziom->IdPoziom,
            ]);

            // Tworzenie odpowiedzi
            $odpowiedzi = [
                ['Odpowiedz' => "Odpowiedź 1 do pytania $i", 'Czy_poprawna' => false],
                ['Odpowiedz' => "Odpowiedź 2 do pytania $i", 'Czy_poprawna' => false],
                ['Odpowiedz' => "DOBRA $i", 'Czy_poprawna' => true], // Poprawna
                ['Odpowiedz' => "Odpowiedź 4 do pytania $i", 'Czy_poprawna' => false],
            ];

            foreach ($odpowiedzi as $odpowiedz) {
                Odpowiedz::create([
                    'Odpowiedz' => $odpowiedz['Odpowiedz'],
                    'Czy_poprawna' => $odpowiedz['Czy_poprawna'],
                    'IdPytania' => $pytanie->IdPytania,
                ]);
            }
        }
        $users = User::factory()->count(5)->create(['role' => 'user']);


        foreach ($users as $user) {
            for ($i = 1; $i <= 3; $i++) { // Każdy użytkownik dodaje 3 zgłoszenia
                // Losowe przypisanie poziomu trudności
                $poziom = $i % 2 == 0 ? $latwy : $trudny;

                // Tworzenie zgłoszenia pytania
                $zgloszeniePytania = ZgloszeniePytania::create([
                    'Tresc_zgloszenia' => "Przykładowe zgłoszenie pytania od użytkownika {$user->name}, numer $i",
                    'IdPoziom' => $poziom->IdPoziom,
                    'IdUzytkownik' => $user->id,
                ]);

                // Tworzenie odpowiedzi do zgłoszenia pytania
                $odpowiedzi = [
                    ['Tresc_zgloszenia_odpowiedzi' => "Odpowiedź 1 do zgłoszenia $i", 'Czy_poprawna' => false],
                    ['Tresc_zgloszenia_odpowiedzi' => "DOBRA $i", 'Czy_poprawna' => true], // Poprawna
                    ['Tresc_zgloszenia_odpowiedzi' => "Odpowiedź 3 do zgłoszenia $i", 'Czy_poprawna' => false],
                    ['Tresc_zgloszenia_odpowiedzi' => "Odpowiedź 4 do zgłoszenia $i", 'Czy_poprawna' => false],
                ];

                foreach ($odpowiedzi as $odpowiedz) {
                    ZgloszenieOdpowiedzi::create([
                        'Tresc_zgloszenia_odpowiedzi' => $odpowiedz['Tresc_zgloszenia_odpowiedzi'],
                        'Czy_poprawna' => $odpowiedz['Czy_poprawna'],
                        'IdZgloszenie_pytania' => $zgloszeniePytania->IdZgloszenie_pytania,
                    ]);
                }
            }
        }
        User::create([
            'name' => 'teSTER',
            'email' => 'fart13pl@gmail.com',
            'password' => Hash::make('Kozak123'),
            'role' => 'user',
        ]);
    }
}
