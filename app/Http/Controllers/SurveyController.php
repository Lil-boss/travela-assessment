<?php

namespace App\Http\Controllers;

use App\Http\Requests\SurveyRequest;
use App\Models\Survey;
use App\Service\SurveyEventService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SurveyController extends Controller
{
    public function createSurvey(SurveyRequest $request): JsonResponse
    {
        try {
            $name = $request->input("name");
            $date = $request->input("date");

            DB::beginTransaction();
            $createSurvey = Survey::create([
                'name' => $name,
                'date' => $date,
            ]);
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Survey created successfully',
                'data' => $createSurvey
            ], ResponseAlias::HTTP_CREATED);
        } catch (Exception $error) {
            DB::rollBack();
            return response()->json(['error' => $error->getMessage()], ResponseAlias::HTTP_BAD_REQUEST);
        }
    }

    public function getSurvey(): JsonResponse
    {
        try {
            $survey = Survey::orderBy('id', 'desc')
                ->with("surveyQuestion.answer", "surveyEvent")
                ->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Survey fetched successfully',
                'data' => $survey
            ], ResponseAlias::HTTP_OK);
        } catch (Exception $error) {
            return response()->json(['error' => $error->getMessage()], ResponseAlias::HTTP_BAD_REQUEST);
        }
    }

    public function surveyResult(Request $request, $surveyId): JsonResponse
    {
        try {
            $result = (new SurveyEventService())->surveyEventResult($surveyId);

            return response()->json([
                'status' => 'success',
                'message' => 'Survey Event result fetched successfully',
                'data' => $result
            ], ResponseAlias::HTTP_OK);
        } catch (Exception $error) {
            return response()->json(['error' => $error->getMessage()], ResponseAlias::HTTP_BAD_REQUEST);
        }
    }

    public function deleteSurvey(Request $request, Survey $survey): JsonResponse
    {
        try {
            DB::beginTransaction();
            $survey->surveyEvent()->delete();
            $questions = $survey->surveyQuestion;

            foreach ($questions as $question) {
                $question->answer()->delete();
                $question->delete();
            }

            $survey->delete();
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Survey deleted successfully',
            ], ResponseAlias::HTTP_OK);
        } catch (Exception $error) {
            DB::rollBack();
            return response()->json(['error' => $error->getMessage()], ResponseAlias::HTTP_BAD_REQUEST);
        }
    }
}
