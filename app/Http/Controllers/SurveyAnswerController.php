<?php

namespace App\Http\Controllers;

use App\Http\Requests\SurveyAnswerRequest;
use App\Models\SurveyAnswer;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SurveyAnswerController extends Controller
{

    public function createSurveyAnswer(SurveyAnswerRequest $request): JsonResponse
    {
        try {
            $surveyQuestionId = $request->input("surveyQuestionId");
            $answer = $request->input("answer");

            DB::beginTransaction();
            $createSurveyAnswer = SurveyAnswer::create([
                'surveyQuestionId' => $surveyQuestionId,
                'answer' => $answer,
            ]);
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Survey Answer created successfully',
                'data' => $createSurveyAnswer
            ], ResponseAlias::HTTP_CREATED);
        } catch (Exception $error) {
            DB::rollBack();
            return response()->json(['error' => $error->getMessage()], ResponseAlias::HTTP_BAD_REQUEST);
        }
    }

    public function getSurveyAnswer(): JsonResponse
    {
        try {
            $surveyAnswer = SurveyAnswer::orderBy('id', 'desc')
                ->with('surveyQuestion')
                ->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Survey Answer fetched successfully',
                'data' => $surveyAnswer
            ], ResponseAlias::HTTP_OK);
        } catch (Exception $error) {
            return response()->json(['error' => $error->getMessage()], ResponseAlias::HTTP_BAD_REQUEST);
        }
    }

}
