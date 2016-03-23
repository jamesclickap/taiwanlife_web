<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Tests of the upgrade to the new Moodle question engine for attempts at
 * calculated multiple-choice questions.
 *
 * @package    qtype
 * @subpackage calculatedmulti
 * @copyright  2011 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/question/engine/upgrade/tests/helper.php');


/**
 * Testing the upgrade of calculated multiple-choice question attempts.
 *
 * @copyright  2011 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_calculatedmulti_attempt_upgrader_test extends question_attempt_upgrader_test_base {
    public function test_calculatedmulti_adaptive_qsession96() {
        $quiz = (object) array(
            'id' => '4',
            'course' => '2',
            'name' => 'Calculated quiz',
            'intro' => '',
            'introformat' => '1',
            'timeopen' => '0',
            'timeclose' => '0',
            'attempts' => '0',
            'attemptonlast' => '0',
            'grademethod' => '1',
            'decimalpoints' => '2',
            'questiondecimalpoints' => '-1',
            'questionsperpage' => '1',
            'shufflequestions' => '0',
            'shuffleanswers' => '1',
            'questions' => '16,0,17,0,18,0',
            'sumgrades' => '3.00000',
            'grade' => '10.00000',
            'timecreated' => '0',
            'timemodified' => '1305648351',
            'timelimit' => '0',
            'password' => '',
            'subnet' => '',
            'popup' => '0',
            'delay1' => '0',
            'delay2' => '0',
            'showuserpicture' => '0',
            'showblocks' => '0',
            'preferredbehaviour' => 'adaptive',
            'reviewattempt' => '69888',
            'reviewcorrectness' => '69888',
            'reviewmarks' => '69888',
            'reviewspecificfeedback' => '69888',
            'reviewgeneralfeedback' => '69888',
            'reviewrightanswer' => '69888',
            'reviewoverallfeedback' => '4352',
        );
        $attempt = (object) array(
            'id' => '13',
            'uniqueid' => '13',
            'quiz' => '4',
            'userid' => '4',
            'attempt' => '1',
            'sumgrades' => '0.00000',
            'timestart' => '1305830650',
            'timefinish' => '1305830656',
            'timemodified' => '1305830656',
            'layout' => '16,0,17,0,18,0',
            'preview' => '0',
            'needsupgradetonewqe' => 1,
        );
        $question = (object) array(
            'id' => '17',
            'category' => '2',
            'parent' => '0',
            'name' => 'Calculated multiple-choice',
            'questiontext' => '<p>What is {a} + {b}?</p>',
            'questiontextformat' => '1',
            'generalfeedback' => '',
            'generalfeedbackformat' => '1',
            'defaultmark' => '1.0000000',
            'penalty' => '0.1',
            'qtype' => 'calculatedmulti',
            'length' => '1',
            'stamp' => 'tjh238.vledev2.open.ac.uk+110519184120+gpbLCv',
            'version' => 'tjh238.vledev2.open.ac.uk+110519184120+P5jpWJ',
            'hidden' => '0',
            'timecreated' => '1305830480',
            'timemodified' => '1305830480',
            'createdby' => '2',
            'modifiedby' => '2',
            'maxmark' => '1.0000000',
            'options' => (object) array(
                'id' => '1',
                'question' => '17',
                'synchronize' => '0',
                'single' => '1',
                'shuffleanswers' => '1',
                'correctfeedback' => '',
                'correctfeedbackformat' => '1',
                'partiallycorrectfeedback' => '',
                'partiallycorrectfeedbackformat' => '1',
                'incorrectfeedback' => '',
                'incorrectfeedbackformat' => '1',
                'answernumbering' => 'abc',
                'shownumcorrect' => '0',
                'answers' => array(
                    24 => (object) array(
                        'id' => '24',
                        'question' => '17',
                        'answer' => '{={a} - {b}}',
                        'answerformat' => '0',
                        'fraction' => '0.0000000',
                        'feedback' => '',
                        'feedbackformat' => '1',
                        'tolerance' => '0.01',
                        'tolerancetype' => '1',
                        'correctanswerlength' => '2',
                        'correctanswerformat' => '1',
                    ),
                    25 => (object) array(
                        'id' => '25',
                        'question' => '17',
                        'answer' => '{={a} + {b}}',
                        'answerformat' => '0',
                        'fraction' => '1.0000000',
                        'feedback' => '',
                        'feedbackformat' => '1',
                        'tolerance' => '0.01',
                        'tolerancetype' => '1',
                        'correctanswerlength' => '2',
                        'correctanswerformat' => '1',
                    ),
                    26 => (object) array(
                        'id' => '26',
                        'question' => '17',
                        'answer' => '{={a} / {b}}',
                        'answerformat' => '0',
                        'fraction' => '0.0000000',
                        'feedback' => '',
                        'feedbackformat' => '1',
                        'tolerance' => '0.01',
                        'tolerancetype' => '1',
                        'correctanswerlength' => '2',
                        'correctanswerformat' => '1',
                    ),
                    27 => (object) array(
                        'id' => '27',
                        'question' => '17',
                        'answer' => '{={a} * {b}}',
                        'answerformat' => '0',
                        'fraction' => '0.0000000',
                        'feedback' => '',
                        'feedbackformat' => '1',
                        'tolerance' => '0.01',
                        'tolerancetype' => '1',
                        'correctanswerlength' => '2',
                        'correctanswerformat' => '1',
                    ),
                ),
            ),
            'hints' => array(
            ),
        );
        $qsession = (object) array(
            'id' => '96',
            'attemptid' => '13',
            'questionid' => '17',
            'newest' => '257',
            'newgraded' => '257',
            'sumpenalty' => '0.1000000',
            'manualcomment' => '',
            'manualcommentformat' => '1',
            'flagged' => '0',
        );
        $qstates = array(
            254 => (object) array(
                'id' => '254',
                'attempt' => '13',
                'question' => '17',
                'seq_number' => '0',
                'answer' => 'dataset3-24,26,27,25:',
                'timestamp' => '1305830650',
                'event' => '0',
                'grade' => '0.0000000',
                'raw_grade' => '0.0000000',
                'penalty' => '0.0000000',
            ),
            257 => (object) array(
                'id' => '257',
                'attempt' => '13',
                'question' => '17',
                'seq_number' => '1',
                'answer' => 'dataset3-24,26,27,25:',
                'timestamp' => '1305830650',
                'event' => '6',
                'grade' => '0.0000000',
                'raw_grade' => '0.0000000',
                'penalty' => '0.1000000',
            ),
        );
        $this->loader->put_dataset_in_cache($question->id, 3, array('a' => '4.3', 'b' => '5.4'));

        $qa = $this->updater->convert_question_attempt($quiz, $attempt, $question, $qsession, $qstates);

        $expectedqa = (object) array(
            'behaviour' => 'adaptive',
            'questionid' => 17,
            'variant' => 3,
            'maxmark' => 1.0000000,
            'minfraction' => 0,
            'flagged' => 0,
            'questionsummary' => 'What is 4.3 + 5.4?',
            'rightanswer' => '9.7',
            'responsesummary' => '',
            'timemodified' => 1305830650,
            'steps' => array(
                0 => (object) array(
                    'sequencenumber' => 0,
                    'state' => 'todo',
                    'fraction' => null,
                    'timecreated' => 1305830650,
                    'userid' => 4,
                    'data' => array('_order' => '24,26,27,25', '_var_a' => '4.3', '_var_b' => '5.4'),
                ),
                1 => (object) array(
                    'sequencenumber' => 1,
                    'state' => 'gradedwrong',
                    'fraction' => null,
                    'timecreated' => 1305830650,
                    'userid' => 4,
                    'data' => array('-finish' => 1, '-_try' => 1, '-_rawfraction' => 0),
                ),
            ),
        );

        $this->compare_qas($expectedqa, $qa);
    }

    public function test_calculatedmulti_adaptive_qsession99() {
        $quiz = (object) array(
            'id' => '4',
            'course' => '2',
            'name' => 'Calculated quiz',
            'intro' => '',
            'introformat' => '1',
            'timeopen' => '0',
            'timeclose' => '0',
            'attempts' => '0',
            'attemptonlast' => '0',
            'grademethod' => '1',
            'decimalpoints' => '2',
            'questiondecimalpoints' => '-1',
            'questionsperpage' => '1',
            'shufflequestions' => '0',
            'shuffleanswers' => '1',
            'questions' => '16,0,17,0,18,0',
            'sumgrades' => '3.00000',
            'grade' => '10.00000',
            'timecreated' => '0',
            'timemodified' => '1305648351',
            'timelimit' => '0',
            'password' => '',
            'subnet' => '',
            'popup' => '0',
            'delay1' => '0',
            'delay2' => '0',
            'showuserpicture' => '0',
            'showblocks' => '0',
            'preferredbehaviour' => 'adaptive',
            'reviewattempt' => '69888',
            'reviewcorrectness' => '69888',
            'reviewmarks' => '69888',
            'reviewspecificfeedback' => '69888',
            'reviewgeneralfeedback' => '69888',
            'reviewrightanswer' => '69888',
            'reviewoverallfeedback' => '4352',
        );
        $attempt = (object) array(
            'id' => '14',
            'uniqueid' => '14',
            'quiz' => '4',
            'userid' => '4',
            'attempt' => '2',
            'sumgrades' => '2.80000',
            'timestart' => '1305830661',
            'timefinish' => '1305830729',
            'timemodified' => '1305830729',
            'layout' => '16,0,17,0,18,0',
            'preview' => '0',
            'needsupgradetonewqe' => 1,
        );
        $question = (object) array(
            'id' => '17',
            'category' => '2',
            'parent' => '0',
            'name' => 'Calculated multiple-choice',
            'questiontext' => '<p>What is {a} + {b}?</p>',
            'questiontextformat' => '1',
            'generalfeedback' => '',
            'generalfeedbackformat' => '1',
            'defaultmark' => '1.0000000',
            'penalty' => '0.1',
            'qtype' => 'calculatedmulti',
            'length' => '1',
            'stamp' => 'tjh238.vledev2.open.ac.uk+110519184120+gpbLCv',
            'version' => 'tjh238.vledev2.open.ac.uk+110519184120+P5jpWJ',
            'hidden' => '0',
            'timecreated' => '1305830480',
            'timemodified' => '1305830480',
            'createdby' => '2',
            'modifiedby' => '2',
            'maxmark' => '1.0000000',
            'options' => (object) array(
                'id' => '1',
                'question' => '17',
                'synchronize' => '0',
                'single' => '1',
                'shuffleanswers' => '1',
                'correctfeedback' => '',
                'correctfeedbackformat' => '1',
                'partiallycorrectfeedback' => '',
                'partiallycorrectfeedbackformat' => '1',
                'incorrectfeedback' => '',
                'incorrectfeedbackformat' => '1',
                'answernumbering' => 'abc',
                'shownumcorrect' => '0',
                'answers' => array(
                    24 => (object) array(
                        'id' => '24',
                        'question' => '17',
                        'answer' => '{={a} - {b}}',
                        'answerformat' => '0',
                        'fraction' => '0.0000000',
                        'feedback' => '',
                        'feedbackformat' => '1',
                        'tolerance' => '0.01',
                        'tolerancetype' => '1',
                        'correctanswerlength' => '2',
                        'correctanswerformat' => '1',
                    ),
                    25 => (object) array(
                        'id' => '25',
                        'question' => '17',
                        'answer' => '{={a} + {b}}',
                        'answerformat' => '0',
                        'fraction' => '1.0000000',
                        'feedback' => '',
                        'feedbackformat' => '1',
                        'tolerance' => '0.01',
                        'tolerancetype' => '1',
                        'correctanswerlength' => '2',
                        'correctanswerformat' => '1',
                    ),
                    26 => (object) array(
                        'id' => '26',
                        'question' => '17',
                        'answer' => '{={a} / {b}}',
                        'answerformat' => '0',
                        'fraction' => '0.0000000',
                        'feedback' => '',
                        'feedbackformat' => '1',
                        'tolerance' => '0.01',
                        'tolerancetype' => '1',
                        'correctanswerlength' => '2',
                        'correctanswerformat' => '1',
                    ),
                    27 => (object) array(
                        'id' => '27',
                        'question' => '17',
                        'answer' => '{={a} * {b}}',
                        'answerformat' => '0',
                        'fraction' => '0.0000000',
                        'feedback' => '',
                        'feedbackformat' => '1',
                        'tolerance' => '0.01',
                        'tolerancetype' => '1',
                        'correctanswerlength' => '2',
                        'correctanswerformat' => '1',
                    ),
                ),
            ),
            'hints' => array(
            ),
        );
        $qsession = (object) array(
            'id' => '99',
            'attemptid' => '14',
            'questionid' => '17',
            'newest' => '268',
            'newgraded' => '268',
            'sumpenalty' => '0.2000000',
            'manualcomment' => '',
            'manualcommentformat' => '1',
            'flagged' => '0',
        );
        $qstates = array(
            260 => (object) array(
                'id' => '260',
                'attempt' => '14',
                'question' => '17',
                'seq_number' => '0',
                'answer' => 'dataset8-25,24,27,26:',
                'timestamp' => '1305830661',
                'event' => '0',
                'grade' => '0.0000000',
                'raw_grade' => '0.0000000',
                'penalty' => '0.0000000',
            ),
            264 => (object) array(
                'id' => '264',
                'attempt' => '14',
                'question' => '17',
                'seq_number' => '1',
                'answer' => 'dataset8-25,24,27,26:25',
                'timestamp' => '1305830699',
                'event' => '3',
                'grade' => '1.0000000',
                'raw_grade' => '1.0000000',
                'penalty' => '0.1000000',
            ),
            268 => (object) array(
                'id' => '268',
                'attempt' => '14',
                'question' => '17',
                'seq_number' => '2',
                'answer' => 'dataset8-25,24,27,26:25',
                'timestamp' => '1305830699',
                'event' => '6',
                'grade' => '1.0000000',
                'raw_grade' => '1.0000000',
                'penalty' => '0.1000000',
            ),
        );
        $this->loader->put_dataset_in_cache($question->id, 8, array('a' => '3.7', 'b' => '6.0'));

        $qa = $this->updater->convert_question_attempt($quiz, $attempt, $question, $qsession, $qstates);

        $expectedqa = (object) array(
            'behaviour' => 'adaptive',
            'questionid' => 17,
            'variant' => 8,
            'maxmark' => 1.0000000,
            'minfraction' => 0,
            'flagged' => 0,
            'questionsummary' => 'What is 3.7 + 6.0?',
            'rightanswer' => '9.7',
            'responsesummary' => '9.7',
            'timemodified' => 1305830699,
            'steps' => array(
                0 => (object) array(
                    'sequencenumber' => 0,
                    'state' => 'todo',
                    'fraction' => null,
                    'timecreated' => 1305830661,
                    'userid' => 4,
                    'data' => array('_order' => '25,24,27,26', '_var_a' => '3.7', '_var_b' => '6.0'),
                ),
                1 => (object) array(
                    'sequencenumber' => 1,
                    'state' => 'complete',
                    'fraction' => 1,
                    'timecreated' => 1305830699,
                    'userid' => 4,
                    'data' => array('answer' => '0', '-submit' => 1, '-_try' => 1, '-_rawfraction' => 1),
                ),
                2 => (object) array(
                    'sequencenumber' => 2,
                    'state' => 'gradedright',
                    'fraction' => 1,
                    'timecreated' => 1305830699,
                    'userid' => 4,
                    'data' => array('answer' => '0', '-finish' => 1, '-_try' => 1, '-_rawfraction' => 1),
                ),
            ),
        );

        $this->compare_qas($expectedqa, $qa);
    }

    public function test_calculatedmulti_adaptive_qsession102() {
        $quiz = (object) array(
            'id' => '4',
            'course' => '2',
            'name' => 'Calculated quiz',
            'intro' => '',
            'introformat' => '1',
            'timeopen' => '0',
            'timeclose' => '0',
            'attempts' => '0',
            'attemptonlast' => '0',
            'grademethod' => '1',
            'decimalpoints' => '2',
            'questiondecimalpoints' => '-1',
            'questionsperpage' => '1',
            'shufflequestions' => '0',
            'shuffleanswers' => '1',
            'questions' => '16,0,17,0,18,0',
            'sumgrades' => '3.00000',
            'grade' => '10.00000',
            'timecreated' => '0',
            'timemodified' => '1305648351',
            'timelimit' => '0',
            'password' => '',
            'subnet' => '',
            'popup' => '0',
            'delay1' => '0',
            'delay2' => '0',
            'showuserpicture' => '0',
            'showblocks' => '0',
            'preferredbehaviour' => 'adaptive',
            'reviewattempt' => '69888',
            'reviewcorrectness' => '69888',
            'reviewmarks' => '69888',
            'reviewspecificfeedback' => '69888',
            'reviewgeneralfeedback' => '69888',
            'reviewrightanswer' => '69888',
            'reviewoverallfeedback' => '4352',
        );
        $attempt = (object) array(
            'id' => '15',
            'uniqueid' => '15',
            'quiz' => '4',
            'userid' => '3',
            'attempt' => '1',
            'sumgrades' => '0.70000',
            'timestart' => '1305830744',
            'timefinish' => '0',
            'timemodified' => '1305830792',
            'layout' => '16,0,17,0,18,0',
            'preview' => '0',
            'needsupgradetonewqe' => 1,
        );
        $question = (object) array(
            'id' => '17',
            'category' => '2',
            'parent' => '0',
            'name' => 'Calculated multiple-choice',
            'questiontext' => '<p>What is {a} + {b}?</p>',
            'questiontextformat' => '1',
            'generalfeedback' => '',
            'generalfeedbackformat' => '1',
            'defaultmark' => '1.0000000',
            'penalty' => '0.1',
            'qtype' => 'calculatedmulti',
            'length' => '1',
            'stamp' => 'tjh238.vledev2.open.ac.uk+110519184120+gpbLCv',
            'version' => 'tjh238.vledev2.open.ac.uk+110519184120+P5jpWJ',
            'hidden' => '0',
            'timecreated' => '1305830480',
            'timemodified' => '1305830480',
            'createdby' => '2',
            'modifiedby' => '2',
            'maxmark' => '1.0000000',
            'options' => (object) array(
                'id' => '1',
                'question' => '17',
                'synchronize' => '0',
                'single' => '1',
                'shuffleanswers' => '1',
                'correctfeedback' => '',
                'correctfeedbackformat' => '1',
                'partiallycorrectfeedback' => '',
                'partiallycorrectfeedbackformat' => '1',
                'incorrectfeedback' => '',
                'incorrectfeedbackformat' => '1',
                'answernumbering' => 'abc',
                'shownumcorrect' => '0',
                'answers' => array(
                    24 => (object) array(
                        'id' => '24',
                        'question' => '17',
                        'answer' => '{={a} - {b}}',
                        'answerformat' => '0',
                        'fraction' => '0.0000000',
                        'feedback' => '',
                        'feedbackformat' => '1',
                        'tolerance' => '0.01',
                        'tolerancetype' => '1',
                        'correctanswerlength' => '2',
                        'correctanswerformat' => '1',
                    ),
                    25 => (object) array(
                        'id' => '25',
                        'question' => '17',
                        'answer' => '{={a} + {b}}',
                        'answerformat' => '0',
                        'fraction' => '1.0000000',
                        'feedback' => '',
                        'feedbackformat' => '1',
                        'tolerance' => '0.01',
                        'tolerancetype' => '1',
                        'correctanswerlength' => '2',
                        'correctanswerformat' => '1',
                    ),
                    26 => (object) array(
                        'id' => '26',
                        'question' => '17',
                        'answer' => '{={a} / {b}}',
                        'answerformat' => '0',
                        'fraction' => '0.0000000',
                        'feedback' => '',
                        'feedbackformat' => '1',
                        'tolerance' => '0.01',
                        'tolerancetype' => '1',
                        'correctanswerlength' => '2',
                        'correctanswerformat' => '1',
                    ),
                    27 => (object) array(
                        'id' => '27',
                        'question' => '17',
                        'answer' => '{={a} * {b}}',
                        'answerformat' => '0',
                        'fraction' => '0.0000000',
                        'feedback' => '',
                        'feedbackformat' => '1',
                        'tolerance' => '0.01',
                        'tolerancetype' => '1',
                        'correctanswerlength' => '2',
                        'correctanswerformat' => '1',
                    ),
                ),
            ),
            'hints' => array(
            ),
        );
        $qsession = (object) array(
            'id' => '102',
            'attemptid' => '15',
            'questionid' => '17',
            'newest' => '278',
            'newgraded' => '278',
            'sumpenalty' => '0.5000000',
            'manualcomment' => '',
            'manualcommentformat' => '1',
            'flagged' => '0',
        );
        $qstates = array(
            271 => (object) array(
                'id' => '271',
                'attempt' => '15',
                'question' => '17',
                'seq_number' => '0',
                'answer' => 'dataset7-26,24,25,27:',
                'timestamp' => '1305830744',
                'event' => '0',
                'grade' => '0.0000000',
                'raw_grade' => '0.0000000',
                'penalty' => '0.0000000',
            ),
            274 => (object) array(
                'id' => '274',
                'attempt' => '15',
                'question' => '17',
                'seq_number' => '1',
                'answer' => 'dataset7-26,24,25,27:27',
                'timestamp' => '1305830759',
                'event' => '3',
                'grade' => '0.0000000',
                'raw_grade' => '0.0000000',
                'penalty' => '0.1000000',
            ),
            275 => (object) array(
                'id' => '275',
                'attempt' => '15',
                'question' => '17',
                'seq_number' => '2',
                'answer' => 'dataset7-26,24,25,27:24',
                'timestamp' => '1305830761',
                'event' => '3',
                'grade' => '0.0000000',
                'raw_grade' => '0.0000000',
                'penalty' => '0.1000000',
            ),
            276 => (object) array(
                'id' => '276',
                'attempt' => '15',
                'question' => '17',
                'seq_number' => '3',
                'answer' => 'dataset7-26,24,25,27:26',
                'timestamp' => '1305830764',
                'event' => '3',
                'grade' => '0.0000000',
                'raw_grade' => '0.0000000',
                'penalty' => '0.1000000',
            ),
            277 => (object) array(
                'id' => '277',
                'attempt' => '15',
                'question' => '17',
                'seq_number' => '4',
                'answer' => 'dataset7-26,24,25,27:25',
                'timestamp' => '1305830766',
                'event' => '3',
                'grade' => '0.7000000',
                'raw_grade' => '1.0000000',
                'penalty' => '0.1000000',
            ),
            278 => (object) array(
                'id' => '278',
                'attempt' => '15',
                'question' => '17',
                'seq_number' => '5',
                'answer' => 'dataset7-26,24,25,27:24',
                'timestamp' => '1305830768',
                'event' => '3',
                'grade' => '0.7000000',
                'raw_grade' => '0.0000000',
                'penalty' => '0.1000000',
            ),
        );
        $this->loader->put_dataset_in_cache($question->id, 7, array('a' => '4.4', 'b' => '8.2'));

        $qa = $this->updater->convert_question_attempt($quiz, $attempt, $question, $qsession, $qstates);

        $expectedqa = (object) array(
            'behaviour' => 'adaptive',
            'questionid' => 17,
            'variant' => 7,
            'maxmark' => 1.0000000,
            'minfraction' => 0,
            'flagged' => 0,
            'questionsummary' => 'What is 4.4 + 8.2?',
            'rightanswer' => '12.6',
            'responsesummary' => '-3.8',
            'timemodified' => 1305830768,
            'steps' => array(
                0 => (object) array(
                    'sequencenumber' => 0,
                    'state' => 'todo',
                    'fraction' => null,
                    'timecreated' => 1305830744,
                    'userid' => 3,
                    'data' => array('_order' => '26,24,25,27', '_var_a' => '4.4', '_var_b' => '8.2'),
                ),
                1 => (object) array(
                    'sequencenumber' => 1,
                    'state' => 'todo',
                    'fraction' => 0,
                    'timecreated' => 1305830759,
                    'userid' => 3,
                    'data' => array('answer' => '3', '-submit' => 1, '-_try' => 1, '-_rawfraction' => 0),
                ),
                2 => (object) array(
                    'sequencenumber' => 2,
                    'state' => 'todo',
                    'fraction' => 0,
                    'timecreated' => 1305830761,
                    'userid' => 3,
                    'data' => array('answer' => '1', '-submit' => 1, '-_try' => 2, '-_rawfraction' => 0),
                ),
                3 => (object) array(
                    'sequencenumber' => 3,
                    'state' => 'todo',
                    'fraction' => 0,
                    'timecreated' => 1305830764,
                    'userid' => 3,
                    'data' => array('answer' => '0', '-submit' => 1, '-_try' => 3, '-_rawfraction' => 0),
                ),
                4 => (object) array(
                    'sequencenumber' => 4,
                    'state' => 'todo',
                    'fraction' => 0.7,
                    'timecreated' => 1305830766,
                    'userid' => 3,
                    'data' => array('answer' => '2', '-submit' => 1, '-_try' => 4, '-_rawfraction' => 1),
                ),
                5 => (object) array(
                    'sequencenumber' => 5,
                    'state' => 'todo',
                    'fraction' => 0.7,
                    'timecreated' => 1305830768,
                    'userid' => 3,
                    'data' => array('answer' => '1', '-submit' => 1, '-_try' => 5, '-_rawfraction' => 0),
                ),
            ),
        );

        $this->compare_qas($expectedqa, $qa);
    }
}
