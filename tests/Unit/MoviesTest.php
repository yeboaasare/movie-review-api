<?php

 namespace Tests\Unit;

 use Tests\TestCase;
 use App\User;
 use App\Movie;
 use Illuminate\Foundation\Testing\WithoutMiddleware;
 use Illuminate\Foundation\Testing\WithFaker;


 class ApiTest extends TestCase {

  use WithFaker;


 #se DatabaseMigrations;
 	/**
 	 * A basic functional test example.
 	 *
 	 * @return void
 	 */


  private function create_and_authenticate_user()
  {
    $user = factory(User::class)->create();
          $response = $this->actingAs($user, 'api');
          $this->assertAuthenticated($guard = null);
  }



   	/**
      * @runInSeparateProcess
      * @test
      */
  public function can_create_movie()
 	{
      //call method to create and log user in
      $this->create_and_authenticate_user();

        $data = [
                'user_id' => auth()->user()->id,
                'title' =>  $this->faker->word,
                'description' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
        ];
        $response = $this->postJson('api/movies',$data);
        $response ->assertStatus(201);

 }

    /**
      * @runInSeparateProcess
      * @test
      */
 public function can_list_movie_details()
 {
    $movie = Movie::latest()->first()->id;
    $response = $this->getJson('api/movies/'.$movie);
    $response ->assertStatus(200);
    //dd($response);

 }

    /**
      * @runInSeparateProcess
      * @test
      */
public function can_update_movie_details()
{
    $movie = Movie::latest()->first()->id;

        $data = [
                'title' =>  $this->faker->word,
                'description' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
              ];
    $response = $this->putJson('api/movies/'.$movie,$data);
    $response ->assertStatus(200);
}

/**
      * @runInSeparateProcess
      * @test
      */
public function can_rate_movie()
{
    $this->create_and_authenticate_user();
    $movie = Movie::latest()->first();

    $data = [
      'user_id' => $movie->user_id,
      'movie_id' => $movie->id,
      'rating' => $this->faker->unique()->randomDigit,
    ];
    $response = $this->postJson('api/movies/'.$movie->id.'/ratings',$data);
    $response ->assertStatus(201);
   }

    /**
      * @runInSeparateProcess
      * @test
      */
public function can_delete_movie()
{
  $movie = Movie::latest()->first()->id;
  $response = $this->deleteJson('api/movies/'.$movie);
  $response ->assertStatus(200);
}


    

}
