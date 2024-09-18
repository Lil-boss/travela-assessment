<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function createSurvey(Request $request): JsonResponse
    {
        try {
            $createSurvey = Survey::create([
                'name' => $request->name,
                'date' => $request->date,
            ]);
            return response()->json([
                'message' => 'Survey created successfully',
                'data' => $createSurvey
            ], 201);
        } catch (Exception $error) {
            return response()->json(['error' => $error->getMessage()], 400);
        }
    }

    public function getSurvey(): JsonResponse
    {
        try {
            $survey = Survey::orderBy('id', 'desc')->get();
            return response()->json($survey, 200);
        } catch (Exception $error) {
            return response()->json(['error' => $error->getMessage()], 400);
        }
    }
}
