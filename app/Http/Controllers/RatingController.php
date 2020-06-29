<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Rating;
use App\Http\Resources\RatingResource;

class RatingController extends Controller
{
	public function __construct()
    {
      $this->middleware('auth:api');
    }


     public function store(Request $request, Movie $movie)
      {
      $rating = Rating::firstOrCreate(
        [
          'user_id' => $request->user()->id,
          'movie_id' => $movie->id,
        ],
        ['rating' => $request->rating]
      );

      return new RatingResource($rating);
    }
}
