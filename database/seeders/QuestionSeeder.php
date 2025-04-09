<?php

namespace Database\Seeders;

use App\Enums\QUESTION_TYPES;
use App\Models\Category;
use App\Models\Game;
use App\Models\Question;
use App\Models\QuestionAnswer;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questionsData = [
            [
                'category' => 'moral',
                'question' => 'Have you ever laughed at someone else\'s misfortune?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'moral',
                'question' => 'Have you ever laughed at someone mentally or physically disabled?',
                'answers' => [
                    'yes' => -2,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever kissed someone?',
                'answers' => [
                    'yes' => 0,
                    'no' => 1,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever masturbated?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Up to orgasm?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
                'related_to_previous' => true,
            ],
            [
                'category' => 'hygiene',
                'question' => 'Has it ever happened that you didn\'t wash yourself?',
                'answers' => [
                    '4 days or more' => -6,
                    '3 days' => -4,
                    '2 days' => -2,
                    'More than 24 hours' => 0,
                    'I wash myself every day' => 5,
                ],
            ],
            [
                'category' => 'alcohol',
                'question' => 'Have you ever drunk alcohol?',
                'answers' => [
                    'yes' => -1,
                    'no' => 2,
                ],
            ],
            [
                'category' => 'alcohol',
                'question' => 'Have you ever been drunk?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'alcohol',
                'question' => 'Have you ever participated in drinking games?',
                'answers' => [
                    'yes' => -2,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'alcohol',
                'question' => 'Have you ever vomited because of alcohol?',
                'answers' => [
                    'yes' => -2,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'alcohol',
                'question' => 'Have you ever vomited on yourself or someone else?',
                'answers' => [
                    'yes' => -2,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'alcohol',
                'question' => 'Have you ever fallen because you were too drunk?',
                'answers' => [
                    'yes' => -2,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'alcohol',
                'question' => 'Have you ever vomited bile or blood because of alcohol?',
                'answers' => [
                    'yes' => -3,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'drug',
                'question' => 'Have you ever drugged your parents?',
                'answers' => [
                    'regularly' => -5,
                    'sometimes' => -2,
                    'never' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever talked about your sexual practices at work?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'alcohol',
                'question' => 'Have you ever been forcibly removed from a bar or club?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'alcohol',
                'question' => 'Have you ever participated in a pub crawl? (all the bars in a city or street)',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'alcohol',
                'question' => 'On average, how many times a week do you drink?',
                'answers' => [
                    'almost every day' => -8,
                    '4 times' => -5,
                    '3 times' => -3,
                    '2 times' => -2,
                    'Once or less often' => -1,
                    'never' => 0,
                ],
            ],
            [
                'category' => 'alcohol',
                'question' => 'Have you ever fallen asleep or passed out in a bar or club?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'alcohol',
                'question' => 'Have you ever had an alcohol-induced coma?',
                'answers' => [
                    'yes' => -5,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'drug',
                'question' => 'Have you ever smoked a cigarette?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'drug',
                'question' => 'Have you ever smoked a joint?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'drug',
                'question' => 'Have you ever smoked a "douille"? (a type of homemade bong)',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'alcohol',
                'question' => 'Have you ever drunk alcohol in the morning?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'drug',
                'question' => 'Have you ever taken drugs in the morning?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'alcohol',
                'question' => 'What was your longest period of being drunk?',
                'answers' => [
                    '48 hours or more' => -4,
                    '24 hours straight' => -4,
                    'a whole night' => -2,
                    '4 hours or less' => -1,
                    'I never drink' => 0,
                ],
            ],
            [
                'category' => 'moral',
                'question' => 'Do you own a bible or another holy book (Quran, Torah, ...)?',
                'answers' => [
                    'I have several' => 4,
                    'yes' => 2,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'moral',
                'question' => 'Have you ever voluntarily gone to church (or another holy place)?',
                'answers' => [
                    'often' => 8,
                    'sometimes' => 2,
                    'never' => 0,
                ],
            ],
            [
                'category' => 'drug',
                'question' => 'Have you ever tried a hard drug (cocaine, heroin, ...)?',
                'answers' => [
                    'several times' => -8,
                    'yes' => -4,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'moral',
                'question' => 'Have you ever been to prison?',
                'answers' => [
                    'More than 6 months' => -8,
                    'Less than 6 months' => -4,
                    'never' => 0,
                ],
            ],
            [
                'category' => 'moral',
                'question' => 'Have you ever intentionally hurt someone?',
                'answers' => [
                    'Several times' => -8,
                    'yes' => -4,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'drug',
                'question' => 'Do you use drugs regularly?',
                'answers' => [
                    'almost every day' => -8,
                    '4 times' => -5,
                    '3 times' => -3,
                    '2 times' => -2,
                    'Once or less often' => -1,
                    'never' => 0,
                ],
            ],
            [
                'category' => 'drug',
                'question' => 'Have you ever sold drugs?',
                'answers' => [
                    'yes' => -3,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'drug',
                'question' => 'Have you ever sold drugs to finance your own consumption?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever been on a date?',
                'answers' => [
                    'yes' => 5,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever taken a bath or shower with a member of the opposite sex?',
                'answers' => [
                    'yes' => 1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever paid for sex?',
                'answers' => [
                    'yes' => -2,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'moral',
                'question' => 'Have you ever taken advantage of someone while they were drunk, drugged, or temporarily disabled?',
                'answers' => [
                    'yes' => -3,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever gotten someone drunk or drugged to sexually abuse them and succeeded?',
                'answers' => [
                    'yes' => -2,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever been involved in fellatio or cunnilingus?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Up to orgasm?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
                'related_to_previous' => true,
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever had anal sex?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever done a 69?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'hygiene',
                'question' => 'Have you ever had an STD (sexually transmitted disease)?',
                'answers' => [
                    'yes' => -5,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'hygiene',
                'question' => 'Have you ever transmitted an STD?',
                'answers' => [
                    'yes' => -5,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'moral',
                'question' => 'Voluntarily?',
                'answers' => [
                    'yes' => -10,
                    'no' => 0,
                ],
                'related_to_previous' => true,
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever had sexual relations without using contraception?',
                'answers' => [
                    'yes' => 0,
                    'no' => 1,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever undergone or been the cause of an abortion?',
                'answers' => [
                    'yes' => -2,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever had sexual relations with more than one person at the same time?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever had sexual relations with more than two people in the same week?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever had sexual relations in a public place?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever had carpet burns (burns due to friction on a rather rough carpet) during sexual intercourse?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever had homosexual relations (or contrary to your sexual orientation)?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever had sadomasochistic experiences or practiced bondage?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever used sex toys?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever fallen asleep or passed out during sexual intercourse?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever been responsible for someone\'s loss of virginity, and if so, how many people?',
                'answers' => [
                    '3 or more' => -1,
                    '2 people' => -1,
                    'One person' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever answered a call during a sexual act?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever bought something in a sex shop?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'hygiene',
                'question' => 'Have you ever licked an eye, a toe, or an ear?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever had sexual relations with a member of your family?',
                'answers' => [
                    'yes' => -4,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'moral',
                'question' => 'Did you hesitate before answering the previous question?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'hygiene',
                'question' => 'Have you ever slept in the toilets?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'hygiene',
                'question' => 'Were you yourself a volunteer to sleep in that place?',
                'answers' => [
                    'yes' => -2,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'moral',
                'question' => 'Does zoophilia, necrophilia, or pedophilia attract or excite you?',
                'answers' => [
                    'yes' => -5,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever had a one-night stand? (a one-night affair with sexual relations)',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'moral',
                'question' => 'Have you ever had a one-night stand and left your partner without even saying goodbye?',
                'answers' => [
                    'yes' => -5,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever had sexual relations with more than one member of the same family?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever had sexual relations with someone who was already in a relationship with someone else?',
                'answers' => [
                    'yes' => -3,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever had sexual relations with a friend of your official partner?',
                'answers' => [
                    'yes' => -2,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever had sexual relations with someone who was much older or younger than you?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Did you hesitate before answering the previous question?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever had sexual relations for money?',
                'answers' => [
                    'yes' => -2,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'hygiene',
                'question' => 'Have you ever eaten your own vomit or someone else\'s?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'hygiene',
                'question' => 'Have you ever put food in your nose just for fun?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'hygiene',
                'question' => 'Have you ever participated in a golden shower (urinating on someone else or being urinated on by someone else)?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever been a voyeur?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'How many times a week do you watch pornographic movies or images?',
                'answers' => [
                    '3 times or more' => -3,
                    '2 times' => -2,
                    'Once or less often' => -1,
                    'never' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever faked an orgasm?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'moral',
                'question' => 'Have you ever stood someone up?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever dated someone just for sex?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever had quick sexual relations (between classes, in the street, all in a hurry, without foreplay or almost)?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'moral',
                'question' => 'Have you ever worked for a charity?',
                'answers' => [
                    'yes' => 8,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'moral',
                'question' => 'Have you ever cheated during an exam?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'hygiene',
                'question' => 'Have you ever made someone else drink your urine?',
                'answers' => [
                    'yes' => -3,
                    'Yes, with fruit juice' => -5,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'moral',
                'question' => 'Have you ever destroyed public property?',
                'answers' => [
                    'yes' => -2,
                    'It happens to me often' => -3,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'moral',
                'question' => 'Have you ever stolen from a friend?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'moral',
                'question' => 'Have you ever stolen from a store/supermarket?',
                'answers' => [
                    'yes' => -2,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'alcohol',
                'question' => 'Have you ever stolen alcohol (including from a bar)?',
                'answers' => [
                    'yes' => -2,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'hygiene',
                'question' => 'Have you ever urinated on yourself when you were drunk?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever had sexual relations to win a bet?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever exposed your genitals in public?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever had sexual relations to get a job or a promotion?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'moral',
                'question' => 'Have you ever been unfaithful?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever had sexual relations with the partner of one of your friends?',
                'answers' => [
                    'yes' => -2,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'hygiene',
                'question' => 'Have you ever vomited in a public place?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever woken up wondering where you were?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever woken up wondering where you were and who the person next to you was?',
                'answers' => [
                    'yes' => -2,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever wondered about the sex life of cartoon characters?',
                'answers' => [
                    'yes' => -1,
                    'no' => 1,
                ],
            ],
            [
                'category' => 'hygiene',
                'question' => 'Do you have a tattoo?',
                'answers' => [
                    'yes' => -1,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'sex',
                'question' => 'Have you ever had sexual relations that you now regret?',
                'answers' => [
                    'yes' => -1,
                    'no' => 1,
                ],
            ],
            [
                'category' => 'moral',
                'question' => 'Have you performed any of the acts in this test specifically to improve your score?',
                'answers' => [
                    'yes' => -2,
                    'no' => 0,
                ],
            ],
            [
                'category' => 'moral',
                'question' => 'Have you answered the questions honestly?',
                'answers' => [
                    'yes' => 1,
                    'no' => -1,
                ],
            ],
        ];

        $game = Game::where('name->en', 'Purity Game')->first();

        $previousQuestion = null;

        $categories = Category::where('game_id', $game->id)->get();
        // Create Questions and Answers
        foreach ($questionsData as $index => $questionData) {
            $category = $categories->where('name', $questionData['category'])->first();
            if ($category) {
                if(isset($questionData['answers']['yes'])) {
                    /** @var Question $question */
                    $question = Question::make([
                        'question' => ['en' => $questionData['question']],
                        'type' => QUESTION_TYPES::BOOLEAN,
                        'truth_points' => $questionData['answers']['yes'],
                        'false_points' => $questionData['answers']['no'],
                        'position' => $index + 1,
                    ]);
                    $question->category()->associate($category);
                    if (isset($questionData['related_to_previous']) && $questionData['related_to_previous'] && $previousQuestion) {
                        $question->parent()->associate($previousQuestion);
                    }
                    $question->save();
                } else {
                    /** @var Question $question */
                    $question = Question::make([
                        'question' => ['en' => $questionData['question']],
                        'type' => QUESTION_TYPES::MULTIPLE,
                        'position' => $index + 1,
                    ]);
                    $question->category()->associate($category);
                    if (isset($questionData['related_to_previous']) && $questionData['related_to_previous'] && $previousQuestion) {
                        $question->parent()->associate($previousQuestion);
                    }
                    $question->save();
                    $indexQuestion = 1;
                    foreach ($questionData['answers'] as $label => $points) {
                        $answer = new QuestionAnswer([
                            'label' => ['en' => $label],
                            'points' => $points,
                            'position' => $indexQuestion++,
                        ]);

                        $answer->question()->associate($question);
                        $answer->save();
                    }
                }
                $previousQuestion = $question;
            }
        }
    }
}
