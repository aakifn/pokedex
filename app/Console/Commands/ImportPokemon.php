<?php

namespace App\Console\Commands;

use App\Models\Pokemon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportPokemon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-pokemon';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $pokemonCsv = "https://gist.githubusercontent.com/santiagoolivar2017/0591a53c4dd34ecd8488660c7372b0e3/raw/4be104b8bc8876acd15f8e21f1c5945f10e3aa1e/Pokemon-description-image.csv";

        try
        {
            $csv = Http::get($pokemonCsv)->resource();
        }
        catch (\Exception $e)
        {
            throw new \Exception("Could not download Pokemon csv");
        }

        try
        {
            fgetcsv($csv);

            while (($data = fgetcsv($csv)) !== false)
            {
                Pokemon::upsert([
                    'number' => $data[0],
                    'name' => $data[1],
                    'type1' => $data[2],
                    'type2' => $data[3],
                    'hp' => $data[4],
                    'attack' => $data[5],
                    'defense' => $data[6],
                    'speed' => $data[7],
                    'special' => $data[8],
                    'gif' => $data[9],
                    'png' => $data[10],
                    'description' => $data[11],
                ], uniqueBy: ['number']);

                $this->info("Imported pokemon #{$data[0]}: {$data[1]}");
            }
        }
        catch (\Exception $e)
        {
            echo $e->getMessage() . PHP_EOL;
            exit(1);
        }
    }
}
