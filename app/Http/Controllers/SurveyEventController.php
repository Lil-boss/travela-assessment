<?php

namespace App\Http\Controllers;

use App\Http\Requests\SurveyEventRequest;
use App\Models\SurveyEvent;
use App\Service\SurveyEventService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SurveyEventController extends Controller
{
    public function createSurveyEvent(SurveyEventRequest $request): JsonResponse
    {
        try {
            $surveyId = $request->get("surveyId");
            $questionId = $request->get("questionId");
            $answerId = $request->get("answerId");
            $surveyEventService = new SurveyEventService();

            DB::beginTransaction();
            $createSurveyEvent = $surveyEventService->createSurveyEvent(
                $surveyId,
                $questionId,
                $answerId
            );
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Survey Event created successfully',
                'data' => $createSurveyEvent
            ], ResponseAlias::HTTP_CREATED);
        } catch (Exception $error) {
            DB::rollBack();
            return response()->json(['error' => $error->getMessage()], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getSurveyEvent(): JsonResponse
    {
        try {
            $surveyEvent = SurveyEvent::orderBy('id', 'desc')
                ->with('survey', 'surveyQuestion', 'surveyAnswer')
                ->get();
            return response()->json($surveyEvent, ResponseAlias::HTTP_OK);
        } catch (Exception $error) {
            return response()->json(['error' => $error->getMessage()], ResponseAlias::HTTP_BAD_REQUEST);
        }
    }

}
