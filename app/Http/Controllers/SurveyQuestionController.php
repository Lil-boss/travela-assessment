<?php

namespace App\Http\Controllers;

use App\Http\Requests\SurveyQuestionRequest;
use App\Models\Survey;
use App\Models\SurveyQuestion;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SurveyQuestionController extends Controller
{
    public function createSurveyQuestion(SurveyQuestionRequest $request): JsonResponse
    {
        try {
            $surveyId = $request->input("surveyId");
            $question = $request->input("question");
            $survey = Survey::find($surveyId);

            if (!$survey) {
                return response()->json(['error' => 'Survey not found'], ResponseAlias::HTTP_NOT_FOUND);
            }

            $createSurveyQuestion = SurveyQuestion::create([
                'surveyId' => $surveyId,
                'question' => $question,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Survey Question created successfully',
                'data' => $createSurveyQuestion
            ], 201);
        } catch (Exception $error) {
            return response()->json(['error' => $error->getMessage()], ResponseAlias::HTTP_BAD_REQUEST);
        }
    }

    public function getSurveyQuestion(): JsonResponse
    {
        try {
            $surveyQuestion = SurveyQuestion::orderBy('id', 'desc')->with("survey", "answer")->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Survey Question fetched successfully',
                'data' => $surveyQuestion
            ], ResponseAlias::HTTP_OK);
        } catch (Exception $error) {
            return response()->json(['error' => $error->getMessage()], ResponseAlias::HTTP_BAD_REQUEST);
        }
    }
}
