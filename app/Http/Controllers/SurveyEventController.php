<?php

namespace App\Http\Controllers;

use App\Http\Requests\SurveyEventRequest;
use App\Models\SurveyEvent;
use App\Service\SurveyEventService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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

            $createSurveyEvent = $surveyEventService->createSurveyEvent(
                $surveyId,
                $questionId,
                $answerId
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Survey Event created successfully',
                'data' => $createSurveyEvent
            ], ResponseAlias::HTTP_CREATED);
        } catch (Exception $error) {
            return response()->json(['error' => $error->getMessage()], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getSurveyEvent(): JsonResponse
    {
        try {
            $surveyEvent = SurveyEvent::orderBy('id', 'desc')->get();
            return response()->json($surveyEvent, ResponseAlias::HTTP_OK);
        } catch (Exception $error) {
            return response()->json(['error' => $error->getMessage()], ResponseAlias::HTTP_BAD_REQUEST);
        }
    }

    public function eventResult(Request $request): JsonResponse
    {
        try {
            $surveyId = $request->input("surveyId");

            $surveyEventService = new SurveyEventService();
            $result = $surveyEventService->surveyEventResult($surveyId);

            return response()->json([
                'status' => 'success',
                'message' => 'Survey Event result fetched successfully',
                'data' => $result
            ], ResponseAlias::HTTP_OK);
        } catch (Exception $error) {
            return response()->json(['error' => $error->getMessage()], ResponseAlias::HTTP_BAD_REQUEST);
        }
    }

}
