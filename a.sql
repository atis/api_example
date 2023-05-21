
SELECT question_id, AVG(`value`+1) FROM `question_answer_ints` GROUP BY question_id;
SELECT question_id, COUNT(`value`) FROM `question_answer_ints` GROUP BY question_id;
SELECT question_id, `value`, COUNT(`value`) FROM `question_answer_ints` GROUP BY question_id, `value`;
