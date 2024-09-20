<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//         $surveys = Survey::factory(10)->create();
//            $surveys->each(function ($survey) {
//                $questions = $survey->surveyQuestion()->saveMany(SurveyQuestion::factory(5)->create(
//                    ['surveyId' => $survey->id]
//                ));
//                $questions->each(function ($question) {
//                    $answers = $question->answer()->saveMany(SurveyAnswer::factory(4)->create(
//                        ['questionId' => $question->id]
//                    ));
//                    $answers->each(function ($answer) {
//                        $answer->surveyEvent()->saveMany(SurveyEvent::factory(3)->create(
//                            [
//                                'surveyId' => $answer,
//                                'questionId' => $answer->questionId,
//                                'answerId' => $answer->id
//                            ]
//                        ));
//                    });
//                });
//            });
    }
}
