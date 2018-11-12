<?php

use Crockett\CsvSeeder\CsvSeeder;

class MoviesTableSeeder extends CsvSeeder
{

    public function __construct()
	{
		$this->table = 'movies';
        $this->filename = base_path('/database/seeds/csvs/tmdb_5000_movies.csv');
        $this->mapping = [
            0 => 'budget',
            1 => 'genres',
            2 => 'homepage',
            3 => 'movie_id',
            4 => 'keywords',
            5 => 'original_language',
            6 => 'original_title',
            7 => 'overview',
            8 => 'popularity',
            9 => 'production_companies',
            10 => 'production_countries',
            11 => 'release_date',
            12 => 'revenue',
            13 => 'runtime',
            14 => 'spoken_languages',
            15 => 'status',
            16 => 'tagline',
            17 => 'title',
            18 => 'vote_average',
            19 => 'vote_count',
        ];
	}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Recommended when importing larger CSVs
		//DB::disableQueryLog();

		// Uncomment the below to wipe the table clean before populating
        //DB::table($this->table)->truncate();
        $this->console_logs  = true;
		parent::run();
    }
}
