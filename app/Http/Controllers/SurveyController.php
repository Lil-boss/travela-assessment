<?php

namespace App\Http\Controllers;

use App\Http\Requests\SurveyRequest;
use App\Models\Survey;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SurveyController extends Controller
{
    public function createSurvey(SurveyRequest $request): JsonResponse
    {
        try {

            $name = $request->input("name");
            $date = $request->input("date");

            $createSurvey = Survey::create([
                'name' => $name,
                'date' => $date,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Survey created successfully',
                'data' => $createSurvey
            ], ResponseAlias::HTTP_CREATED);
        } catch (Exception $error) {
            return response()->json(['error' => $error->getMessage()], ResponseAlias::HTTP_BAD_REQUEST);
        }
    }

    public function getSurvey(): JsonResponse
    {
        try {
            $survey = Survey::orderBy('id', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Survey fetched successfully',
                'data' => $survey
            ], ResponseAlias::HTTP_OK);
        } catch (Exception $error) {
            return response()->json(['error' => $error->getMessage()], ResponseAlias::HTTP_BAD_REQUEST);
        }
    }
}
