<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Filme;

class FilmeSeeder extends Seeder
{
    public function run(): void
    {
        $baseImageUrl = 'https://image.tmdb.org/t/p/w500';

        $filmes = [
            // 1. Warner Bros
            ['estudio_id' => 1, 'titulo' => 'The Dark Knight', 'genero' => 'Ação', 'data_lancamento' => '2008-07-18', 'capa' => $baseImageUrl . '/qJ2tW6WMUDux911r6m7haRef0WH.jpg'],
            ['estudio_id' => 1, 'titulo' => 'Inception', 'genero' => 'Ficção Científica', 'data_lancamento' => '2010-07-16', 'capa' => $baseImageUrl . '/oYuLEt3zVCKq57qu2F8dT7NIa6f.jpg'],
            ['estudio_id' => 1, 'titulo' => 'The Matrix', 'genero' => 'Ficção Científica', 'data_lancamento' => '1999-03-31', 'capa' => $baseImageUrl . '/f89U3ADr1oiB1s9GkdPOEpXUk5H.jpg'],
            ['estudio_id' => 1, 'titulo' => 'Harry Potter', 'genero' => 'Fantasia', 'data_lancamento' => '2001-11-16', 'capa' => $baseImageUrl . '/wuMc08IPKEb09Vd7607UuW1KEEi.jpg'],

            // 2. Universal Pictures
            ['estudio_id' => 2, 'titulo' => 'Jurassic Park', 'genero' => 'Aventura', 'data_lancamento' => '1993-06-11', 'capa' => $baseImageUrl . '/oU7Oq2kFAAlGqbU4VRcf4A2hX01.jpg'],
            ['estudio_id' => 2, 'titulo' => 'Back to the Future', 'genero' => 'Ficção Científica', 'data_lancamento' => '1985-07-03', 'capa' => $baseImageUrl . '/fNOH9f1qQ7rFIE1w6PCEY28ZfIf.jpg'],
            ['estudio_id' => 2, 'titulo' => 'Gladiator', 'genero' => 'Ação / Drama', 'data_lancamento' => '2000-05-05', 'capa' => $baseImageUrl . '/ty8TGRuvJLPUmAR1H1nRIsgwvq0.jpg'],
            ['estudio_id' => 2, 'titulo' => 'Jaws', 'genero' => 'Terror', 'data_lancamento' => '1975-06-20', 'capa' => $baseImageUrl . '/lxD5ak7BOohm0jz6oTElD1mHajU.jpg'],

            // 3. Paramount Pictures
            ['estudio_id' => 3, 'titulo' => 'Interstellar', 'genero' => 'Ficção Científica', 'data_lancamento' => '2014-11-07', 'capa' => $baseImageUrl . '/gEU2QniE6E77NI6lCU6MxlNBvIx.jpg'],
            ['estudio_id' => 3, 'titulo' => 'The Godfather', 'genero' => 'Drama', 'data_lancamento' => '1972-03-24', 'capa' => $baseImageUrl . '/3bhkrj58Vtu7enYsRolD1eNEcs.jpg'],
            ['estudio_id' => 3, 'titulo' => 'Top Gun: Maverick', 'genero' => 'Ação', 'data_lancamento' => '2022-05-27', 'capa' => $baseImageUrl . '/62HCnUTziyWcpZ1pT4NwzPEd39.jpg'],
            ['estudio_id' => 3, 'titulo' => 'Titanic', 'genero' => 'Romance', 'data_lancamento' => '1997-12-19', 'capa' => $baseImageUrl . '/9xjZS2rlVxm8SFK8pPD6eeWD90Q.jpg'],

            // 4. Walt Disney Studios
            ['estudio_id' => 4, 'titulo' => 'The Lion King', 'genero' => 'Animação', 'data_lancamento' => '1994-06-15', 'capa' => $baseImageUrl . '/sKCr78AS8NY5nO14mPZ4K4Lq0sL.jpg'],
            ['estudio_id' => 4, 'titulo' => 'Toy Story', 'genero' => 'Animação', 'data_lancamento' => '1995-11-22', 'capa' => $baseImageUrl . '/uXDfjJbdP4ijW5hWSBrPrlKpxab.jpg'],
            ['estudio_id' => 4, 'titulo' => 'The Avengers', 'genero' => 'Ação', 'data_lancamento' => '2012-05-04', 'capa' => $baseImageUrl . '/RYMX2wcKCBAr24UyPD0lwaAexH.jpg'],
            ['estudio_id' => 4, 'titulo' => 'Pirates of the Caribbean', 'genero' => 'Aventura', 'data_lancamento' => '2003-07-09', 'capa' => $baseImageUrl . '/z8onk7A8wOAEH0E01o5e1x1b7H.jpg'],

            // 5. Sony Pictures
            ['estudio_id' => 5, 'titulo' => 'Spider-Man', 'genero' => 'Ação', 'data_lancamento' => '2002-05-03', 'capa' => $baseImageUrl . '/gh4cZbhZxyTbgxQPxD0dOudNPTn.jpg'],
            ['estudio_id' => 5, 'titulo' => 'Men in Black', 'genero' => 'Comédia', 'data_lancamento' => '1997-07-02', 'capa' => $baseImageUrl . '/tTfNd0K9z0qN1Zq4gUu20nJ6h67.jpg'],
            ['estudio_id' => 5, 'titulo' => 'Ghostbusters', 'genero' => 'Comédia', 'data_lancamento' => '1984-06-08', 'capa' => $baseImageUrl . '/v2A2QGv23y9xVn4D8W0O7o1aD5.jpg'],
            ['estudio_id' => 5, 'titulo' => 'Jumanji', 'genero' => 'Aventura', 'data_lancamento' => '1995-12-15', 'capa' => $baseImageUrl . '/vgJ7sN1aNqP2FndgTzI2e08r72v.jpg'],

            // 6. 20th Century Studios
            ['estudio_id' => 6, 'titulo' => 'Avatar', 'genero' => 'Ficção Científica', 'data_lancamento' => '2009-12-18', 'capa' => $baseImageUrl . '/kyeqWdyA2o79C56XzD8hQp3y9K8.jpg'],
            ['estudio_id' => 6, 'titulo' => 'Alien', 'genero' => 'Terror', 'data_lancamento' => '1979-05-25', 'capa' => $baseImageUrl . '/vOPEv5GvyV3iBwVnIfI18RofQYt.jpg'],
            ['estudio_id' => 6, 'titulo' => 'Die Hard', 'genero' => 'Ação', 'data_lancamento' => '1988-07-15', 'capa' => $baseImageUrl . '/yFihWxQcmOcaCRZkMvR5AEEF2P.jpg'],
            ['estudio_id' => 6, 'titulo' => 'Fight Club', 'genero' => 'Drama', 'data_lancamento' => '1999-10-15', 'capa' => $baseImageUrl . '/pB8BM7pdSp6B6Ih7QZ4DrQ3PmJK.jpg'],
        ];

        foreach ($filmes as $filme) {
            Filme::create($filme);
        }
    }
}
