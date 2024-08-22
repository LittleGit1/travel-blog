<?php

namespace Database\Seeders;

use App\Models\CommentLike;
use App\Models\Post;
use App\Models\Category;
use App\Models\Country;
use App\Models\CountryDestination;
use App\Models\Flight;
use App\Models\PostCategory;
use App\Models\PostComment;
use App\Models\PostLike;
use Illuminate\Support\Str;
use App\Models\User;
use Database\Factories\PostCategoryFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'external_id' => Str::uuid(),
            'name' => 'Bruce',
            'email' => 'bvajones@icloud.com',
            'admin' => true
        ]);

        Category::factory()->create(
            [
                'title'     => "Japan",
                'slug'      => "japan"
            ],
        );

        Category::factory()->create(
            [
                'title'     => "Vietnam",
                'slug'      => "vietnam"
            ],
        );

        Category::factory()->create(
            [
                'title'     => "Thailand",
                'slug'      => "thailand"
            ],
        );

        Category::factory()->create(
            [
                'title'     => "Cambodia",
                'slug'      => "cambodia"
            ],
        );

        Category::factory()->create(
            [
                'title'     => "Laos",
                'slug'      => "laos"
            ],
        );

        Category::factory()->create(
            [
                'title'     => "Indonesia",
                'slug'      => "indonesia"
            ],
        );

        Post::factory(20)->create();

        DB::table('post_categories')->insert(
            [
                [

                    'post_id' => Post::inRandomOrder()->first()->id,
                    'category_id' => Category::inRandomOrder()->first()->id,
                ],
                [

                    'post_id' => Post::inRandomOrder()->first()->id,
                    'category_id' => Category::inRandomOrder()->first()->id,
                ],
                [

                    'post_id' => Post::inRandomOrder()->first()->id,
                    'category_id' => Category::inRandomOrder()->first()->id,
                ],
                [

                    'post_id' => Post::inRandomOrder()->first()->id,
                    'category_id' => Category::inRandomOrder()->first()->id,
                ],
                [

                    'post_id' => Post::inRandomOrder()->first()->id,
                    'category_id' => Category::inRandomOrder()->first()->id,
                ],
                [

                    'post_id' => Post::inRandomOrder()->first()->id,
                    'category_id' => Category::inRandomOrder()->first()->id,
                ],
                [

                    'post_id' => Post::inRandomOrder()->first()->id,
                    'category_id' => Category::inRandomOrder()->first()->id,
                ],
                [

                    'post_id' => Post::inRandomOrder()->first()->id,
                    'category_id' => Category::inRandomOrder()->first()->id,
                ],
                [

                    'post_id' => Post::inRandomOrder()->first()->id,
                    'category_id' => Category::inRandomOrder()->first()->id,
                ],
                [

                    'post_id' => Post::inRandomOrder()->first()->id,
                    'category_id' => Category::inRandomOrder()->first()->id,
                ],
                [

                    'post_id' => Post::inRandomOrder()->first()->id,
                    'category_id' => Category::inRandomOrder()->first()->id,
                ],
                [

                    'post_id' => Post::inRandomOrder()->first()->id,
                    'category_id' => Category::inRandomOrder()->first()->id,
                ],
            ]
        );



        //PostComment::factory(500)->create();

        //PostComment::factory(500)->reply()->create();

        //PostComment::factory(500)->deletedUser()->create();

        //PostComment::factory(500)->deletedUser()->reply()->create();

        //CommentLike::factory(500)->create();

        PostLike::factory(500)->create();

        Flight::factory()->create([
            "origin_name" => "London",
            "destination_name" => "Singapore",
            "origin_lat" => "51.470020",
            "origin_lng" => "-0.454295",
            "destination_lat" => "1.359167",
            "destination_lng" => "103.989441",
        ]);

        Flight::factory()->create([
            "origin_name" => "Singapore",
            "destination_name" => "Thailand",
            "origin_lat" => "1.359167",
            "origin_lng" => "103.989441",
            "destination_lat" => "13.689999",
            "destination_lng" => "100.750114",
        ]);

        Flight::factory()->create([
            "origin_name" => "Thailand",
            "destination_name" => "Laos",
            "origin_lat" => "18.7667",
            "origin_lng" => "98.9575",
            "destination_lat" => "17.9863",
            "destination_lng" => "102.5580",
        ]);

        Flight::factory()->create([
            "origin_name" => "Laos",
            "destination_name" => "Cambodia",
            "origin_lat" => "17.9863",
            "origin_lng" => "102.5580",
            "destination_lat" => "11.5468",
            "destination_lng" => "104.844",
        ]);

        Country::factory()->create([
            "name"  => "Singapore",
        ]);

        Country::factory()->create([
            "name"  => "Thailand"
        ]);

        Country::factory()->create([
            "name"  => "Laos",
        ]);

        Country::factory()->create([
            "name"  => "Cambodia",
        ]);

        CountryDestination::factory()->create([
            "name" => "Gardens by the Bay",
            "country_id" => 1,
            "lat" => "1.282375",
            "lng" => "103.864273"
        ]);

        CountryDestination::factory()->create([
            "name" => "Changi",
            "country_id" => 1,
            "lat" => "1.345010",
            "lng" =>  "103.983208"
        ]);

        CountryDestination::factory()->create([
            "name" => "The Helix Bridge",
            "country_id" => 1,
            "lat" => "1.287620",
            "lng" =>  "103.861000"
        ]);

        CountryDestination::factory()->create([
            "name" => "Odette",
            "country_id" => 1,
            "lat" => "1.289688",
            "lng" => "103.851562"
        ]);


        CountryDestination::factory()->create([
            "name" => "National Library",
            "country_id" => 1,
            "lat" => "1.297588",
            "lng" => "103.854309"
        ]);

        CountryDestination::factory()->create([
            "name" => "Tiger Sky Tower",
            "country_id" => 1,
            "lat" => "1.254975",
            "lng" => "103.817596"
        ]);

        CountryDestination::factory()->create([
            "name" => "Bangkok",
            "country_id" => 2,
            "lat" => "13.736717",
            "lng" => "100.523186"
        ]);

        CountryDestination::factory()->create([
            "name" => "Chiang Mai",
            "country_id" => 2,
            "lat" => "18.796143",
            "lng" => "98.979263"
        ]);

        CountryDestination::factory()->create([
            "name" => "Phuket",
            "country_id" => 2,
            "lat" => "7.878978",
            "lng" => "98.398392"
        ]);

        CountryDestination::factory()->create([
            "name" => "Chon Buri",
            "country_id" => 2,
            "lat" => "13.361143",
            "lng" => "100.984673"
        ]);


        CountryDestination::factory()->create([
            "name" => "Nakhon Ratchasima",
            "country_id" => 2,
            "lat" => "14.979900",
            "lng" => "102.097771"
        ]);

        CountryDestination::factory()->create([
            "name" => "Vientiane",
            "country_id" => 3,
            "lat" => "17.974855",
            "lng" => "102.630867"
        ]);

        CountryDestination::factory()->create([
            "name" => "Luang Prabang",
            "country_id" => 3,
            "lat" => "19.889271",
            "lng" => "102.133453"
        ]);

        CountryDestination::factory()->create([
            "name" => "Pakse",
            "country_id" => 3,
            "lat" => "15.110507",
            "lng" => "105.817291"
        ]);

        CountryDestination::factory()->create([
            "name" => "Dansavan",
            "country_id" => 3,
            "lat" => "16.624115",
            "lng" => "106.576843"
        ]);

        CountryDestination::factory()->create([
            "name" => "Thakhek",
            "country_id" => 3,
            "lat" => "17.403021",
            "lng" => "104.833786"
        ]);

        CountryDestination::factory()->create([
            "name" => "Vang Vieng",
            "country_id" => 3,
            "lat" => "18.950090",
            "lng" => "102.443787"
        ]);

        CountryDestination::factory()->create([
            "name" => "Phnom Penh",
            "country_id" => 4,
            "lat" => "11.562108",
            "lng" => "104.888535"
        ]);

        CountryDestination::factory()->create([
            "name" => "Krong Siem",
            "country_id" => 4,
            "lat" => "13.364047",
            "lng" => "103.860313"
        ]);

        CountryDestination::factory()->create([
            "name" => "Kampot",
            "country_id" => 4,
            "lat" => "10.594242",
            "lng" => "104.164032"
        ]);
    }
}
