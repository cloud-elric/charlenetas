
<?= \yii2fullcalendar\yii2fullcalendar::widget(array(
            'events' => $events,
            'id' => 'calendar',
        ));
?>
 
   <!--?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
 
            'event_id',
            'event_name',
            'date',
 
            ['class' => 'yii\grid\ActionColumn'],
        ],
   ]); ?-->
