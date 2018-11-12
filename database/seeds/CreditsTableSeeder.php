<?php

use Crockett\CsvSeeder\CsvSeeder;

class CreditsTableSeeder extends CsvSeeder
{
    public function __construct()
	{
        $this->filename = base_path('/database/seeds/csvs/tmdb_5000_credits.csv');
        $this->table = 'credits';
        // $this->mapping = [
        //     0 => 'movie_id',
        //     1 => 'title',
        //     2 => 'cast',
        //     3 => 'crew',
        // ];
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

		parent::run();
    }
}
