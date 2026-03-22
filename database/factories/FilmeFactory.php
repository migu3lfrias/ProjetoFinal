<?php

namespace Database\Factories;

use App\Models\Estudio;
use App\Models\Filme;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Filme>
 */
class FilmeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        // Assume que o teu model agora se chama Estudio
        'estudio_id' => Estudio::factory(),

        // Gera um título com cerca de 3 palavras
        'titulo' => fake()->sentence(3),

        // Imagem vertical a simular uma capa de filme
        'capa' => fake()->imageUrl(600, 900, 'abstract', true, 'Capa Filme'),

        // Data de lançamento nos últimos 30 anos
        'data_lancamento' => fake()->dateTimeBetween('-30 years', 'now')->format('Y-m-d'),

        // Escolhe um género aleatório
        'genero' => fake()->randomElement(['Ação', 'Comédia', 'Drama', 'Ficção Científica', 'Terror', 'Aventura', 'Animação']),
    ];
}
}
