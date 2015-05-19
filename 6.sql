/*
Так как поиск по столбцу tinyint(3) намного быстрее чем по char(20), то 
следует сначала отобрать записи с site_id=35, а уже потом в них производить поиск to_widget_user_id=100001804947780.
Также для экономии памяти лучше выбирать только те столбцы, которые необходимы.
*/
select count(a.to_widget_user_id) 
from (select to_widget_user_id FROM quiz_answers WHERE site_id=35) AS a where 
a.to_widget_user_id='100001804947780'