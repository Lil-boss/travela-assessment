<?php

namespace App\Service;

use App\Models\Survey;
use App\Models\SurveyAnswer;
use App\Models\SurveyEvent;
use App\Models\SurveyQuestion;
use Exception;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SurveyEventService
{
    /**
     * @throws Exception
     */
    public static function surveyEventResult($surveyId): array
    {
        $surveyEvents = SurveyEvent::with(['surveyQuestion', 'surveyAnswer'])
            ->where('surveyId', $surveyId)
            ->get();

        if ($surveyEvents->isEmpty()) {
            throw new Exception('There is no events for this survey', ResponseAlias::HTTP_NOT_FOUND);
        }

        $surveyEventsGrouped = $surveyEvents->groupBy('questionId');

        $result = [];
        foreach ($surveyEventsGrouped as $questionId => $events) {
            $firstEvent = $events->first();

            if (!isset($firstEvent->surveyQuestion)) {
                continue;
            }

            $totalResponses = $events->count();

            $answerCounts = $events->groupBy('surveyAnswer.id')->map(function ($group) {
                return $group->count();
            });

            $answersWithPercentage = $events->map(function ($event) use ($answerCounts, $totalResponses) {
                $answerId = $event->surveyAnswer->id;
                $count = $answerCounts[$answerId];
                $percentage = ($count / $totalResponses) * 100;

                return [
                    'answer' => $event->surveyAnswer->answer,
                    'count' => $count,
                    'percentage' => round($percentage, 2)
                ];
            })->unique('answer');

            $result[] = [
                'questionId' => $questionId,
                'question' => $firstEvent->surveyQuestion->question,
                'totalResponses' => $totalResponses,
                'answers' => $answersWithPercentage->values()->toArray()
            ];
        }

        return $result;
    }

    /**
     * @throws Exception
     */
    public function createSurveyEvent($surveyId, $questionId, $answerId)
    {
        //are they existing or not if not return error
        $survey = Survey::find($surveyId);

        if (blank($survey)) {
            throw new Exception('Survey not found', ResponseAlias::HTTP_NOT_FOUND);
        }

        $surveyQuestion = SurveyQuestion::find($questionId);
        if (blank($surveyQuestion)) {
            throw new Exception('Survey Question not found', ResponseAlias::HTTP_NOT_FOUND);
        }

        $surveyAnswer = SurveyAnswer::find($answerId);
        if (blank($surveyAnswer)) {
            throw new Exception('Survey Answer not found', ResponseAlias::HTTP_NOT_FOUND);
        }

        //check is questionId is associated with surveyId, and answerId is associated with questionId, if not return error
        $surveyQuestion = SurveyQuestion::where('surveyId', $surveyId)
            ->where('id', $questionId)
            ->first();

        if (!$surveyQuestion) {
            throw new Exception('Question is not associated with this survey', ResponseAlias::HTTP_NOT_FOUND);
        }

        return SurveyEvent::create([
            'surveyId' => $surveyId,
            'questionId' => $questionId,
            'answerId' => $answerId,
        ]);
    }
}
